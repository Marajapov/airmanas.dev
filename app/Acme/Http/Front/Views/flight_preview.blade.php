@extends('Front::layouts.default')

@section('title', trans('site.Title'))
@section('head')
<body class="search-result">
@stop
@section('content')
<div class="hero">
    <h1>Информация о пассажирах</h1>
</div>

<div class="search-flight full-width clearfix">
    <ul class="wizard">
        <li class="visited"><a href="index.html">Поиск</a></li>
        <li class="visited"><a href="result.html">Рейсы</a></li>
        <li class="visited"><a href="result.html">Информация</a></li>
        <li class="current"><em>Потверждение</em></li>
    </ul>


    <main class="content approvement">

        <div class="content-header">
            <div>
                <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                    <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none"/>
                    <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                </svg>
            </div>
            <div>
                <h2>
                    <span>Поздравляем!</span>
                    <span>Вы успешно заполнили необходимую информацию!</span>
                    <!-- <span>Ваши реквизиты для приобретения билета</span> -->
                </h2>

                <h2>
                    <span>Ваши реквизиты для приобретения билета:</span>
                </h2>
                <div class="app-code">
                    <p>{{ $paycode }}</p>
                </div>
            </div>
        </div>
        
        <div class="content-body clearfix">
            <div>
                <h2>
                    <p>Оставшееся время для оплаты</p>
                </h2>
                <div class="app-code app-time">
                    <p id="time">__:__:__</p>
                </div>
            </div>
            <div>
                <h2>
                    <p>Сумма для оплаты</p>
                </h2>
                <div class="app-code app-time">
                    <p>{{ $order_total_sum_post}} сом</p>
                </div>
            </div>
        </div>

        <div class="flights">

            <div class="flight-info clearfix">

                <div class="app-grid grid grid-50">

                    <h4>
                        Информация о рейсе
                    </h4>
                    <table class="table app-table">
                        <thead>
                        <tr>
                            <th>Рейс</th>
                            <th>Маршрут</th>
                            <th>Пассажиры</th>
                        </tr>
                        </thead>
                        <tbody>

                        <tr>
                            <td class="flight">{{ $departure->flightNumber }}</td>
                            <td class="direction">
                                <div class="dep-info text-right grid grid-40">
                                    <span class="time">{{ date('H:i', strtotime($departure->departureDateTime)) }}</span>
                                    <span class="place">
                                        {{ $departure->departureAirport }}, Бишкек
                                    </span>
                                </div>
                                <div class="divider grid grid-20">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
            <g>
                <g>
                    <path d="M15.6,13.6l7.5-0.8c0.1,0,0.2-0.1,0.3-0.1l0.4-0.4c0.2-0.2,0.2-0.5,0-0.7l-0.4-0.4c-0.1-0.1-0.2-0.1-0.3-0.1l-7.5-0.7
                        L8.8,1.6C8.7,1.5,8.6,1.4,8.5,1.4H6.9C6.6,1.4,6.4,1.7,6.5,2l3.3,8.4L3,11.2L1.2,8.4C1.1,8.3,0.9,8.2,0.9,8.2H0.5
                        C0.2,8.2,0,8.5,0.1,8.8l1,3.2l-1,3.2c-0.1,0.3,0.1,0.6,0.4,0.6h0.4c0.2,0,0.3-0.1,0.3-0.2L3,12.8l6.8,0.8L6.5,22
                        c-0.1,0.3,0.1,0.6,0.4,0.6h1.6c0.2,0,0.3-0.1,0.3-0.2L15.6,13.6z"/>
                </g>
            </g>
            </svg>
                                </div>
                                <div class="arr-info text-left grid grid-40">
                                    <span class="time">{{ date('H:i', strtotime($departure->arrivalDateTime)) }}</span>
                                    <span class="place">
                                        {{ $departure->arrivalAirport }}, Ош
                                    </span>
                                </div>
                            </td>
                            <td>
                                <ul class="fl-passengers">
                                @if ($adult_count>0)
                                    <li class="fl-passenger adult">
                                        <span>{{ $adult_count}} x</span>
                                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 28.4 64" style="enable-background:new 0 0 28.4 64;" xml:space="preserve">
    <g>
        <circle cx="14.2" cy="7.1" r="7.1"/>
        <path d="M28.4,20.9c-0.2-1.8-1.7-3.1-3.6-3.1h-3.6H7.1H3.6c-1.8,0-3.3,1.3-3.6,3.1c0,0.1,0,0.4,0,0.5v20.1c0,1.3,1.1,2.4,2.4,2.4
            s2.4-1.1,2.4-2.4V26.1c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2v35.6c0,1.3,1.1,2.4,2.4,2.4H19c1.3,0,2.4-1.1,2.4-2.4V26.1
            c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2v15.4c0,1.3,1.1,2.4,2.4,2.4s2.4-1.1,2.4-2.4V21.3C28.4,21.2,28.4,21,28.4,20.9z"/>
    </g>
    </svg>
                                    </li>
                                @endif
                                @if($child_count>0)
                                    <li class="fl-passenger child">
                                        <span>{{ $child_count}} x</span>
                                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 22.6 32" style="enable-background:new 0 0 22.6 32;" xml:space="preserve">
    <g>
        <path d="M22.2,7.9c-0.7-0.7-1.7-0.7-2.4,0l-4.4,4.4H7.3L2.9,7.9c-0.7-0.7-1.7-0.7-2.4,0s-0.7,1.7,0,2.4l6.3,6.3v6.2v4.5v2.9
            c0,0.9,0.8,1.7,1.7,1.7s1.7-0.8,1.7-1.7v-2.9v-2.1c0-0.7,0.5-1.1,1.1-1.1c0.7,0,1.1,0.5,1.1,1.1v2.1v2.9c0,0.9,0.8,1.7,1.7,1.7
            s1.7-0.8,1.7-1.7v-2.9v-4.6v-6.2l6.3-6.3C22.8,9.6,22.8,8.6,22.2,7.9z"/>
        <circle cx="11.4" cy="5" r="5"/>
    </g>
    </svg>
                                    </li>
                                @endif
                                @if($infant_count>0)
                                    <li class="fl-passenger infant">
                                        <span>{{ $infant_count}} x</span>
                                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 25.2 32" style="enable-background:new 0 0 25.2 32;" xml:space="preserve">
    <g>
        <circle cx="12.6" cy="5.4" r="5.4"/>
        <path d="M25.1,10.7c-0.3-0.8-1.2-1.3-2-1l-7.7,2.6H9.8L2.1,9.7c-0.8-0.3-1.7,0.2-2,1c-0.3,0.8,0.2,1.7,1,2l6,2.8v5.3l-3.1,2.9
            c-0.8,0.8-0.9,2.1-0.1,3l4.1,4.6C8.4,31.8,9,32,9.5,32c0.5,0,1-0.2,1.4-0.5c0.9-0.8,0.9-2.1,0.2-3l-2.7-3l3.5-2.4h1.3l3.5,2.4
            l-2.7,3c-0.8,0.9-0.7,2.2,0.2,3c0.4,0.4,0.9,0.5,1.4,0.5c0.6,0,1.2-0.2,1.6-0.7l4.1-4.6c0.8-0.9,0.7-2.2-0.1-3l-3.1-2.9v-5.3l6-2.8
            C24.9,12.4,25.4,11.5,25.1,10.7z"/>
    </g>
    </svg>
                                    </li>
                                @endif
                                </ul>
                            </td>
                        </tr>
                        @if($return)
                        <tr>
                            <td class="flight">{{ $return->flightNumber }}</td>
                            <td class="direction">
                                <div class="dep-info text-right grid grid-40">
                                    <span class="time">{{ date('H:i', strtotime($return->departureDateTime)) }}</span>
                                    <span class="place">
                                        {{ $return->departureAirport }}, Бишкек
                                    </span>
                                </div>
                                <div class="divider grid grid-20">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">
            <g>
                <g>
                    <path d="M15.6,13.6l7.5-0.8c0.1,0,0.2-0.1,0.3-0.1l0.4-0.4c0.2-0.2,0.2-0.5,0-0.7l-0.4-0.4c-0.1-0.1-0.2-0.1-0.3-0.1l-7.5-0.7
                        L8.8,1.6C8.7,1.5,8.6,1.4,8.5,1.4H6.9C6.6,1.4,6.4,1.7,6.5,2l3.3,8.4L3,11.2L1.2,8.4C1.1,8.3,0.9,8.2,0.9,8.2H0.5
                        C0.2,8.2,0,8.5,0.1,8.8l1,3.2l-1,3.2c-0.1,0.3,0.1,0.6,0.4,0.6h0.4c0.2,0,0.3-0.1,0.3-0.2L3,12.8l6.8,0.8L6.5,22
                        c-0.1,0.3,0.1,0.6,0.4,0.6h1.6c0.2,0,0.3-0.1,0.3-0.2L15.6,13.6z"/>
                </g>
            </g>
            </svg>
                                </div>
                                <div class="arr-info text-left grid grid-40">
                                    <span class="time">{{ date('H:i', strtotime($return->arrivalDateTime)) }}</span>
                                    <span class="place">
                                        {{ $return->arrivalAirport }}, Ош
                                    </span>
                                </div>
                            </td>
                            <td>
                                <ul class="fl-passengers">
                                @if ($adult_count>0)
                                    <li class="fl-passenger adult">
                                        <span>{{ $adult_count}} x</span>
                                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 28.4 64" style="enable-background:new 0 0 28.4 64;" xml:space="preserve">
    <g>
        <circle cx="14.2" cy="7.1" r="7.1"/>
        <path d="M28.4,20.9c-0.2-1.8-1.7-3.1-3.6-3.1h-3.6H7.1H3.6c-1.8,0-3.3,1.3-3.6,3.1c0,0.1,0,0.4,0,0.5v20.1c0,1.3,1.1,2.4,2.4,2.4
            s2.4-1.1,2.4-2.4V26.1c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2v35.6c0,1.3,1.1,2.4,2.4,2.4H19c1.3,0,2.4-1.1,2.4-2.4V26.1
            c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2v15.4c0,1.3,1.1,2.4,2.4,2.4s2.4-1.1,2.4-2.4V21.3C28.4,21.2,28.4,21,28.4,20.9z"/>
    </g>
    </svg>
                                    </li>
                                @endif
                                @if($child_count>0)
                                    <li class="fl-passenger child">
                                        <span>{{ $child_count}} x</span>
                                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 22.6 32" style="enable-background:new 0 0 22.6 32;" xml:space="preserve">
    <g>
        <path d="M22.2,7.9c-0.7-0.7-1.7-0.7-2.4,0l-4.4,4.4H7.3L2.9,7.9c-0.7-0.7-1.7-0.7-2.4,0s-0.7,1.7,0,2.4l6.3,6.3v6.2v4.5v2.9
            c0,0.9,0.8,1.7,1.7,1.7s1.7-0.8,1.7-1.7v-2.9v-2.1c0-0.7,0.5-1.1,1.1-1.1c0.7,0,1.1,0.5,1.1,1.1v2.1v2.9c0,0.9,0.8,1.7,1.7,1.7
            s1.7-0.8,1.7-1.7v-2.9v-4.6v-6.2l6.3-6.3C22.8,9.6,22.8,8.6,22.2,7.9z"/>
        <circle cx="11.4" cy="5" r="5"/>
    </g>
    </svg>
                                    </li>
                                @endif
                                @if($infant_count>0)
                                    <li class="fl-passenger infant">
                                        <span>{{ $infant_count}} x</span>
                                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 25.2 32" style="enable-background:new 0 0 25.2 32;" xml:space="preserve">
    <g>
        <circle cx="12.6" cy="5.4" r="5.4"/>
        <path d="M25.1,10.7c-0.3-0.8-1.2-1.3-2-1l-7.7,2.6H9.8L2.1,9.7c-0.8-0.3-1.7,0.2-2,1c-0.3,0.8,0.2,1.7,1,2l6,2.8v5.3l-3.1,2.9
            c-0.8,0.8-0.9,2.1-0.1,3l4.1,4.6C8.4,31.8,9,32,9.5,32c0.5,0,1-0.2,1.4-0.5c0.9-0.8,0.9-2.1,0.2-3l-2.7-3l3.5-2.4h1.3l3.5,2.4
            l-2.7,3c-0.8,0.9-0.7,2.2,0.2,3c0.4,0.4,0.9,0.5,1.4,0.5c0.6,0,1.2-0.2,1.6-0.7l4.1-4.6c0.8-0.9,0.7-2.2-0.1-3l-3.1-2.9v-5.3l6-2.8
            C24.9,12.4,25.4,11.5,25.1,10.7z"/>
    </g>
    </svg>
                                    </li>
                                @endif
                                </ul>
                            </td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <div class="app-grid grid grid-50">
                    <h4>
                        Контактная информация
                    </h4>
                    <table class="table app-table app-contact">
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Телефон</th>
                            <th>Эл.почта</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>
                                {{ $name}}
                            </td>
                            <td>
                                {{ $surname}}
                            </td>
                            <td>
                                {{ $phone}}
                            </td>
                            <td>
                                {{ $email}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>            

            <div class="app-payment">
                <h4>
                    Способы оплаты
                </h4>

                <ul>
                    <li>
                        <span>
                            <img src="{{ asset('images/mobilnik-logo.svg') }}" alt="">
                        </span>
                        <div class="paylist">
                            <a href="#">Как оплатить?</a>
                            <a href="https://www.mobilnik.kg/#/map">Карта терминалов</a>
                        </div>
                    </li>
                    <li>
                        <span>
                            <img src="{{ asset('images/qiwi-logo.png') }}" alt="">
                        </span>
                        <div class="paylist">
                            <a href="http://qiwi.kg/001-2.html">Как оплатить?</a>
                            <a href="http://qiwi.kg/001-2.html">Карта терминалов</a>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

    </main>

</div>
@stop

@section('footer')
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
@stop