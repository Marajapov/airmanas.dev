
$body1 = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:otab="http://otabase.otapax.otaxmlws/" xmlns:ota="http://ota.paxws.otaxmlws/" xmlns:typ="http://types.paxws.otaxmlws/">
  <soapenv:Header>
    <wsse:Security mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
      <wsse:UsernameToken>
        <wsse:Username>11111</wsse:Username>
        <wsse:Password>21212</wsse:Password>
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


          <typ:FlightSegment ArrivalDateTime="'.$departure_arrival_date_time.'" DepartureDateTime="'.$departure_departure_date_time.'"  FlightNumber="'.$row->departureFlightNumber.'" JourneyDuration="1" OnTimeRate="1" ResBookDesigCode="'.$row->departureFareReference.'" ResBookDesigID="'.$row->departureResBookDesigID.'" StopQuantity="1" Ticket="1">
              <typ:DepartureAirport LocationCode="'.$row->departure.'"/>
              <typ:ArrivalAirport LocationCode="'.$row->destination.'"/>

              <typ:Equipment AirEquipType="'.$row->departureEquipment.'" ChangeofGauge="1"/>
              <typ:MarkettingAirline CompanyShortName="PC"/>
              <typ:MarketingCabin RPH="1" CabinType="1">
                <typ:Meal></typ:Meal>
              </typ:MarketingCabin>
              <typ:BookingClassAvail RPH="1" ResBookDesigCode="'.$row->departureResBookDesigCode.'" ResBookDesigQuantity="'.$row->departureResBookDesigQuantity.'"/>
              <typ:comment></typ:comment>
            </typ:FlightSegment>
     


<typ:FlightSegment ArrivalDateTime="'.$return_arrival_date_time.'" DepartureDateTime="'.$return_departure_date_time.'" FlightNumber="'.$row->returnFlightNumber.'" JourneyDuration="1" OnTimeRate="1" ResBookDesigCode="'.$row->returnFareReference.'" ResBookDesigID="'.$row->returnResBookDesigID.'" StopQuantity="1" Ticket="1">
              <typ:DepartureAirport LocationCode="'.$row->destination.'"/>
              <typ:ArrivalAirport LocationCode="'.$row->departure.'"/>
              <typ:Equipment AirEquipType="'.$row->returnEquipment.'" ChangeofGauge="1"/>
              <typ:MarkettingAirline CompanyShortName="'.$row->returnMarkettingAirline.'"/>
              <typ:MarketingCabin RPH="'.$row->returnRph.'" CabinType="'.$row->returnMarketingCabin.'">
                <typ:Meal></typ:Meal>
              </typ:MarketingCabin>

              <typ:BookingClassAvail RPH="'.$row->returnRph.'" ResBookDesigCode="'.$row->returnResBookDesigCode.'" ResBookDesigQuantity="'.$row->returnResBookDesigQuantity.'"/>
              <typ:comment></typ:comment>
            </typ:FlightSegment>



            <typ:dummy></typ:dummy>
          </typ:OriginDestinationOption>
          <typ:dummy></typ:dummy>
        </typ:OriginDestinationOptions>
      </ota:AirItinerary>
      
      <ota:TravelerInfo>';

      foreach($firstAdults as $passenger) {
$body1 .=  '<typ:AirTraveler PassengerTypeCode="'.$sexType.'">
          <typ:ProfileRef>
            <typ:UniqueID ID="1" URL="1" Instance="1" Type="1"/>
          </typ:ProfileRef>
          <typ:PersonName>
            <typ:NamePrefix>MR</typ:NamePrefix>
            <typ:GivenName>'.$passenger->name_latin.'</typ:GivenName>
            <typ:Surname>'.$passenger->surname_latin.'</typ:Surname>
            <typ:NameTitle></typ:NameTitle>
          </typ:PersonName>
          <typ:Telephone AreaCityCode="+996" PhoneNumber="'.$row->phone.'"/>
          <typ:Email>'.$row->email.'</typ:Email>
          <typ:Document BirthDate="'.$passenger_birthdate.'" DocID="" DocIssueAuthority="1" DocIssueLocation="1" DocType="1" EffectiveDate="1" ExpireDate="1" Gender="M">
            <typ:DocHolderName></typ:DocHolderName>
          </typ:Document>
        </typ:AirTraveler>';
}  


$body1 .=  '<typ:SpecialReqDetails>
          <typ:SeatRequests>
            <ota:item FlightRefNumberRPHList="1" SeatNumber="1" TravelerRefNumberRPHList="1"/>
          </typ:SeatRequests>
          
          <typ:SpecialServiceRequests>
            <typ:SpecialServiceRequest SSRCode="BILL" FlightRefNumberRPHList="1" TravelerRefNumberRPHList="1">
              <typ:Airline>PC</typ:Airline>
              <typ:text>401000144011</typ:text>
            </typ:SpecialServiceRequest>
            <typ:dummy>dummy</typ:dummy>
          </typ:SpecialServiceRequests>
          
        </typ:SpecialReqDetails>
      </ota:TravelerInfo>
      <ota:Ticketing TicketType="1"/>
    </otab:OTA_AirBookRQ>
  </soapenv:Body>
</soapenv:Envelope>';