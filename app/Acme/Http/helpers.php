<?php

use \Model\Ttransactlog\ModelName as Ttransactlog;
use \Model\Ttransact\ModelName as Ttransact;
use \Model\UserMoney\ModelName as UserMoney;

use \Model\Tuser\ModelName as Tuser;
use \Model\FlightRegister\ModelName as FlightRegister;
use \Model\Passenger\ModelName as PassengerModel;
use Input;

use \Acme\myClass\Flight as Flight;
use \Acme\myClass\Passenger as Passenger;
use \Acme\myClass\SofeeXmlParser as SofeeXmlParser;
use \Acme\myClass\Book;
use \Acme\myClass\Price;
use \Acme\myClass\Tax;


function find_all_keys($array, $search, &$result=array()) {
    if(!is_array($array)) return $result;
    if( array_key_exists($search, $array) ){
        $result[] = $array[$search];
    }
    else foreach ($array as $k => $v) {
        if( is_array($v) ) find_all_keys($v, $search, $result);
    }
    return $result;
}

function find_adult_passenger_price($array, &$res=0) {
    if ($res>0) return $res;
    if(!is_array($array)) return $res;
    if( array_key_exists('PassengerTypeCode', $array) && $array['PassengerTypeCode'] == 'ADT' ){
        $res=$array['TotalFare']['Amount'];
    }
    else foreach ($array as $k => $v) {
        if( is_array($v) ) find_adult_passenger_price($v, $res);
    }
    return $res;
}

function find_first_key($array, $search) {
    static $_tmp = array();
    if( array_key_exists($search, $array) ){
        $_tmp = $array[$search];
    }
    foreach ($array as $k => $v) {
        if( is_array($v) ) find_first_key($v, $search);
    }
    return $_tmp;
}

function print_it($array){
    print("<pre>");
    print_r($array);
    print("</pre><hr/>");
}

function print_keys($array){
    print("<pre>");
    foreach($array as $key=>$value){
        if (is_int($key)) {
            foreach($value as $subkey=>$subval){
                echo $subkey ." --> ".$subval."<hr/>";
            }
        }
        else echo $key." --> ".$value."<hr/>";
    }
    print("</pre><hr/>");
}

function print_only_keys($array){
    print("<pre>");
    foreach($array as $key=>$value){
        echo $key." --> ".$value."<hr/>";
    }
    print("</pre><hr/>");
}


