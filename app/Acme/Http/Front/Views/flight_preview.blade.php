@include('Front::partials.main_header')
@include('Front::partials.header')
</div>

<div class="main-content container no-padding">
	go Qiwi to pay with this number:
	<div class="flight-info clearfix" style="background-color:#FF0000; color:#FFFFFF; font-size:xx-large; ">
	<span style="margin-left:25px;">{{ $paycode }}</span>
	</div>
	
	After deposit your money, we will send your PNR code..Bla bla .. 
	where is Qiwi? [translate][link] How to pay with Qiwi?<br /><br />
	<div class="flight-info clearfix" style="background-color:#FF0000; color:#FFFFFF; font-size:xx-large; ">
	<span style="margin-left:25px;">Time left to pay: <span id="time"></span></span>
	</div>
	
	Контактная информация:<br />
	Имя: {{ $name }}<br />
	Фамилия:  {{ $surname }}<br />
	Телефон:  {{ $phone }}<br />
	Эл. почта:  {{ $email }}<br />
    <!-- flight-info -->
    <div class="flight-info clearfix">
	
        <table class="table table-bordered col-lg-12 no-padding">
            <tbody>
                <tr class="active">
                    <td colspan="6">Информация о бронировании</td>
                </tr>

                <tr class="info first-row hidden-xs">
                    <td>Маршрут</td>
                    <td>Номер рейса</td>
                    <td>Дата вылета</td>
                    <td>Время вылета</td>
                    <td>Дата прибытия</td>
                    <td>Время прибытия</td>
                </tr>

                <tr class="hidden-xs">
                    <td>{{ $departure->departureAirport }} <i class="fa fa-plane"></i> {{ $departure->arrivalAirport }}</td>
                    <td>{{ $departure->flightNumber }}</td>
                    <td>{{ date('d.m.Y', strtotime($departure->departureDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($departure->departureDateTime)) }}</td>
                    <td>{{ date('d.m.Y', strtotime($departure->arrivalDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($departure->arrivalDateTime)) }}</td>
                </tr>
				@if($return)
                <tr class="hidden-xs">
                    <td>{{ $return->departureAirport }} <i class="fa fa-plane"></i>  {{ $return->arrivalAirport }}</td>
                    <td>{{ $return->flightNumber }}</td>
                    <td>{{ date('d.m.Y', strtotime($return->departureDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($return->departureDateTime)) }}</td>
                    <td>{{ date('d.m.Y', strtotime($return->arrivalDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($return->arrivalDateTime)) }}</td>
                </tr>
				@endif
            </tbody>
        </table>
    </div> <!-- end flight-info -->

	
	@for($i=0; $i < count($all); $i++)
		{{--*/ $passenger = $all[$i] /*--}}
	
	Пассажир № {{ $i+1 }} - {{ $passenger_type[$passenger->type] }} Пол: {{ $sex_type[$passenger->sex] }}</br>

	 Имя: {{ $passenger->name }}<br />
	 Фамилия: {{ $passenger->surname }}<br />
	 Дата рождения:  {{ date("d.m.Y", $passenger->birthday) }}
	 <hr />

	@endfor
	
				<input type="hidden" name="total" value="{{ $total }}" />
				<input type="hidden" name="flight_1" id="flight_1" value="{{ $flight_1 }}" />
				<input type="hidden" name="flight_2" id="flight_2" value="{{ $flight_2 }}" />
				<input type="hidden" name="adult_count" id="adult_count" value="{{ $adult_count }}" />
				<input type="hidden" name="child_count" id="child_count" value="{{ $child_count }}" />
                <input type="hidden" name="infant_count" id="infant_count" value="{{ $infant_count }}" />

				
	
</div>

@include('Front::partials.footer')
<script>
function startTimer(duration, display) {
    var timer = duration, hours, minutes, seconds;
    setInterval(function () {
		hours = parseInt(timer / (60 * 60), 10);
        minutes = parseInt((timer % 3600)/60, 10);
        seconds = parseInt(timer % 60, 10);

        hours = hours < 10 ? "0" + hours : hours;
		minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.text(hours + ":" + minutes + ":" + seconds);

        if (--timer < 0) {
            timer = duration;
        }
    }, 1000);
}

jQuery(function ($) {
    var countdown = <?php echo $countdown;?>,
        display = $('#time');
		startTimer(countdown, display);
});
</script>