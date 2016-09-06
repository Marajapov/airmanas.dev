<?php
$departure = 'DEL';
$departure_date = '2016-07-31';
$destination = 'DME';
$return_date = '2016-08-30';
$adult_count = 1;
$child_count =1;
$infant_count=1;

$url = "https://prepws.flypgs.com/axis2/services/CraneOTAServiceV21?wsdl";

$body = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" xmlns:SOAP-ENC="http://schemas.xmlsoap.org/soap/encoding/" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:m0="http://ota.paxws.otaxmlws/" xmlns:m1="http://types.paxws.otaxmlws/">
	  

	<SOAP-ENV:Header>
      	<wsse:Security SOAP-ENV:mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
         	<wsse:UsernameToken>
            	<wsse:Username>207DX77</wsse:Username>
            	<wsse:Password>SA</wsse:Password>
         	</wsse:UsernameToken>
      	</wsse:Security>
   	</SOAP-ENV:Header>

	  
	  <SOAP-ENV:Body>
      
      <otab:OTA_AirAvailAndFaresRQ DirectFlightsOnly="T" PrimaryLangID="1" SequenceNmbr="1234">
         <ota:POS>
            <typ:Source agentSine="1" isoCountry="RU" isoCurrency="USD">
               <typ:RequestorID id="1" type="1" url="1"/>
               <typ:BookingChannel Primary="1" Type="1"/>
            </typ:Source>
         </ota:POS>
         <ota:OriginDestinationInformation>
            <typ:DepartureDateTime>'.$departure_date.'</typ:DepartureDateTime>
            <typ:OriginLocation LocationCode="'.$departure.'"/>
            <typ:DestinationLocation LocationCode="'.$destination.'"/>
         </ota:OriginDestinationInformation>
         <ota:ReturnOriginDestinationInformation>
            <typ:ReturnDateTime>'.$return_date.'</typ:ReturnDateTime>
         </ota:ReturnOriginDestinationInformation>
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
   </SOAP-ENV:Body>
</SOAP-ENV:Envelope>'; /// Your SOAP XML needs to be in this variable

$headers = array( 
    'Content-Type: text/xml; charset="utf-8"', 
    'Content-Length: '.strlen($body), 
    'Accept: text/xml', 
    'Cache-Control: no-cache', 
    'Pragma: no-cache', 
    'SOAPAction: "AvailabilityAndFares"'
); 

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_URL, $url); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_TIMEOUT, 60); 
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_USERAGENT, $defined_vars['HTTP_USER_AGENT']);

// Stuff I have added
curl_setopt($ch, CURLOPT_POST, true); 
curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 

$data = curl_exec($ch); 

?>
<textarea><?php print_r($body); ?></textarea>
<textarea><?php print_r($data); ?></textarea>