function fill_flights($array){
    $hour = 60*60;
    $flight = new Flight(); 
    foreach($array as $a=>$b){
        if ($a == 'DepartureAirport') $flight->departureAirport = $b['LocationCode'];
        if ($a == 'ArrivalAirport') $flight->arrivalAirport = $b['LocationCode'];
        if ($a == 'Equipment') $flight->equipment = $b['AirEquipType'];
        if ($a == 'MarkettingAirline')$flight->markettingAirline = $b['CompanyShortName'];
        if ($a == 'ArrivalDateTime') $flight->arrivalDateTime = $b;
        if ($a == 'DepartureDateTime') {
            $flight->timestamp = strtotime($b);
            $diff = floor(($flight->timestamp - time()) / $hour);
            if ($diff < 6) continue;
            
            $flight->departureDateTime = $b;
            $flight->timestamp = strtotime($b);
            
        }
        if ($a == 'FlightNumber') $flight->flightNumber = $b;
        if ($a == 'StopQuantity') $flight->stopQuantity = $b;
        if ($a == 'OnTimeRate') $flight->onTimeRate = $b;
        if ($a == 'JourneyDuration') $flight->journeyDuration = $b;
        
        if ($a == 'BookingClassAvailExt') {
            
            foreach($b as $book_k=>$book_v){
                $book = new Book();
                if (isset($book_v['RPH']))  $book->rph = $book_v['RPH']; else $book->rph = "";
                if (isset($book_v['ResBookDesigCode'])) $book->resBookDesigCode = $book_v['ResBookDesigCode']; else $book->resBookDesigCode = "";
                if (isset($book_v['ResBookDesigQuantity'])) $book->resBookDesigQuantity = $book_v['ResBookDesigQuantity']; else $book->resBookDesigQuantity = "";
                if (isset($book_v['ResBookDesigID']))   $book->resBookDesigID = $book_v['ResBookDesigID']; else $book->resBookDesigID = "";
                if (isset($book_v['FareReference']))    $book->fareReference = $book_v['FareReference']; else $book->fareReference = "";
                if (isset($book_v['FareReferenceID']))  $book->fareReferenceID = $book_v['FareReferenceID']; else $book->fareReferenceID = "";
                if (isset($book_v['FareDisplayInfos'])) $price_info = find_all_keys($book_v['FareDisplayInfos'], 'FareDisplayInfo'); else $price_info = Null;
                foreach($price_info as $price_item_key=>$price_item_value){
                    foreach($price_item_value as $price_key=>$price_value){
                        $book->fareReference = $price_value['FareReference']['value'];
                        $book->fareReferenceID = $price_value['FareReferenceID']['value'];
                        $price = new Price();
                        $price->passenger = $price_value['PricingInfo']['PassengerTypeCode'];
                        $price->base_price = $price_value['PricingInfo']['BaseFare']['Amount'];
                        $price->price = $price_value['PricingInfo']['TotalFare']['Amount'];
                        if ($price->passenger=="ADT") $book->adultPrice = $price->price;
                        if ($price->passenger=="CHL") $book->childPrice = $price->price;
                        if ($price->passenger=="INF") $book->infPrice = $price->price;
                        $tax_info = find_all_keys($price_value['PricingInfo']['Taxes'], 'Tax');
                        foreach($tax_info as $tax_item_key=>$tax_item_value){
                            foreach($tax_item_value as $tax_key=>$tax_value){
                                $tax = new Tax();
                                $tax->amount = $tax_value['Amount'];
                                $tax->code = $tax_value['TaxCode'];
                                $price->tax_list[] = $tax;
                            }
                        }
                        $book->price_list[] = $price;
                    }
                }
                
                $flight->books[] = $book;
            }
        }
    }
    $least_book = new Book();
    $least_book->adultPrice = 0;
    foreach($flight->books as $key=>$value){
        if ($least_book->adultPrice > $value->adultPrice || $least_book->adultPrice == 0) $least_book = $value;
    }
    
    $flight->leastBook = $least_book;
    
    $flight->fareReference = $least_book->fareReference;
    $flight->fareReferenceID = $least_book->fareReferenceID;
    $flight->rph = $least_book->rph;
    $flight->adultPrice = $least_book->adultPrice;
    $flight->childPrice = $least_book->childPrice;
    $flight->infPrice = $least_book->infPrice;
    $flight->resBookDesigCode = $least_book->resBookDesigCode;
    $flight->resBookDesigQuantity = $least_book->resBookDesigQuantity;
    $flight->resBookDesigID = $least_book->fareReferenceID;
    
    return $flight;
}

function get_flights($tree, $direction){
    $origindest_father = find_first_key($tree, $direction);
    $flights = array();
    $origindest = find_all_keys($origindest_father, 'FlightSegmentExt');
    foreach($origindest as $k=>$v){
        $flights[]=fill_flights($v);
    }
    return $flights;
}

function date_manual_diff($date1, $date2) { 
    $date1 = date("Y-m-d",strtotime($date1));
    
    $current = $date1; 
    $datetime2 = date_create($date2); 
    $datetime1 = date_create($date1);
    //echo $date1." ".$date2;
    //dd($date1,$date2);
    if ($datetime1 > $datetime2) return -1;
    $count = 0; 

    $diff=date_diff(date_create($current),$datetime2);
    $difDays = $diff->format("%a");

    // while(date_create($current) < $datetime2){ 
    //     $current = gmdate("Y-m-d", strtotime("+1 day", strtotime($current))); 
    //     $count++; 
    // } 
    return $difDays; 
}
function makeSelectOptionMonths() {
        $MonthNames=array("","Январь", "Февраль", "Март", "Апрель", "Май", "Июнь", "Июль", "Августь", "Сентябрь", "Октябрь", "Ноябрь", "Декабрь");
        $result = "";
        for($i=1;$i<count($MonthNames); $i++) $result .= '<option value="'.$i.'">'.$MonthNames[$i].'</option>';
        return $result;
}


