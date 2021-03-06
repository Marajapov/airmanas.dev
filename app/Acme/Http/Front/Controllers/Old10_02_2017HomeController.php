<?php
namespace Front\Controllers;
use Illuminate\Http\Request;
use \Model\City\ModelName as City;
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
use \Carbon\Carbon as Carbon;
//use Barryvdh\DomPDF\ServiceProvider as PDF;

class HomeController extends Controller
{   
    protected $airport_loc, $exchange_value, $service_fee, $service_local_fee, $passenger_type, $passenger_type_code, $sex_type, $local_airports;

    public function __construct(){
        $this->airport_loc = City::lists('name','airport_code')->toArray();
        $this->exchange_value = 68;  // value of exchange USD
        $this->service_fee = 20; // 20 cent
        $this->service_local_fee = 5; // 5 com
        $this->passenger_type = array("adult"=>"Взрослый", "child"=>"Ребенок", "infant"=>"Младенец");
        $this->passenger_type_code = array("adult"=>"ADT", "child"=>"CHD", "infant"=>"INF");
        $this->sex_type = array("M"=>"Мужской", "F"=>"Женский");
        $this->local_airports = array("OSS", "FRU");
    }
    public function Home()
    {
        Carbon::setLocale('ru');
        session(['fly_days'=> NULL]);
        session(['fly_days_2'=> NULL]);
        session(['fly_days_3'=> NULL]);
        session(['fly_days_return'=> NULL]);
        session(['fly_days_return_2'=> NULL]);

        /*$row = FlightRegister::where('id','=',54)->first();
        mysend_mail($row, 'abakano21@gmail.com', 'fromHomeController', 'body text');
        dd(123);*/
        return view('Front::home', [
            'airport_loc'=> $this->airport_loc,
        ]);
    }
    public function searchResult(Request $request)
    {
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        $success = json_encode(array( 'result' => '1'));
        $fail = json_encode(array( 'result' => '0'));
        $departure = $_POST['departure'];
        $destination = $_POST['destination'];
        $adult_count = isset($_POST['adult_count'])?$_POST['adult_count']:0;
        $child_count = isset($_POST['child_count'])?$_POST['child_count']:0;
        $infant_count = isset($_POST['infant_count'])?$_POST['infant_count']:0;
        $today = date('Y-m-d');
        $departure_date = isset($_POST['departure_date'])?$_POST['departure_date']:$today;
        $return_date = isset($_POST['return_date'])?$_POST['return_date']:0;
        $flight_date = $flight_date_return = [];
        $day_diff = date_manual_diff($today, $departure_date);
        $start_dept_day = $today;
        
        if ($day_diff>0){ 
            $start_diff = $day_diff<4? $day_diff:3;
            $start_dept_day = date('Y-m-d', strtotime($departure_date. ' - '.$start_diff.' days'));
        }
        $flight_date[] =  $start_dept_day;
        $flight_date[] =  date('Y-m-d', strtotime($start_dept_day. ' + 1 days'));
        $flight_date[] =  date('Y-m-d', strtotime($start_dept_day. ' + 2 days'));
        $flight_date[] =  date('Y-m-d', strtotime($start_dept_day. ' + 3 days'));
        $flight_date[] =  date('Y-m-d', strtotime($start_dept_day. ' + 4 days'));
        $flight_date[] =  date('Y-m-d', strtotime($start_dept_day. ' + 5 days'));
        $flight_date[] =  date('Y-m-d', strtotime($start_dept_day. ' + 6 days'));
        if ($return_date) {
            $day_diff = date_manual_diff($start_dept_day, $return_date);
            $start_return_day = $start_dept_day;
            if ($day_diff>0){ 
                $start_diff = $day_diff<4? $day_diff:3;
                $start_return_day = date('Y-m-d', strtotime($return_date. ' - '.$start_diff.' days'));
            }
            $flight_date_return[] =  $start_return_day;
            $flight_date_return[] =  date('Y-m-d', strtotime($start_return_day. ' + 1 days'));
            $flight_date_return[] =  date('Y-m-d', strtotime($start_return_day. ' + 2 days'));
            $flight_date_return[] =  date('Y-m-d', strtotime($start_return_day. ' + 3 days'));
            $flight_date_return[] =  date('Y-m-d', strtotime($start_return_day. ' + 4 days'));
            $flight_date_return[] =  date('Y-m-d', strtotime($start_return_day. ' + 5 days'));
            $flight_date_return[] =  date('Y-m-d', strtotime($start_return_day. ' + 6 days'));
        }
    $fly_days = $fly_days_return = $ch = $ch_data = [];
    $time_1 = microtime(true);
    $url = "https://prepws.flypgs.com/axis2/services/CraneOTAServiceV21?wsdl";
    $xml = [];
    $mh = curl_multi_init();
    for($i=0;$i<count($flight_date); $i++) {
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
          <otab:OTA_AirAvailAndFaresRQ DirectFlightsOnly="T" PrimaryLangID="1" SequenceNmbr="1234">
             <ota:POS>
                <typ:Source agentSine="1" isoCountry="RU" isoCurrency="USD">
                   <typ:RequestorID id="1" type="1" url="1"/>
                   <typ:BookingChannel Primary="1" Type="1"/>
                </typ:Source>
             </ota:POS>
             <ota:OriginDestinationInformation>
                <typ:DepartureDateTime>'.$flight_date[$i].'</typ:DepartureDateTime>
                <typ:OriginLocation LocationCode="'.$departure.'"/>
                <typ:DestinationLocation LocationCode="'.$destination.'"/>
             </ota:OriginDestinationInformation>
             <ota:ReturnOriginDestinationInformation><typ:ReturnDateTime>';  
    if ($return_date)  $body .=$flight_date_return[$i];  
    $body .= '</typ:ReturnDateTime></ota:ReturnOriginDestinationInformation>
                <ota:TravelPreferences MaxStopsQuantity="1">
                <typ:FlightTypePref FlightType="D" PreferLevel="1"/>
                <typ:EquipPref AirEquipType="756"/>
                <typ:CabinPref Cabin="Y" PreferLevel="1"/>
                <typ:TicketDistribPref DistribType="1" PreferLevel="1"/>
                <typ:BookingClassPref ResBookDesigCode="2"/>
             </ota:TravelPreferences>
             <ota:TravelerInfoSummary>
                <typ:AirTravelerAvail>
                   <!--Zero or more repetitions:-->
                   <typ:PassengerTypeQuantity Code="ADT" Quantity="'.$adult_count.'"/>
                   <typ:PassengerTypeQuantity Code="INF" Quantity="'.$child_count.'"/>
                   <typ:PassengerTypeQuantity Code="CHD" Quantity="'.$infant_count.'"/>
                   <typ:temp>string</typ:temp>
                </typ:AirTravelerAvail>
             </ota:TravelerInfoSummary>
          </otab:OTA_AirAvailAndFaresRQ>
       </soapenv:Body>
    </soapenv:Envelope> '; /// Your SOAP XML needs to be in this variable
    $headers = array(
        'Content-Type: text/xml; charset="utf-8"',
        'Content-Length: '.strlen($body),
        'Accept: text/xml',
        'Cache-Control: no-cache',
        'Pragma: no-cache',
        'SOAPAction: "AvailabilityAndFares"'
    );
//    dd($body);
    $ch[$i] = curl_init() or die($fail);
    curl_setopt($ch[$i], CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch[$i], CURLOPT_URL, $url);
    curl_setopt($ch[$i], CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch[$i], CURLOPT_TIMEOUT, 60);
    curl_setopt($ch[$i], CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch[$i], CURLOPT_POST, true);
    curl_setopt($ch[$i], CURLOPT_POSTFIELDS, $body);
    curl_multi_add_handle($mh,$ch[$i]);
    $time_2 = microtime(true);
    }
    $results = array();
    $running = null;
        do {
            curl_multi_exec($mh, $running);
        }
        while ($running > 0);
        foreach ($ch as $key => $val) {
            $results[$key] = curl_multi_getcontent($val);
            //dd($results[$key]);
            curl_multi_remove_handle($mh, $val);
        }
    curl_multi_close($mh);
    $time_3 = microtime(true);
    for($i=0; $i<count($results); $i++){
        if (empty ($results[$i])) continue;
        $xml[$i] = new SofeeXmlParser();
        $xml[$i]->parseFileFromString($results[$i]); 
        $tree = $xml[$i]->getTree();
        $success_flag = find_first_key($tree, "Success");
        if ($success_flag){
            $fly_days[] = get_flights($tree, "OriginDestinationOptionsExt");
            if ($return_date) {
                $fly_days_return[] = get_flights($tree, "ReturnOriginDestinationOptionsExt");
            }
            $noFlight = 0;
        }else{
            $fly_days[] = get_flights($tree, "OriginDestinationOptionsExt");
            if ($return_date) {
                $fly_days_return[] = get_flights($tree, "ReturnOriginDestinationOptionsExt");
            }
            $noFlight = 1;
        }
        unset($xml[$i]); 
    }
    $time_4 = microtime(true);
    $fly_days_final = $return_days_final = [];
    foreach($flight_date as $day){
        $not_found = true;
        foreach($fly_days as $flight){
            /*
            setlocale(LC_TIME, 'ru_RU');
            $dt = Carbon::parse($flight[0]->departure_date());
            echo $dt->formatLocalized('%A %d %B %Y');
            */
            if (count($flight)==0) continue;
            if ($day == $flight[0]->departure_date()){
                $not_found = false;
                $fly_days_final[] = $flight;
            }
        }
        if ($not_found){
            $newFlight = new Flight();
            $newFlight->departureAirport = $departure;
            $newFlight->arrivalAirport = $destination;
            $newFlight->departureDate = $day;
            $newFlight->price = 0;
            $fly_days_final[] = array($newFlight);
        }else{
            $newFlight = new Flight();
            $noFlight = 1;
        }
    }
    $time_5 = microtime(true);
    if ($return_date) {
        foreach($flight_date_return as $day){
            $not_found = true;
            foreach($fly_days_return as $flight){
                if (count($flight)==0) continue;
                if ($day == $flight[0]->departure_date()){
                    $not_found = false;
                    $return_days_final[] = $flight;
                }
            }
            if ($not_found){
                $newFlight = new Flight();
                $newFlight->departureAirport = $departure;
                $newFlight->arrivalAirport = $destination;
                $newFlight->departureDate = $day;
                $newFlight->price = 0;
                $return_days_final[] = array($newFlight);
            }else{
                $newFlight = new Flight();
                $noFlight = 1;
            }
        }
    }
    $time_6 = microtime(true);
    //dd($fly_days_final,$return_days_final);
    session_start();
    $_SESSION["fly_days"] = $fly_days_final;
    $_SESSION["fly_days_2"] = $_SESSION["fly_days"];
    if ($return_date){
      $_SESSION["fly_days_return"] = $return_days_final;  
      $_SESSION["fly_days_return_2"] = $_SESSION["fly_days_return"];
    }
    if ($return_date) $retn_d = strtotime($return_date);
    foreach($fly_days as $fly_days_child) 
        foreach($fly_days_child as $fly_days_child_flight) 
            $fly_days_child_flight->updateSomPrice($this->exchange_value, $this->service_fee);
   if ($fly_days_return){
        foreach($fly_days_return as $fly_days_child){
            foreach($fly_days_child as $fly_days_child_flight) {
                $fly_days_child_flight->updateSomPrice($this->exchange_value, $this->service_fee);    
            } // end foreach
        } // end foreach
    } // end if
    $retn_d = (isset($retn_d)) ? $retn_d : 'no';
    //dd($fly_days_final,$return_days_final);
    // new way 
    foreach ($flight_date as $key => $newValue) {
        setlocale(LC_TIME, 'ru_RU.UTF-8');
        $carbonFlight_date[] = Carbon::parse($newValue);
    }
    $dept_d = Carbon::parse($departure_date);
    
    return view('Front::result', [
            'carbonFlight_date'=> $carbonFlight_date,
            'bugun' => Carbon::today(),
            'Flight' => $newFlight,
            'departure'=> $departure,
            'destination'=> $destination,
            'airport_loc' => $this->airport_loc,
            'local_airports' => $this->local_airports,
            'dept_d' => $dept_d,
            'retn_d' => $retn_d,
            'service_fee' => $this->service_fee,
            'service_local_fee' => $this->service_local_fee,
            'passenger_type' => $this->passenger_type,
            'passenger_type_code' => $this->passenger_type_code,
            'sex_type' => $this->sex_type,
            'o'=> $departure,
            'od'=> strtotime($departure_date),
            'd'=> $destination,
            'dd'=> strtotime($return_date),
            'return_date'=> strtotime($return_date),
            'a'=> $adult_count,
            'adult_count'=> $adult_count,
            'child_count'=> $child_count,
            'c'=> $child_count,
            'i'=> $infant_count,
            'infant_count'=> $infant_count,
            'fly_days'=> $fly_days,
            'fly_days_return'=> $fly_days_return, 
            //'fly_days_child_flight'=> $fly_days_child_flight,

            'return_days_final' => $return_days_final,
            'noFlight' => $noFlight,
            
        ]);
    }

