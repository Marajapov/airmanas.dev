<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Flights</title>
    </head>
    <body>
        @if($noFlight == 0)
        <p>Flights for 7 (if selected 05.11.2016 so 0.2 03.04 < 05 > 0.6 0.7 0.8 <br/></p>
        {{--*/ print_r($fly_days) /*--}}
        <br/>
        <br/>
        @if($return_days_final)
        <p>Return flights for 7 (if selected 05.11.2016 so 0.2 03.04 < 05 > 0.6 0.7 0.8 <br/></p>
        {{--*/ print_r($return_days_final) /*--}}
        @endif
        <br/>
        <br/>
        @else
        no flights
        @endif 
    </body>
</html>