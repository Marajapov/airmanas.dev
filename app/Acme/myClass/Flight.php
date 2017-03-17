<?php
namespace Acme\myClass;
use \Carbon\Carbon as Carbon;
class Flight {
    var $departureAirport;
    var $arrivalAirport;
    var $equipment;
    var $markettingAirline;
    var $marketingCabin;
    var $arrivalDateTime;
    var $departureDateTime;
    var $departureDate;
    var $flightNumber;
    var $onTimeRate ;
    var $stopQuantity;
    var $journeyDuration;
    var $ticket;
    
    var $fareReference;
    var $fareReferenceID;
    var $rph;
    var $adultPrice;
    var $childPrice;
    var $infPrice;
    var $adultPriceSom;
    var $childPriceSom;
    var $infPriceSom;
    var $resBookDesigID;
    var $resBookDesigCode;
    var $resBookDesigQuantity;
    
    var $timestamp;
    
    var $books = array();
    
    var $leastBook;
    
    function test(){
        echo $this->departureDateTime.": ".$this->departureAirport."->".$this->arrivalAirport." price: ".$this->adultPrice;
        print("<hr/>");
    }
    
    function departure_date(){

        if ($this->departureDateTime) return date('Y-m-d', strtotime($this->departureDateTime));
        else return $this->departureDate;
    }
    function departureDayru(){
        if($this->departureDateTime){
            setlocale(LC_TIME, 'ru_RU.UTF-8');
            $dt = Carbon::parse($this->departureDateTime);
            $dtRuday = $dt->formatLocalized('%d');
            return $dtRuday;
        }else{
            return $this->departureDate;
        }
    }
    function departureWeekru(){
        if($this->departureDateTime){
            setlocale(LC_TIME, 'ru_RU.UTF-8');
            $dt = Carbon::parse($this->departureDateTime);
            $dtRuweekday = $dt->formatLocalized('%A');
            return $dtRuweekday;
        }else{
            return $this->departureDate;
        }
    }
    function departureMonthru(){
        if($this->departureDateTime){
            setlocale(LC_TIME, 'ru_RU.UTF-8');
            $dt = Carbon::parse($this->departureDateTime);
            $dtRumonth = $dt->formatLocalized('%B');        
            return $dtRumonth;
        }else{
            return $this->departureDate;
        }
    }
    
    function updateSomPrice($rate, $fee=5){
        $this->adultPriceSom = $this->adultPrice > 0 ? ceil(($this->adultPrice+$fee) * $rate): 0; // 5$ service fee
        $this->childPriceSom = $this->adultPrice > 0 ? ceil(($this->childPrice+$fee) * $rate): 0; // 5$ service fee
        $this->infPriceSom = ceil($this->infPrice * $rate);
        //dd('rate '.$rate, 'fee '.$fee, 'adultPriceSom '.$this->adultPriceSom,'adultPrice '.$this->adultPrice,'adultprice + fee '.$this->adultPrice+$fee);
    }    
}
