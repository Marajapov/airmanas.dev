@if($noFlight == 0)
Flights for 7 (if selected 05.11.2016 so 0.2 03.04 < 05 > 0.6 0.7 0.8 <br/>
{{ $fly_days}}
<br/>
<br/>
@if($return_days_final)
Return flights for 7 (if selected 05.11.2016 so 0.2 03.04 < 05 > 0.6 0.7 0.8 <br/>
{{ $return_days_final }}
@endif
<br/>
<br/>
@else
no flights
@endif