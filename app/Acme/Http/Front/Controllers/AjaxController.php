<?php

namespace Front\Controllers;

use Request;
use Input;
use App\Http\Requests;
use \Model\City\ModelName as City;
use \Model\Ttransactlog\ModelName as Ttransactlog;
use \Model\Ttransact\ModelName as Ttransact;
use \Model\UserMoney\ModelName as UserMoney;

use \Model\Tuser\ModelName as Tuser;
use \Model\FlightRegister\ModelName as FlightRegister;
use \Model\Passenger\ModelName as PassengerModel;

use \Acme\myClass\Flight as Flight;
use \Acme\myClass\Passenger as Passenger;
use \Acme\myClass\SofeeXmlParser as SofeeXmlParser;
use \Acme\myClass\Book;
use \Acme\myClass\Price;
use \Acme\myClass\Tax;
use \Carbon\Carbon as Carbon;

class AjaxController extends Controller
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

    // AJAX CALL

    public function loadCities()
    {
        if(Request::ajax()) {
            $data = Input::all();

            $cities = City::where('status','<>','deleted')->where('district_id','=',$data['id'])->get();
            $result = "";
            foreach($cities as $city){
                $result .= '<option value="'.$city->id.'">'.$city->name.'</option>';
            }
            return $result;
        }
    }

    public function pickDate()
    {

        if(Request::ajax()) {
            $data = Input::all();
            $pickDate = date('Y-m-d',strtotime($data['date']));
            $fly_days = session()->get("fly_days");
            $body = '';
            $airport_loc = session()->get("airport_loc");
            for($i=0; $i<count($fly_days); $i++){
                for($j=0; $j<count($fly_days[$i]); $j++){
                    $ddt_str = $fly_days[$i][$j]->departureDateTime;
                    $adt_str = $fly_days[$i][$j]->arrivalDateTime;
                    $ddt = strtotime($ddt_str);
                    $adt = strtotime($adt_str);
                    $selectedDate = strtotime($fly_days[$i][$j]->departure_date());
                    
                        if($selectedDate == strtotime($pickDate)){
                            $body .='<tr data-price="'.$fly_days[$i][$j]->adultPriceSom.'" data-child-price="'.$fly_days[$i][$j]->childPriceSom.'" data-infant-price="'.$fly_days[$i][$j]->infPriceSom.'" data-number="'.$fly_days[$i][$j]->flightNumber.'" data-from-date="'.date('d.m.Y', $ddt).'" data-from-time="'.date('H:i', $ddt).'" data-from-city="'.$airport_loc[$fly_days[$i][$j]->departureAirport].'" data-from-airport="'.$fly_days[$i][$j]->departureAirport.'" data-to-date="'.date('d.m.Y', $adt).'" data-to-time="'.date('H:i', $adt).'" data-to-city="'.$airport_loc[$fly_days[$i][$j]->arrivalAirport].'" data-to-airport="'.$fly_days[$i][$j]->arrivalAirport.'" data-timestamp="'.$fly_days[$i][$j]->timestamp.'">
                                <td class="flight">'.$fly_days[$i][$j]->flightNumber .'</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">'. date('H:i', strtotime($fly_days[$i][$j]->departureDateTime)) .'</span>
                                        <span class="place">
                                        '.$airport_loc[$fly_days[$i][$j]->departureAirport].'
                                    </span>
                                    </div>
                                    <div class="divider grid grid-20">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
            <g>
                <g>
                    <path d="M15.6,13.6l7.5-0.8c0.1,0,0.2-0.1,0.3-0.1l0.4-0.4c0.2-0.2,0.2-0.5,0-0.7l-0.4-0.4c-0.1-0.1-0.2-0.1-0.3-0.1l-7.5-0.7
                        L8.8,1.6C8.7,1.5,8.6,1.4,8.5,1.4H6.9C6.6,1.4,6.4,1.7,6.5,2l3.3,8.4L3,11.2L1.2,8.4C1.1,8.3,0.9,8.2,0.9,8.2H0.5
                        C0.2,8.2,0,8.5,0.1,8.8l1,3.2l-1,3.2c-0.1,0.3,0.1,0.6,0.4,0.6h0.4c0.2,0,0.3-0.1,0.3-0.2L3,12.8l6.8,0.8L6.5,22
                        c-0.1,0.3,0.1,0.6,0.4,0.6h1.6c0.2,0,0.3-0.1,0.3-0.2L15.6,13.6z"/>
                </g>
            </g>
            </svg>
                                    </div>
                                    <div class="arr-info text-left grid grid-40">
                                        <span class="time">'. date('H:i', strtotime($fly_days[$i][$j]->arrivalDateTime)) .'</span>
                                        <span class="place">
                                        '.$airport_loc[$fly_days[$i][$j]->arrivalAirport].'
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    '.$fly_days[$i][$j]->adultPriceSom .'
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                     <button class="btn btn-buy-dep">
                                        выбрать
                                    </button>
                                </td>
                            </tr>';
                        }
                }
            } // end for
            return $body;
        }
    }

    public function pickDateReturn()
    {

        if(Request::ajax()) {
            $data = Input::all();
            $pickDate = date('Y-m-d',strtotime($data['date_return']));
            $fly_days_return = session()->get("fly_days_return");
            $body = '';
            for($i=0; $i<count($fly_days_return); $i++){
                $jcounter = 0;
                for($j=0; $j<count($fly_days_return[$i]); $j++){

                    $ddt_str = $fly_days_return[$i][$j]->departureDateTime;
                    $adt_str = $fly_days_return[$i][$j]->arrivalDateTime;
                    $ddt = strtotime($ddt_str);
                    $adt = strtotime($adt_str);

                    $selectedDate = strtotime($fly_days_return[$i][$j]->departure_date());
                        if($selectedDate == strtotime($pickDate)){
                            $body .='<tr data-price="'.$fly_days_return[$i][$j]->adultPriceSom.'" data-child-price="'.$fly_days_return[$i][$j]->childPriceSom.'" data-infant-price="'.$fly_days_return[$i][$j]->infPriceSom.'" data-number="'.$fly_days_return[$i][$j]->flightNumber.'" data-from-date="'.date('d.m.Y', $ddt).'" data-from-time="'.date('H:i', $ddt).'" data-from-city="'.$fly_days_return[$i][$j]->departureAirport.'" data-from-airport="'.$fly_days_return[$i][$j]->departureAirport.'" data-to-date="'.date('d.m.Y', $adt).'" data-to-time="'.date('H:i', $adt).'" data-to-city="'.$fly_days_return[$i][$j]->arrivalAirport.'" data-to-airport="'.$fly_days_return[$i][$j]->arrivalAirport.'" data-timestamp="'.$fly_days_return[$i][$j]->timestamp.'">
                                <td class="flight">'.$fly_days_return[$i][$j]->flightNumber .'</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">'. date('H:i', strtotime($fly_days_return[$i][$j]->departureDateTime)) .'</span>
                                        <span class="place">
                                        '.$fly_days_return[$i][$j]->departureAirport.'
                                    </span>
                                    </div>
                                    <div class="divider grid grid-20">
                                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
            <g>
                <g>
                    <path d="M15.6,13.6l7.5-0.8c0.1,0,0.2-0.1,0.3-0.1l0.4-0.4c0.2-0.2,0.2-0.5,0-0.7l-0.4-0.4c-0.1-0.1-0.2-0.1-0.3-0.1l-7.5-0.7
                        L8.8,1.6C8.7,1.5,8.6,1.4,8.5,1.4H6.9C6.6,1.4,6.4,1.7,6.5,2l3.3,8.4L3,11.2L1.2,8.4C1.1,8.3,0.9,8.2,0.9,8.2H0.5
                        C0.2,8.2,0,8.5,0.1,8.8l1,3.2l-1,3.2c-0.1,0.3,0.1,0.6,0.4,0.6h0.4c0.2,0,0.3-0.1,0.3-0.2L3,12.8l6.8,0.8L6.5,22
                        c-0.1,0.3,0.1,0.6,0.4,0.6h1.6c0.2,0,0.3-0.1,0.3-0.2L15.6,13.6z"/>
                </g>
            </g>
            </svg>
                                    </div>
                                    <div class="arr-info text-left grid grid-40">
                                        <span class="time">'. date('H:i', strtotime($fly_days_return[$i][$j]->arrivalDateTime)) .'</span>
                                        <span class="place">
                                        '.$fly_days_return[$i][$j]->arrivalAirport.'
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    '.$fly_days_return[$i][$j]->adultPriceSom .'
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                     <button class="btn btn-buy-arr">
                                        Купить
                                    </button>
                                </td>
                            </tr>';
                        }
                }
            } // end for
            return $body;
        }
    }

    public function searchResult(Request $request)
    {
        $_SESSION["fly_days"] = $_SESSION["fly_days_return"] = NULL;
        $_SESSION["fly_days_2"] = $_SESSION["fly_days_return_2"] = NULL;
        $_SESSION["fly_days_3"] = $_SESSION["fly_days_return_3"] = NULL;
        
        $departure = isset($_POST['departure'])?$_POST['departure']:"";
        $departure_date = isset($_POST['departure_date'])?$_POST['departure_date']:0;
        $destination = isset($_POST['destination'])?$_POST['destination']:"";
        $return_date = isset($_POST['return_date'])?$_POST['return_date']:"";

        $adult_count = $_POST['adult_count'];
        $child_count = $_POST['child_count'];
        $infant_count = $_POST['infant_count'];
    return view('Front::ajaxCall', [
            'departure'=> $departure,
            'departure_date'=> $departure_date,
            'destination'=> $destination,
            'return_date'=> $return_date,
            'adult_count'=> $adult_count,
            'child_count'=> $child_count,
            'infant_count'=> $infant_count,
        ]);
    }

    public function ajaxRequest(Request $request)
    {
        $sessionStatus = session_status();
        if($sessionStatus == PHP_SESSION_NONE){

        }else{
            $_SESSION["fly_days"] = $_SESSION["fly_days_return"] = NULL;
            $_SESSION["fly_days_2"] = $_SESSION["fly_days_return_2"] = NULL;
            $_SESSION["fly_days_3"] = $_SESSION["fly_days_return_3"] = NULL;    
            session_destroy();
        }
        

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
        session_start();
        $_SESSION["fly_days"] = $fly_days_final;

        if ($return_date) $_SESSION["fly_days_return"] = $return_days_final;
        echo $success;

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
        echo $success;

    } // end ajaxRequest function

    public function showResult(Request $request)
    {
        session_start();
        $fly_days = $_SESSION["fly_days"];
        $fly_days_return = isset($_SESSION["fly_days_return"])?$_SESSION["fly_days_return"]:0;

        $dept_d = strtotime($request::get('od'));
        $return_date = ($request::get('dd') != 0)?$request::get('dd'):0;

        if ($return_date){ $retn_d = strtotime($request::get('dd'));} 

        return view('Front::result', [
            'departure'=>$request::get('o'),
            'departure_date'=>$request::get('od'),
            'destination'=>$request::get('d'),
            'return_date'=>$request::get('dd'),
            'adult_count'=>$request::get('a'),
            'child_count'=>$request::get('c'),
            'infant_count'=>$request::get('i'),
            'local_airports'=>$this->local_airports,
            'airport_loc'=>$this->airport_loc,
            'service_local_fee'=>$this->service_local_fee,
            'fly_days'=>$fly_days,
            'fly_days_return'=>$fly_days_return,
            'dept_d'=>$dept_d,
            'return_date'=>$return_date,
        ]);
    }


    // to show Ajax loading page
     public function showAjaxLoading(Request $request)
    {
        $departure = isset($_POST['departure'])?$_POST['departure']:"";
        $departure_date = isset($_POST['departure_date'])?$_POST['departure_date']:0;
        $destination = isset($_POST['destination'])?$_POST['destination']:"";
        $return_date = isset($_POST['return_date'])?$_POST['return_date']:"";

        $adult_count = $_POST['adult_count'];
        $child_count = $_POST['child_count'];
        $infant_count = $_POST['infant_count'];
        
        return view('Front::ajaxCall', [
            'departure'=> $departure,
            'departure_date'=> $departure_date,
            'destination'=> $destination,
            'return_date'=> $return_date,
            'adult_count'=> $adult_count,
            'child_count'=> $child_count,
            'infant_count'=> $infant_count,
        ]);
    }

} // end of class AjaxController