<?php
namespace Acme\myClass;
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
    
    function updateSomPrice($rate, $fee=5){
        $this->adultPriceSom = $this->adultPrice > 0 ? ceil(($this->adultPrice+$fee) * $rate): 0; // 5$ service fee
        $this->childPriceSom = $this->adultPrice > 0 ? ceil(($this->childPrice+$fee) * $rate): 0; // 5$ service fee
        $this->infPriceSom = ceil($this->infPrice * $rate);
    }    
}
