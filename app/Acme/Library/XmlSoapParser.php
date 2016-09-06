<?php
namespace Acme\Library;

class XmlSoapParser
{
    private $array;
    
    public XmlSoapParser($response)
    {
        $response = preg_replace("/(<\/?)(\w+):([^>]*>)/", "$1$2$3", $response);
        $xml = new \SimpleXMLElement($response);
        $body = $xml->xpath('//soapenvBody')[0];
        $this->array = json_decode(json_encode((array)$body), TRUE); 
    }

    public getFlightSegments()
    {
        $flightSegments = array_get($this->array, "ns2OTA_AirAvailAndFaresRSType.OriginDestinationOptionsExt.OriginDestinationOptionExt");

        return $flightSegments;
    }

    public getFlightSegment($index)
    {
        $flightSegments = array_get($this->array, "ns2OTA_AirAvailAndFaresRSType.OriginDestinationOptionsExt.OriginDestinationOptionExt");

        return $flightSegment[$index];
    }
}
