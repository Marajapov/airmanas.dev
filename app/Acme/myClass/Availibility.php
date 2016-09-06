<?php
namespace Acme\myClass;
use \Acme\myClass\Flight as Flight;

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
				if (isset($book_v['RPH']))	$book->rph = $book_v['RPH']; else $book->rph = "";
				if (isset($book_v['ResBookDesigCode']))	$book->resBookDesigCode = $book_v['ResBookDesigCode']; else $book->resBookDesigCode = "";
				if (isset($book_v['ResBookDesigQuantity']))	$book->resBookDesigQuantity = $book_v['ResBookDesigQuantity']; else $book->resBookDesigQuantity = "";
				if (isset($book_v['ResBookDesigID']))	$book->resBookDesigID = $book_v['ResBookDesigID']; else $book->resBookDesigID = "";
				if (isset($book_v['FareReference']))	$book->fareReference = $book_v['FareReference']; else $book->fareReference = "";
				if (isset($book_v['FareReferenceID']))	$book->fareReferenceID = $book_v['FareReferenceID']; else $book->fareReferenceID = "";
				if (isset($book_v['FareDisplayInfos']))	$price_info = find_all_keys($book_v['FareDisplayInfos'], 'FareDisplayInfo'); else $price_info = Null;
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