    public function passenger(Request $request)
    {
        session_start();
        $adult_count = intval($_POST['adult_count']);
        $child_count = intval($_POST['child_count']);
        $infant_count = intval($_POST['infant_count']);
        $total = $adult_count + $child_count + $infant_count;
        $counter = 0;
        $flight_1 = intval($_POST['flight_1']);
        $flight_2 = intval($_POST['flight_2']);
        $fly_days = $_SESSION['fly_days_2'];

        $fly_days_return = (isset($_SESSION["fly_days_return_2"])) ? $_SESSION["fly_days_return_2"] : 'no';
        $departure = $return = NULL;
        if ($flight_1)
            for($i=0; $i<count($fly_days); $i++){
                for($j=0; $j<count($fly_days[$i]); $j++) 
                    if ($fly_days[$i][$j]->timestamp == $flight_1){
                        $departure = $fly_days[$i][$j];
                        
                        break;
                    }
                if ($departure) break;
            }

        
        
        if ($flight_2)
            for($i=0; $i<count($fly_days_return); $i++){
                for($j=0; $j<count($fly_days_return[$i]); $j++) 
                    if ($fly_days_return[$i][$j]->timestamp == $flight_2){
                        $return = $fly_days_return[$i][$j];
                        break;
                    }
                if ($return) break;
            }
        
        $departureDT = date('Y-m-d H:i:s',strtotime($departure->departureDateTime));
        $departureADT= date('Y-m-d H:i:s',strtotime($departure->arrivalDateTime));

        $returnDT = ($flight_2)?date('Y-m-d H:i:s',strtotime($return->departureDateTime)):0;
        $returnADT = ($flight_2)?date('Y-m-d H:i:s',strtotime($return->arrivalDateTime)):0;
        
        //dd($departureDT,$departureADT,$returnDT,$returnADT);
        
        $this_year = intval(date("Y"));
        $_SESSION['fly_days_3'] = $_SESSION['fly_days_2'];
        $_SESSION['fly_days_return_3'] = (isset($_SESSION["fly_days_return_2"])) ? $_SESSION["fly_days_return_2"] : 'no';
        $_SESSION['fly_days_2'] =(isset($_SESSION["fly_days_return_2"])) ? $_SESSION["fly_days_return_2"] : 'no';
     return view('Front::passenger', [
                'this_year'=> $this_year,
                'return'=> $return,
                'departure' => $departure,
                'flight_1'=> $flight_1,
                'flight_2'=> $flight_2,
                'total'=> $total,
                'counter'=> $counter,
                'infant_count'=> $infant_count,
                'child_count'=> $child_count,
                'adult_count'=> $adult_count,
                'departureDT'=> $departureDT,
                'departureADT' => $departureADT,
            ]);   
    }
    public function flight_preview(Request $request) 
    {
        session_start();
        $departureFlightNumber = intval($_POST['departureFlightNumber']);
        $postreturnFlightNumber = intval($_POST['returnFlightNumber']);
        $returnFlightNumber = ($postreturnFlightNumber != 0) ? $postreturnFlightNumber: 0;

        $departureDateTime = $_POST['departureDateTime'];
        $departureArrivalDateTime = $_POST['departureArrivalDateTime'];

        //dd($departureDateTime,$departureArrivalDateTime);

        $returnDateTime = ($_POST['returnDateTime'] != 0) ? $_POST['returnDateTime']: 0;
        $returnArrivalDateTime = ($_POST['returnArrivalDateTime'] != 0) ? $_POST['returnArrivalDateTime']: 0;
        
        $departureFareReference = $_POST['departureFareReference'];
        $returnFareReference = ($_POST['returnFareReference'] != 0) ? $_POST['returnFareReference']: 0;

        //dd($departureFlightNumber,$returnFlightNumber,$departureDateTime,$departureArrivalDateTime,$returnDateTime,$returnArrivalDateTime,$departureFareReference,$returnFareReference);

        if (!$_SESSION["fly_days_3"]) redirect("front.home");        
        $ip = $_SERVER['REMOTE_ADDR'];
        $name = $_POST["name"];
        $surname = $_POST["surname"];
        $phone = $_POST["phone"];
        $email = $_POST["email"];
        $total_count = intval($_POST['total']);
        $adult_count = intval($_POST['adult_count']);
        $child_count = intval($_POST['child_count']);
        $infant_count = intval($_POST['infant_count']);        
        $total = $adult_count + $child_count + $infant_count;
        $flight_1 = intval($_POST['flight_1']);
        $flight_2 = intval($_POST['flight_2']);
        $fly_days = $_SESSION["fly_days_3"];
        $fly_days_return = $_SESSION["fly_days_return_3"];
        $counter = 0;
        
        $departure = $return = NULL;
        if ($flight_1)
            for($i=0; $i<count($fly_days); $i++){
                for($j=0; $j<count($fly_days[$i]); $j++) 
                    if ($fly_days[$i][$j]->timestamp == $flight_1){
                        $departure = $fly_days[$i][$j];
                        break;
                    }
                if ($departure) break;
            }
        // Time
        $hour = 60*60;
        $diff = floor(($flight_1 - time()) / $hour);
        if ($diff < 6) die("[translate]Less than 6 hours error!"); 
        $countdown = 6 * $hour;        
        if ($diff < 24) $countdown = $hour;
        else if ($diff < 48) $countdown = 2 * $hour;
        else if ($diff < 72) $countdown = 3 * $hour;
        $countdown_in_hours = $countdown / $hour;
        $timeInFuture = time() + $countdown;
        // end time
        if ($flight_2)
            for($i=0; $i<count($fly_days_return); $i++){
                for($j=0; $j<count($fly_days_return[$i]); $j++) 
                    if ($fly_days_return[$i][$j]->timestamp == $flight_2){
                        $return = $fly_days_return[$i][$j];
                        break;
                    }
                if ($return) break;
            }
        $all = array();
        for($adult_c=0; $adult_c < $adult_count; $adult_c++) {
            $pass = new Passenger();
            $pass->type="adult";
            $pass->sex = isset($_POST["sex".$counter])?$_POST["sex".$counter]:"M";
            $pass->name = $_POST["name".$counter];
            $pass->surname = $_POST["surname".$counter];
            $pass->name_latin = transliterate($pass->name);
            $pass->surname_latin = transliterate($pass->surname);
            $pass->bd_day = intval($_POST["bd_day".$counter]);
            $pass->bd_month = intval($_POST["bd_month".$counter]);
            $pass->bd_year = intval($_POST["bd_year".$counter]);
            check4passengerdata($pass->name, $pass->surname,  $pass->bd_day, $pass->bd_month, $pass->bd_year);
            $pass->birthday_string = $pass->bd_year."-".$pass->bd_month."-".$pass->bd_day;
            $pass->birthday = mktime(0, 0, 0, $pass->bd_month, $pass->bd_day, $pass->bd_year);
            $realAge = checkPassengerAge($pass->birthday);
            if ($realAge<3) $pass->type="infant";
                else if ($realAge<13) $pass->type="child";
            $all[] = $pass;
            $counter++;
        }
        for($infant_c=0; $infant_c < $infant_count; $infant_c++) {
            $pass = new Passenger();
            $pass->type="infant";
            $pass->sex = isset($_POST["sex".$counter])?$_POST["sex".$counter]:"M";
            $pass->name = $_POST["name".$counter];
            $pass->surname = $_POST["surname".$counter];
            $pass->name_latin = transliterate($pass->name);
            $pass->surname_latin = transliterate($pass->surname);
            $pass->bd_day = intval($_POST["bd_day".$counter]);
            $pass->bd_month = intval($_POST["bd_month".$counter]);
            $pass->bd_year = intval($_POST["bd_year".$counter]);
            check4passengerdata($pass->name, $pass->surname,  $pass->bd_day, $pass->bd_month, $pass->bd_year);
            $pass->birthday = mktime(0, 0, 0, $pass->bd_month, $pass->bd_day, $pass->bd_year);
            $pass->birthday_string = $pass->bd_year."-".$pass->bd_month."-".$pass->bd_day;
            $realAge = checkPassengerAge($pass->birthday);
            if ($realAge>12) $pass->type="adult";
                else if ($realAge>2) $pass->type="child";
            $all[] = $pass;
            $counter++;
        }
        for($child_c=0; $child_c < $child_count; $child_c++) {
            $pass = new Passenger();
            $pass->type="child";
            $pass->sex = isset($_POST["sex".$counter])?$_POST["sex".$counter]:"M";
            $pass->name = $_POST["name".$counter];
            $pass->surname = $_POST["surname".$counter];
            $pass->name_latin = transliterate($pass->name);
            $pass->surname_latin = transliterate($pass->surname);
            $pass->bd_day = intval($_POST["bd_day".$counter]);
            $pass->bd_month = intval($_POST["bd_month".$counter]);
            $pass->bd_year = intval($_POST["bd_year".$counter]);
            check4passengerdata($pass->name, $pass->surname,  $pass->bd_day, $pass->bd_month, $pass->bd_year);
            $pass->birthday = mktime(0, 0, 0, $pass->bd_month, $pass->bd_day, $pass->bd_year);
            $pass->birthday_string = $pass->bd_year."-".$pass->bd_month."-".$pass->bd_day;
            $realAge = checkPassengerAge($pass->birthday);
            if ($realAge>12) $pass->type="adult";
                else if ($realAge<3) $pass->type="infant";
            $all[] = $pass;
            $counter++;
        }
        
        if ($adult_c!=$adult_count || $child_c!=$child_count || $infant_c!=$infant_count){
            error_die("passenger count error!");
        }
        $price = 0;
        foreach($all as $pass){
            $this_price = $departure->adultPriceSom;
            if ($pass->type=='infant') $this_price = $departure->infPriceSom;
            else if ($pass->type=='child') $this_price = $departure->childPriceSom;
            $price += $this_price;

            if ($return){
                $this_price = $return->adultPriceSom;
                if ($pass->type=='infant') $this_price = $return->infPriceSom;
                else if ($pass->type=='child') $this_price = $return->childPriceSom;
                $price += $this_price;
            }
        }
        $allFlightRegister = FlightRegister::get();
        $random = generateRandomPayCode_helper();
        $paycodeSearch = FlightRegister::where("paycode","=",$random)->first();
        while($paycodeSearch["id"] > 0){
        $random = generateRandomPayCode_helper();
        $paycodeSearch = FlightRegister::where("paycode","=",$random)->first();
        }
        $table = FlightRegister::create();
            $table->ip = $ip;
            $table->name = $name;
            $table->surname = $surname;
            $table->phone = $phone;
            $table->email = $email;
            $table->price = $price;
            $table->departure = $departure->departureAirport;
            $table->destination = $departure->arrivalAirport;
            $table->departure_flight = $flight_1;
            $table->departure_departure_date_time = $departureDateTime;
            $table->departure_arrival_date_time = $departureArrivalDateTime;
            $table->return_flight = $flight_2;
            $table->return_departure_date_time = $returnDateTime;
            $table->return_arrival_date_time = $returnArrivalDateTime;
            $table->pay_till = date("Y-m-d H:i:s", $timeInFuture);
            $table->paycode = $random;
            $table->departureFlightNumber = $departureFlightNumber;
            $table->departureResBookDesigCode = $departure->resBookDesigCode;
            $table->departureResBookDesigID = $departure->resBookDesigID;
            $table->departureEquipment = $departure->equipment;
            $table->departureMarkettingAirline = $departure->markettingAirline; 
            $table->departureRph = $departure->rph;
            $table->departureMarketingCabin = $departure->marketingCabin;
            $table->departureResBookDesigQuantity = $departure->resBookDesigQuantity;
            $table->departureFareReference = $departureFareReference;
            if($return){
                $table->returnFlightNumber = $returnFlightNumber;
                $table->returnResBookDesigCode = $return->resBookDesigCode;
                $table->returnResBookDesigID = $return->resBookDesigID;
                $table->returnEquipment = $return->equipment;
                $table->returnMarkettingAirline = $return->markettingAirline;
                $table->returnRph = $return->rph;
                $table->returnMarketingCabin = $return->marketingCabin;
                $table->returnResBookDesigQuantity = $return->resBookDesigQuantity;
                $table->returnFareReference = $return->fareReference;
            }
            $table->save();

        // end

        $flight_row = FlightRegister::where("paycode","=",$random)->first();
        if ($flight_row['id']>0){
        foreach($all as $pass){
            $tablePassenger = PassengerModel::create();
            $tablePassenger->sex = $pass->type;
            $tablePassenger->name = $pass->name;
            $tablePassenger->surname = $pass->surname;
            $tablePassenger->name_latin = $pass->name_latin;
            $tablePassenger->surname_latin = $pass->surname_latin;
            $tablePassenger->birthday = $pass->birthday_string;
            $tablePassenger->flight = $flight_row['id'];
            $tablePassenger->save();
            
            }   
        }
        $return = (isset($return)) ? $return : 0;       

        //dd($flight_1,$flight_2,$all,$departure,$return);
        
        // uncomend after testing
        //send_sms($phone, "Терминалдан билет сатып алуу номери: ".$random." Баасы: ".$price." сом. Убакыт: ".$countdown_in_hours." саат");
            
       //dd($departure, $return,$flight_1,$flight_2);
        return view('Front::flight_preview', [
                'ip'=>$ip,
                'name'=>$name,
                'surname'=>$surname,
                'phone'=>$phone,
                'email'=>$email,

                'total_count'=>$total_count,
                'adult_count'=>$adult_count,
                'child_count'=>$child_count,
                'infant_count'=>$infant_count,
                'total'=>$total,
                'countdown'=> $countdown,

                'departure'=> $departure,
                'return'=> $return,
                'all'=> $all,

                'passenger_type'=> $this->passenger_type,
                'passenger_type_code'=> $this->passenger_type_code,
                'sex_type'=> $this->sex_type,
                'paycode'=>$random,

                'flight_1'=> $flight_1,
                'flight_2'=> $flight_2,
            ]);   
    }

    
    public function payQiwi(Request $request)
    {
    $this_username = 'qiwi';
    $this_password = '7789105089';
    $service_name = 'Qiwi';
/*
    if (!isset($_SERVER['PHP_AUTH_USER'])) {
        header('WWW-Authenticate: Basic realm="My Realm"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'login failed';
        exit;
    } else {
        $uname = $_SERVER['PHP_AUTH_USER'];
        $pass = $_SERVER['PHP_AUTH_PW'];
        if ($uname != $this_username || $pass != $this_password) {
            echo 'login failed';
            exit;
        }
    }*/

    // require_once "../../class/classloader.php";
    // require_once "../../class/functions.php";
    // require_once "../../class/pay_functions.php";
    // require_once "../../class/getPNR.php";
    // require_once "../../class/sms_functions.php";
    
    $command = $request->get('command');
    $acc = $request->get('account');
    $txn_id = (int)$request->get('txn_id');
    $sum = (int)$request->get('sum');
    //dd($command,$account,$txn_id,$sum);
    
    //header("Content-type: text/xml");
    //dd($command);
    if (isset($command)){

        $comment = '';
        $txn_date = date("Y-m-d H:i:s");
        
        if ($command =='check'){
            //dd('check is starting ...');
            $result = check_account($acc, $txn_id);
            //dd('check is ok');
        }
        if ($command =='pay'){
            //dd('pay is starting ...');
            $row = FlightRegister::where('paycode','=',$acc)->first();
            $ddt = $row->departure_departure_date_time;
            $prv_txn = generateRandomPayCode_helper();
            //dd('abakan',$ddt,$row->departure_date_time,$row);
        //    dd($acc,$txn_id,$sum,$prv_txn,$service_name);

            $result = check_pay_account($acc, $txn_id,$sum, $prv_txn, $service_name, $ddt);

        }
    }
    }
    
    
    // Functins
    // check_account function
        
    
    // Sms functions
     function generateUniqueSMSID() {
        $characters = '0123456789';
        $randomString = '';
        for ($i = 0; $i < 6; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
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


    //  Routes for work with Mobilnik
    public function getAirports(Request $request)
    {
        $airports = City::lists('name','airport_code')->toArray();
        $jsonAirports = json_encode($airports,JSON_UNESCAPED_UNICODE);
        
        return $jsonAirports;

    }

}