function generateUniqueSMSID() {
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

function post_content ($url,$postdata) {
    $uagent = "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.1.4322)";

    $ch = curl_init( $url );
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_USERAGENT, $uagent);  // useragent
    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
    //curl_setopt($ch, CURLOPT_COOKIEJAR, "c://coo.txt");
    //curl_setopt($ch, CURLOPT_COOKIEFILE,"c://coo.txt");

    $content = curl_exec( $ch );
    $err     = curl_errno( $ch );
    $errmsg  = curl_error( $ch );
    $header  = curl_getinfo( $ch );
    curl_close( $ch );

    $header['errno']   = $err;
    $header['errmsg']  = $errmsg;
    $header['content'] = $content;
    return $header;
}

function send_sms ($phone,$sms_text){
$login = "mirbek";
$password = "SCPp2D24";
$transactionId = generateUniqueSMSID();
$sender_id = "996555253333";

$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>".
    "<message>".
        "<login>" . $login . "</login>".
        "<pwd>" . $password . "</pwd>".
        "<id>" . $transactionId . "</id>".
        "<sender>" . $sender_id . "</sender>".
        "<text>" . $sms_text . "</text>".
        "<phones>".
        "<phone>" . $phone . "</phone>".
        "</phones>".
    "</message>";   

try {
    $url = "http://smspro.nikita.kg/api/message";
    post_content( $url, $xml );
    return 1;
    } 
catch(Exception $e) {
    return 0;
}
}


function transliterate($ru_text) {
     $cyr  = array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у', 
            'ф','х','ц','ч','ш','щ','ъ', 'ы','ь', 'э', 'ю','я',
            'А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У',
            'Ф','Х','Ц','Ч','Ш','Щ','Ъ', 'Ы','Ь', 'Э', 'Ю','Я' );
$lat = array( 'a','b','v','g','d','e','e','zh','z','i','y','k','l','m','n','o','p','r','s','t','u',
            'f' ,'h' ,'ts' ,'ch','sh' ,'sht' ,'i', 'y', 'y', 'e' ,'yu' ,'ya','A','B','V','G','D','E','E','Zh',
            'Z','I','Y','K','L','M','N','O','P','R','S','T','U',
            'F' ,'H' ,'Ts' ,'Ch','Sh' ,'Sht' ,'I' ,'Y' ,'Y', 'E', 'Yu' ,'Ya' );
     return str_replace($cyr, $lat, $ru_text);
}


function check4passengerdata($name, $surname, $bd_day, $bd_month, $bd_year )
{
    if ($name=="") error_die("[translate]passenger name empty");
    if ($surname=="") error_die("[translate]passenger durname empty");
    if ($bd_day==0) error_die("[translate]passenger birth day empty");
    if ($bd_month==0) error_die("[translate]passenger birth month empty");
    if ($bd_year==0) error_die("[translate]passenger birth year empty");
}


function checkPassengerAge($bd)
{
    $a = date("Y-m-d", $bd);
    $b = date("Y-m-d");
    $d1 = new DateTime($a);
    $d2 = new DateTime($b);
    
    $diff = $d2->diff($d1);
    
    return $diff->y;
}



