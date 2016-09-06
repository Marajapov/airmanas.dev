<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:otab="http://otabase.otapax.otaxmlws/" xmlns:ota="http://ota.paxws.otaxmlws/" xmlns:typ="http://types.paxws.otaxmlws/">
  <soapenv:Header>
    <wsse:Security mustUnderstand="1" xmlns:wsse="http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd">
      <wsse:UsernameToken>
        <wsse:Username>207DX77</wsse:Username>
        <wsse:Password>SA</wsse:Password>
      </wsse:UsernameToken>
    </wsse:Security>
  </soapenv:Header>
  <soapenv:Body>
    <otab:OTA_AirBookRQ SequenceNmbr="1" TimeStamp="1" ExtTransactionID="">
      <ota:POS>
        <typ:Source agentSine="BSIA1234PM" isoCountry="TR" isoCurrency="TRY">
          <typ:RequestorID id="1" type="1" url="1"/>
          <typ:BookingChannel Primary="1" Type="1"/>
        </typ:Source>
      </ota:POS>
      <ota:AirItinerary DirectionInd="1">
        <typ:OriginDestinationOptions>
          <typ:OriginDestinationOption>
            <typ:FlightSegment ArrivalDateTime="2014-07-21T09:00:00" DepartureDateTime="2014-07-21T08:00:00" FlightNumber="100" JourneyDuration="1" OnTimeRate="1" ResBookDesigCode="YOW" ResBookDesigID="887595" StopQuantity="1" Ticket="1">
              <typ:DepartureAirport LocationCode="SAW"/>
              <typ:ArrivalAirport LocationCode="ESB"/>
              <typ:Equipment AirEquipType="737" ChangeofGauge="1"/>
              <typ:MarkettingAirline CompanyShortName="PC"/>
              <typ:MarketingCabin RPH="1" CabinType="1">
                <typ:Meal></typ:Meal>
              </typ:MarketingCabin>
              <typ:BookingClassAvail RPH="1" ResBookDesigCode="Y" ResBookDesigQuantity="1"/>
              <typ:comment></typ:comment>
            </typ:FlightSegment>
            <typ:FlightSegment ArrivalDateTime="2014-07-30T07:30:00" DepartureDateTime="2014-07-30T06:30:00" FlightNumber="4107" JourneyDuration="1" OnTimeRate="1" ResBookDesigCode="YOW" ResBookDesigID="887668" StopQuantity="1" Ticket="1">
              <typ:DepartureAirport LocationCode="ESB"/>
              <typ:ArrivalAirport LocationCode="SAW"/>
              <typ:Equipment AirEquipType="737" ChangeofGauge="1"/>
              <typ:MarkettingAirline CompanyShortName="PC"/>
              <typ:MarketingCabin RPH="1" CabinType="1">
                <typ:Meal></typ:Meal>
              </typ:MarketingCabin>
              <typ:BookingClassAvail RPH="1" ResBookDesigCode="Y" ResBookDesigQuantity="1"/>
              <typ:comment></typ:comment>
            </typ:FlightSegment>
            <typ:dummy></typ:dummy>
          </typ:OriginDestinationOption>
          <typ:dummy></typ:dummy>
        </typ:OriginDestinationOptions>
      </ota:AirItinerary>
      <ota:TravelerInfo>
        <typ:AirTraveler PassengerTypeCode="ADT">
          <typ:ProfileRef>
            <typ:UniqueID ID="1" URL="1" Instance="1" Type="1"/>
          </typ:ProfileRef>
          <typ:PersonName>
            <typ:NamePrefix>MR</typ:NamePrefix>
            <typ:GivenName>Musad</typ:GivenName>
            <typ:Surname>DOMBAYCI</typ:Surname>
            <typ:NameTitle></typ:NameTitle>
          </typ:PersonName>
          <typ:Telephone AreaCityCode="+48 71" PhoneNumber="7859270"/>
          <typ:Email>musa.dombayci@flypgs.com</typ:Email>
          <typ:Document BirthDate="1989-03-07" DocID="" DocIssueAuthority="1" DocIssueLocation="1" DocType="1" EffectiveDate="1" ExpireDate="1" Gender="M">
            <typ:DocHolderName></typ:DocHolderName>
          </typ:Document>
        </typ:AirTraveler>
        <typ:AirTraveler PassengerTypeCode="INF">
          <typ:ProfileRef>
            <typ:UniqueID ID="1" URL="1" Instance="1" Type="1"/>
          </typ:ProfileRef>
          <typ:PersonName>
            <typ:NamePrefix>MR</typ:NamePrefix>
            <typ:GivenName>Musad</typ:GivenName>
            <typ:Surname>DOMBAYCI</typ:Surname>
            <typ:NameTitle></typ:NameTitle>
          </typ:PersonName>
          <typ:Telephone AreaCityCode="+48 71" PhoneNumber="7859270"/>
          <typ:Email>musa.dombayci@flypgs.com</typ:Email>
          <typ:Document BirthDate="2014-03-07" DocID="" DocIssueAuthority="1" DocIssueLocation="1" DocType="1" EffectiveDate="1" ExpireDate="1" Gender="M">
            <typ:DocHolderName></typ:DocHolderName>
          </typ:Document>
        </typ:AirTraveler>
        <typ:AirTraveler PassengerTypeCode="CHD">
          <typ:ProfileRef>
            <typ:UniqueID ID="1" URL="1" Instance="1" Type="1"/>
          </typ:ProfileRef>
          <typ:PersonName>
            <typ:NamePrefix>MR</typ:NamePrefix>
            <typ:GivenName>Musad</typ:GivenName>
            <typ:Surname>DOMBAYCI</typ:Surname>
            <typ:NameTitle></typ:NameTitle>
          </typ:PersonName>
          <typ:Telephone AreaCityCode="+48 71" PhoneNumber="7859270"/>
          <typ:Email>musa.dombayci@flypgs.com</typ:Email>
          <typ:Document BirthDate="2011-03-07" DocID="" DocIssueAuthority="1" DocIssueLocation="1" DocType="1" EffectiveDate="1" ExpireDate="1" Gender="M">
            <typ:DocHolderName></typ:DocHolderName>
          </typ:Document>
        </typ:AirTraveler>    
        <typ:SpecialReqDetails>
          <typ:SeatRequests>
            <ota:item FlightRefNumberRPHList="1" SeatNumber="1" TravelerRefNumberRPHList="1"/>
          </typ:SeatRequests>
          <typ:SpecialServiceRequests>
            <typ:SpecialServiceRequest SSRCode="EPAY" FlightRefNumberRPHList="1" TravelerRefNumberRPHList="1">
              <typ:Airline>PC</typ:Airline>
              <typ:text>1111111111111111111/EXP12 16-MUSA DOMBAYCI</typ:text>
            </typ:SpecialServiceRequest>
            <typ:dummy>dummy</typ:dummy>
          </typ:SpecialServiceRequests>
        </typ:SpecialReqDetails>
      </ota:TravelerInfo>
      <ota:Ticketing TicketType="1"/>
    </otab:OTA_AirBookRQ>
  </soapenv:Body>
</soapenv:Envelope>