function generateRandomPayCode_helper() {
    $first_characters = '23456789';
    $characters = '0123456789';
    $randomString = '';
    for ($i = 0; $i < 5; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $firstcar = $first_characters[rand(0, strlen($first_characters) - 1)];
    
    return $firstcar.$randomString;
}

function generateRandomPayCode() {
    $random = generateRandomPayCode_helper();
    global $db;
    $rw = $db->select_one("flight_register", " paycode='" . $random . "'");
    while($rw["id"] > 0){
        $random = generateRandomPayCode_helper();
        $rw = $db->select_one("flight_register", " paycode='" . $random . "'");
    }
    return $random;
}

    // Sms functions
// end

// pay functions 
function generateRandomString($length = 10, $alphanumeric = 0 ) {
	if ($length<=0 || $length>20) $length = 10;
	if ($alphanumeric<0 || $alphanumeric>2) $alphanumeric = 0;
    $chars[0] = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$chars[1] = '0123456789';
	$chars[2] = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$characters = $chars[$alphanumeric];
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}


// to send email
function send_mail($to,$s,$body)
{
	global $fly24_vars;
	$from_name = $fly24_vars["send_mail_from_name"];
	$from_a = $fly24_vars["send_mail_from_address"];
	$reply = $fly24_vars["send_mail_reply_to"];
	
    $s= "=?utf-8?b?".base64_encode($s)."?=";
    $headers = "MIME-Version: 1.0\r\n";
    $headers.= "From: =?utf-8?b?".base64_encode($from_name)."?= <".$from_a.">\r\n";
    $headers.= "Content-Type: text/html;charset=utf-8\r\n";
    $headers.= "Reply-To: $reply\r\n";  
    $headers.= "X-Mailer: PHP/" . phpversion();
	//echo $to." ".$s." ".$body." ".$headers;
    if (mail($to, $s, $body, $headers)) {}
}
    

function check_account($acc, $txn_id)
    {
    $acc = trim($acc);
    $comment = '';
    
    if (strlen($acc)<6) {
        die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>5</result><comment></comment></response>');
    } 
    
    if ($acc[0]==1){
        $row = Tuser::where("user_account","=",$acc)->first();
        if ($row['id']>0){
            $final = '<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>0</result>';
            $final .= '<field1 name="disp1"> '.$row['name'].' '.$row['surname'].'</field1><field2 name="disp2"></field2></fields>';
            $final .= '<comment>OK</comment></response>';
            die($final);
        }
        else {
        die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>5</result><comment></comment></response>');
        }
    } else {
        $row = FlightRegister::where("pay_till",">", now())->where("paycode","=",$acc)->first();
        if ($row['id']>0){
            $final = '<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>0</result>';
            $final .= '<fields><field1 name="disp1"> '.$row['name'].' '.$row['surname'].'</field1><field2 name="disp2"></field2></fields>';
            $final .= '<comment>OK</comment></response>';
            die($final);
        }
        else {
        die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>5</result><comment></comment></response>');
        }
    }
    die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>5</result><comment></comment></response>');
} // end of function check_account

// function check_pay_account
function check_pay_account($acc, $txn_id,$sum, $prv_txn, $service){
    $acc = trim($acc);
    $comment = '';
    $user_found_table = NULL;
    if ($acc[0]==1){
        $row = Tuser::where("user_account","=",$acc)->first();
        if ($row['id']>0){
            $user_found_table = "tuser";
        }
    } else {
        $row = FlightRegister::where("paycode","=",$acc)->first();
        if ($row['id']>0){
            $user_found_table = "flight_register";
        }
    }
    
    if (!$user_found_table){
            $table = Ttransactlog::create();
            $table->txn_id = $txn_id;
            $table->account = $acc;
            $table->sum = $sum;
            $table->osmp_txn_id = $prv_txn;
            $table->result = 'no account';
            $table->service = $service;
            $table->save();
            
            die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><result>5</result><comment>no account</comment></response>');
    }
    // check for double payment
    $transact = Ttransactlog::where("txn_id","like",$txn_id)->first();
    if ($transact){
            $comment = 'Повторный платеж';
            $dblogarray = array("txn_id" => $txn_id, "account" => $acc, "sum" => $sum, "osmp_txn_id" => $prv_txn, "result" => 'double payment', "service" => $service);
            $db->insert("ttransactlog", $dblogarray);
            die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><prv_txn>'.$prv_txn.'</prv_txn>
<sum>'.$transact['money'].'</sum><result>'.$transact['status'].'</result><comment>'.$comment.'</comment></response>');
    }   
    // if still alive...
    $table1 = Ttransact::create();
            $table1->txn_id = $txn_id;
            $table1->account = $acc;
            $table1->money = $sum;
            $table1->method = '1';
            $table1->status = '0';
            $table1->service = $service;
            $table1->save();    

            $table2 = Ttransactlog::create();
            $table2->txn_id = $txn_id;
            $table2->account = $acc;
            $table2->sum = $sum;
            $table2->osmp_txn_id = $prv_txn;
            $table2->result = 'success';
            $table2->service = $service;
            $table2->save();
    
    if ($user_found_table == "tuser") {
    $table3 = UserMoney::create();
    $table3->user = $row["id"];
    $table3->amount = $sum;
    $table3->save();
    }
    else{
        if ($user_found_table == "flight_register") flight_booking_payment($row, $sum);
    }
    
    
    die('<?xml version="1.0" encoding="UTF-8"?><response><osmp_txn_id>'.$txn_id.'</osmp_txn_id><prv_txn>'.$prv_txn.'</prv_txn>
<sum>'.$sum.'</sum><result>0</result><comment>OK</comment></response>');

} // end of function check_pay_account
    
// require_once "../../class/flight_payment_functions.php";
    function flight_booking_payment($flight_row, $sum){
        $total_money = $flight_row["paid_sum"]+$sum;
        $extra_money = $total_money - $flight_row["price"];
        $tableFound = FlightRegister::where("id","=",$flight_row['id'])->first();
        $tableFound->paid_sum = $total_money;
        $flight_row["paid_sum"] = $total_money;
        if ($total_money < $flight_row["price"]) { 
            //IF money is not sufficient to buy ticket, let client know about it.
            send_fail_message_with_flight_row($flight_row);
            return; // no ticket, sorry. game over.
        } 
        if ($extra_money >0) { 
            $tableFoundExtra = FlightRegister::where("id","=",$flight_row['id'])->first();
            $tableFoundExtra->paid_extra = $extra_money;
            $tableFoundExtra->save();
            $flight_row["paid_extra"] = $extra_money;
            send_extra_message_with_flight_row($flight_row);
        }
        
        //////////////////////////
        // BUY TICKET.
        $pnr_code = getPNR($flight_row);

        if ($pnr_code==0) {
            send_admin_fail_message_with_flight_row($flight_row);
            return '0';
        }
        /////////////////////////
        
        $upd = FlightRegister::where("id","=",$flight_row['id'])->first();
        $upd->paid_flag = '1';
        $upd->pnrcode = $pnr_code;
        $upd->save();
        
        $flight_row["pnrcode"] = $pnr_code;
        $flight_row["paid_flag"] = '1';
        send_success_message_with_flight_row($flight_row);
}

function send_fail_message_with_flight_row($flight_row){
    $to = $flight_row['email'];
    $money = $flight_row['price']-$flight_row['paid_sum'];
    $s = "[translate]Your deposit money is insufficient to buy ticket";
    $body = "[translate]Your deposit money is insufficient to buy ticket.<br>
    Reservation price is : ".$flight_row['price']."<br>
    Money paid for reservation : ".$flight_row['paid_sum']."<br>
    You have to pay : ".$money." with Pay Code: ".$flight_row['paycode']."
    ";
    $sms_body = "Билеттин акчасына дагы ".$money." сом жетпей калды.";
    send_mail($to, $s, $body);
    send_sms($flight_row['phone'], $sms_body);
}

function send_extra_message_with_flight_row($flight_row){
    $to = $flight_row['email'];
    $s = "[translate]You overpaid for reservation ".$flight_row["paid_extra"]." сом";
    $body = "[translate]You overpaid for reservation ".$flight_row["paid_extra"]." сом.<br>
    Our staff will contact you soon to decide what to do with extra money
    ";
    $sms_body = "Билетке ".$flight_row["paid_extra"]." сом ашыкча толонду. Бул боюнча сиз менен байланышабыз.";
    send_mail($to, $s, $body);
    send_sms($flight_row['phone'], $sms_body);
}

function send_admin_fail_message_with_flight_row($flight_row){
    global $fly24_vars;
    $to = $fly24_vars['human_relations_mail'];
    $s = "[translate]Ошибка";
    $dept_time = date('d.m.Y H:s',$flight_row["departure_flight"]);
    $return_time="";
    if ($flight_row["return_flight"]) $return_time="[". date('d.m.Y H:s',$flight_row["return_flight"])."]";
    
    
    $body = "[translate]Client (".$flight_row["name"]." ".$flight_row["surname"].") paid for reservation but there was an error<br>
    Flight info:<br>
    Departure: ".$flight_row["departure"]."[".$dept_time."]<br>
    Destination: ".$flight_row["destination"].$return_time."<br>
    Price: ".$flight_row["price"]."<br>
    Paid: ".$flight_row["paid_sum"]."
    ";
    send_mail($to, $s, $body);
    send_sms("996777777890", "Билеттин акчасы толонду бирок билет сатылган жок. Проблема!!!");
}

function send_success_message_with_flight_row($flight_row){
    $to = $flight_row['email'];
    $s = "[translate]Ticket information";
    $body = "[translate]You've successfully bought ticket.<br>
    PNR CODE: ".$flight_row["pnrcode"]."<br>
    Departure: ".$flight_row["departure"]."<br>
    Destination: ".$flight_row["destination"]."<br>
    ";
    $sms_body = "Билетти ийгилитуу сатып алдыныз. ПНР код: ".$flight_row["paid_extra"].". Кененирээк маалымат электрондук почта аркылуу жиберилди.";
    send_mail($to, $s, $body);
    send_sms($flight_row['phone'], $sms_body);
    $ticket_body = "";
    //send_mail($to, $s, $ticket_body);
}
//end
    

// start getPNR function
function getPNR($flight_row){
$url = "https://prepws.flypgs.com/axis2/services/CraneOTAServiceV21?wsdl";
$xml = new SofeeXmlParser();

$return_xml = '';
if ($flight_2){
$return_departure_time = date('Y.m.d', strtotime($return->departureDateTime))."T".date('H:i:s', strtotime($return->departureDateTime));
$return_arrival_time = date('Y.m.d', strtotime($return->arrivalDateTime))."T".date('H:i:s', strtotime($return->arrivalDateTime));
$return_xml = '<typ:FlightSegment ArrivalDateTime="'.$______________.'" DepartureDateTime="'.$return_departure_time.'" FlightNumber="'.$return->flightNumber.'" JourneyDuration="1" OnTimeRate="1" ResBookDesigCode="'.$return->resBookDesigCode.'" ResBookDesigID="'.$return->resBookDesigID.'" StopQuantity="1" Ticket="1">
              <typ:DepartureAirport LocationCode="'.$return->departureAirport.'"/>
              <typ:ArrivalAirport LocationCode="'.$return->arrivalAirport.'"/>
              <typ:Equipment AirEquipType="'.$return->equipment.'" ChangeofGauge="1"/>
              <typ:MarkettingAirline CompanyShortName="'.$return->markettingAirline.'"/>
              <typ:MarketingCabin RPH="'.$return->rph.'" CabinType="'.$return->marketingCabin.'">
                <typ:Meal></typ:Meal>
              </typ:MarketingCabin>
              <typ:BookingClassAvail RPH="'.$return->rph.'" ResBookDesigCode="'.$return->resBookDesigCode.'" ResBookDesigQuantity="'.$return->resBookDesigQuantity.'"/>
              <typ:comment></typ:comment>
            </typ:FlightSegment>';
}

$departure_departure_time = date('Y.m.d', strtotime($departure->departureDateTime))."T".date('H:i:s', strtotime($departure->departureDateTime));
$departure_arrival_time = date('Y.m.d', strtotime($departure->arrivalDateTime))."T".date('H:i:s', strtotime($departure->arrivalDateTime));

$body = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:otab="http://otabase.otapax.otaxmlws/" xmlns:ota="http://ota.paxws.otaxmlws/" xmlns:typ="http://types.paxws.otaxmlws/">
  <soapenv:Header>
    <wsse:Security mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
      <wsse:UsernameToken>
        <wsse:Username>A813KN66</wsse:Username>
        <wsse:Password>SASA</wsse:Password>
      </wsse:UsernameToken>
    </wsse:Security>
  </soapenv:Header>
  <soapenv:Body>
    <otab:OTA_AirBookRQ SequenceNmbr="1" TimeStamp="1" ExtTransactionID="">
      <ota:POS>
        <typ:Source agentSine="BSIA1234PM" isoCountry="RU" isoCurrency="USD">
          <typ:RequestorID id="1" type="1" url="1"/>
          <typ:BookingChannel Primary="1" Type="1"/>
        </typ:Source>
      </ota:POS>
      <ota:AirItinerary DirectionInd="1">
        <typ:OriginDestinationOptions>
          <typ:OriginDestinationOption>
            <typ:FlightSegment ArrivalDateTime="'.$departure_arrival_time.'" DepartureDateTime="'.$departure_departure_time.'" FlightNumber="'.$departure->flightNumber.'" JourneyDuration="1" OnTimeRate="1" ResBookDesigCode="'.$departure->fareReference.'" ResBookDesigID="'.$departure->resBookDesigID.'" StopQuantity="1" Ticket="1">
              <typ:DepartureAirport LocationCode="'.$departure->departureAirport.'"/>
              <typ:ArrivalAirport LocationCode="'.$departure->arrivalAirport.'"/>
              <typ:Equipment AirEquipType="'.$departure->equipment.'" ChangeofGauge="1"/>
              <typ:MarkettingAirline CompanyShortName="PC"/>
              <typ:MarketingCabin RPH="'.$departure->rph.'" CabinType="'.$departure->marketingCabin.'">
                <typ:Meal></typ:Meal>
              </typ:MarketingCabin>
              <typ:BookingClassAvail RPH="'.$departure->rph.'" ResBookDesigCode="'.$departure->resBookDesigCode.'" ResBookDesigQuantity="'.$departure->resBookDesigQuantity.'"/>
              <typ:comment></typ:comment>
            </typ:FlightSegment>
            '.$return_xml.'
            <typ:dummy></typ:dummy>
          </typ:OriginDestinationOption>
          <typ:dummy></typ:dummy>
        </typ:OriginDestinationOptions>
      </ota:AirItinerary>
      
      <ota:TravelerInfo>';
      foreach($all as $passenger) {
      $passenger_birthdate = date('Y-m-d', strtotime($passenger->birthday));
$body .=  '<typ:AirTraveler PassengerTypeCode="'.$passenger_type_code[$passenger->type].'">
          <typ:ProfileRef>
            <typ:UniqueID ID="1" URL="1" Instance="1" Type="1"/>
          </typ:ProfileRef>
          <typ:PersonName>
            <typ:NamePrefix>MR</typ:NamePrefix>
            <typ:GivenName>'.$passenger->name_latin.'</typ:GivenName>
            <typ:Surname>'.$passenger->surname_latin.'</typ:Surname>
            <typ:NameTitle></typ:NameTitle>
          </typ:PersonName>
          <typ:Telephone AreaCityCode="" PhoneNumber=""/>
          <typ:Email>'.$email.'</typ:Email>
          <typ:Document BirthDate="'.$passenger_birthdate.'" DocID="" DocIssueAuthority="1" DocIssueLocation="1" DocType="1" EffectiveDate="1" ExpireDate="1" Gender="'.$passenger->sex.'">
            <typ:DocHolderName></typ:DocHolderName>
          </typ:Document>
        </typ:AirTraveler>';
}       
            
$body .=  '<typ:SpecialReqDetails>
          <typ:SeatRequests>
            <ota:item FlightRefNumberRPHList="1" SeatNumber="1" TravelerRefNumberRPHList="1"/>
          </typ:SeatRequests>
          
          <typ:SpecialServiceRequests>
            <typ:SpecialServiceRequest SSRCode="BILL" FlightRefNumberRPHList="1" TravelerRefNumberRPHList="1">
              <typ:Airline>PC</typ:Airline>
              <typ:text>401000143994</typ:text>
            </typ:SpecialServiceRequest>
            <typ:dummy>dummy</typ:dummy>
          </typ:SpecialServiceRequests>
          
        </typ:SpecialReqDetails>
      </ota:TravelerInfo>
      <ota:Ticketing TicketType="1"/>
    </otab:OTA_AirBookRQ>
  </soapenv:Body>
</soapenv:Envelope>
    '; /// Your SOAP XML needs to be in this variable
    
$headers = array(
    'Content-Type: text/xml; charset="utf-8"',
    'Content-Length: '.strlen($body),
    'Accept: text/xml',
    'Cache-Control: no-cache',
    'Pragma: no-cache',
    'SOAPAction: "Booking"'
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 60);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']);

// Stuff I have added
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

$data = curl_exec($ch);

$xml->parseFileFromString($data); 
$tree = $xml->getTree(); 
unset($xml); 
$book_reference = find_first_key($tree, "BookingReferenceID");
if( array_key_exists("ID", $book_reference) ){
        return $book_reference["ID"];
    }
return 0;
//print_r($book_reference);
}
// end getPNR
?>