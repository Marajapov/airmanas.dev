@extends('Front::layouts.default')
@section('title', trans('site.Title'))
@section('head')
<body class="search-result">
@stop
@section('content')
<div class="hero">
    <h1>Результаты поиска</h1>
</div>
<div class="search-flight full-width clearfix">
        <ul class="wizard">
            <li class="visited"><a href="index.html">Поиск</a></li>
            <li class="current"><em>Рейсы</em></li>
            <li><em>Информация</em></li>
            <li><em>Потверждение</em></li>
        </ul>
        <main class="content grid grid-70 grid-padding-right">
                <div class="departure">
                    <h4>
                        <span>Отправление</span>
                        {{ $airport_loc[$departure] }}
                        -
                        {{ $airport_loc[$destination] }}
                    </h4>
                    <ul class="nav-justified">
                        @for($i=0; $i<count($fly_days); $i++)
                        {{--*/ $day_str = $fly_days[$i][0]->departure_date() /*--}}
                        @if ($day_str)
                        {{--*/ $day = strtotime($day_str) /*--}}
                            <li class="@if($dept_d == $day) current @endif">
                                <a href="#" data-date="{{ date('Y-m-d', strtotime($day_str)) }}">
                                    <span class="weekday">{{ strftime('%a',$day) }}</span>
                                    <span class="date">{{ date('d', $day) }}</span>
                                    <span class="month">{{ strftime('%b', $day) }}</span>
                                </a>
                            </li>
                        @endif
                        @endfor
                    </ul>

                    <div class="flights">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Рейс</th>
                                <th>Маршрут</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody id="flightsBody">
                            @for($i=0; $i<count($fly_days); $i++)
                            @for($j=0; $j<count($fly_days[$i]); $j++)
                            {{--*/ $ddt_str = $fly_days[$i][$j]->departureDateTime /*--}}
                            {{--*/ $adt_str = $fly_days[$i][$j]->arrivalDateTime /*--}}
                            {{--*/ $ddt = strtotime($ddt_str) /*--}}
                            {{--*/ $adt = strtotime($adt_str) /*--}}
                            
                            {{--*/ $selectedDate = strtotime($fly_days[$i][$j]->departure_date()) /*--}}
                            @if($selectedDate == $dept_d)
                            <tr data-price="{{ $fly_days[$i][$j]->adultPriceSom }}" data-child-price="{{ $fly_days[$i][$j]->childPriceSom }}" data-infant-price="{{ $fly_days[$i][$j]->infPriceSom }}" data-number="{{ $fly_days[$i][$j]->flightNumber}}" data-from-date="{{ date('d.m.Y', $ddt) }}" data-from-time="{{ date('H:i', $ddt) }}" data-from-city="{{ $airport_loc[$fly_days[$i][$j]->departureAirport] }}" data-from-airport="{{ $fly_days[$i][$j]->departureAirport }}" data-to-date="{{ date('d.m.Y', $adt) }}" data-to-time="{{ date('H:i', $adt) }}" data-to-city="{{ $airport_loc[$fly_days[$i][$j]->arrivalAirport] }}" data-to-airport="{{ $fly_days[$i][$j]->arrivalAirport }}" data-timestamp="{{ $fly_days[$i][$j]->timestamp }}">
                                <td class="flight">{{ $fly_days[$i][$j]->flightNumber }} </td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">{{ date('H:i', strtotime($fly_days[$i][$j]->departureDateTime))}}</span>
                                        <span class="place">

                                        {{ $airport_loc[$departure] }}
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
                                        <span class="time">{{ date('H:i', strtotime($fly_days[$i][$j]->arrivalDateTime))}}</span>
                                        <span class="place">
                                        {{ $airport_loc[$destination] }}
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    {{ $fly_days[$i][$j]->adultPriceSom }}
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                     <button class="btn btn-buy-dep">
                                         выбрать
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @endfor
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="block-divider">
                    <span>
                        <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                    <path d="M64,31.8c-0.1-0.6-0.5-1-1-1.2l0,0L14.4,14.8c-0.6-0.2-1.2,0-1.6,0.4c-0.4,0.5-0.5,1.1-0.2,1.7L19.6,32l-7.1,15.1
                        c-0.3,0.5-0.2,1.2,0.2,1.7c0.3,0.3,0.7,0.5,1.1,0.5c0.2,0,0.3,0,0.5-0.1l48.5-15.7C63.7,33.2,64.1,32.5,64,31.8z M52.8,30.5H22.3
                        l-5.5-11.6L52.8,30.5z M16.8,45.2l5.5-11.6h30.5L16.8,45.2z M13.7,33.5H1.5C0.7,33.5,0,32.8,0,32c0-0.8,0.7-1.5,1.5-1.5h12.1
                        c0.8,0,1.5,0.7,1.5,1.5C15.2,32.8,14.5,33.5,13.7,33.5z M11.5,39.2H8c-0.8,0-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5h3.6
                        c0.8,0,1.5,0.7,1.5,1.5S12.4,39.2,11.5,39.2z M11.5,27.8H8c-0.8,0-1.5-0.7-1.5-1.5s0.7-1.5,1.5-1.5h3.6c0.8,0,1.5,0.7,1.5,1.5
                        S12.4,27.8,11.5,27.8z"/>
                    </svg>
                    </span>
                </div>

            @if($fly_days_return != 0)

                <!-- arrival part -->
                <div class="arrival">
                    <h4>
                        <span>Прибытие</span>
                        {{ $airport_loc[$destination] }}

                        {{ $airport_loc[$departure] }}
                    </h4>

                    <ul class="nav-justified">
                    @for($k=0; $k<count($fly_days_return); $k++)
                    @if($fly_days_return[$k])
                    {{--*/ $day_str = $fly_days_return[$k][0]->departure_date() /*--}}

                    @if ($day_str)
                    {{--*/ $day = strtotime($day_str) /*--}}    
                        <li class="@if($retn_d == $day) current @endif">
                            <a href="#" data-date-return="{{ date('Y-m-d', strtotime($day_str)) }}">
                                <span class="weekday">{{ strftime('%a',$day) }}</span>
                                <span class="date">{{ date('d', $day) }}</span>
                                <span class="month">{{ strftime('%b', $day) }}</span>
                            </a>
                        </li>
                    @endif
                    @endif
                    @endfor
                    </ul>

                    <div class="flights">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Рейс</th>
                                <th>Маршрут</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody  id="flightsBodyReturn">
                            {{--*/ $l/*--}}
                            @for($l=0; $l<count($fly_days_return); $l++)
                            @for($t=0; $t<count($fly_days_return[$l]); $t++)

                                {{--*/ $ddt_str = $fly_days_return[$l][$t]->departureDateTime /*--}}
                                {{--*/ $adt_str = $fly_days_return[$l][$t]->arrivalDateTime /*---}}
                                {{--*/ $ddt = strtotime($ddt_str) /*--}} 
                                {{--*/ $adt = strtotime($adt_str) /*--}} 

                                {{--*/ $selectedDate = strtotime($fly_days_return[$l][$t]->departure_date()) /*--}}
                                @if($selectedDate == $retn_d)
                            <tr data-price="{{ $fly_days_return[$l][$t]->adultPriceSom }}" data-child-price="{{ $fly_days_return[$l][$t]->childPriceSom }}" data-infant-price="{{ $fly_days_return[$l][$t]->infPriceSom }}" data-number="{{ $fly_days_return[$l][$t]->flightNumber}}" data-from-date="{{ date('d.m.Y', $ddt) }}" data-from-time="{{ date('H:i', $ddt)}}" data-from-city="{{ $airport_loc[$fly_days_return[$l][$t]->departureAirport] }}" data-from-airport="{{ $fly_days_return[$l][$t]->departureAirport }}" data-to-date="{{ date('d.m.Y', $adt) }}" data-to-time="{{ date('H:i', $adt)}}" data-to-city="{{ $airport_loc[$fly_days_return[$l][$t]->arrivalAirport] }}" data-to-airport="{{ $fly_days_return[$l][$t]->arrivalAirport }}" data-timestamp="{{ $fly_days_return[$l][$t]->timestamp }}">
                                <td class="flight">{{ $fly_days_return[$l][$t]->flightNumber }} </td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">{{ date('H:i', strtotime($fly_days_return[$l][$t]->departureDateTime))}}</span>
                                        <span class="place">
                                        {{ $airport_loc[$destination] }}
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
                                        <span class="time">{{ date('H:i', strtotime($fly_days_return[$l][$t]->arrivalDateTime))}}</span>
                                        <span class="place">
                                        {{ $airport_loc[$departure] }}
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    {{ $fly_days_return[$l][$t]->adultPriceSom }}
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                     <button class="btn btn-buy-arr">
                                        выбрать
                                    </button>
                                </td>
                            </tr>
                            @endif
                            @endfor
                            @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- arrival part end -->
            @endif
            </main>

    <aside class="sidebar grid grid-30 grid-border-left">
        <header>
            <h4 class="fl-title">Информация о рейсе</h4>
            <ul class="clearfix fl-extra">
                <li class="order-type">
                    @if($return_date) туда и обратно @else в один конец @endif
                </li>
            </ul>

            <ul class="fl-passengers order-person">
                @if ($adult_count>0) 
                    <li class="fl-passenger adult">
                        <span>{{ $adult_count }} x</span>
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
                    <span>{{$child_count}} x</span>
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
                    <span>{{$infant_count}} x</span>
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
        </header>

        <section class="fl-out-info hidden">
            <h6>Отправление</h6>


            <ul class="clearfix fl-extra">
                <!-- <li class="order-number-num" data-text="Рейс">
                </li> -->
                <!-- <li class="order-fl-price">
                </li>-->
            </ul>

            <div class="fl-info">

                <div class="fl-info-dep">
                    <h4>
                        <span class="order-fromCity"></span>
                        <span class="order-fromAirport"></span>
                    </h4>
                    <div class="fl-date-time">
                        <span>
                            <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
 viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
<g>
    <path d="M32,0C14.4,0,0,14.4,0,32c0,17.6,14.4,32,32,32c17.6,0,32-14.4,32-32C64,14.4,49.6,0,32,0z M32,59.1
        C17.1,59.1,4.9,46.9,4.9,32S17.1,4.9,32,4.9S59.1,17.1,59.1,32S46.9,59.1,32,59.1z"/>
    <path d="M32,12.3c-1.4,0-2.5,1.1-2.5,2.5v14.8h-9.8c-1.4,0-2.5,1.1-2.5,2.5s1.1,2.5,2.5,2.5H32c1.4,0,2.5-1.1,2.5-2.5V14.8
        C34.5,13.4,33.4,12.3,32,12.3z"/>
</g>
</g>
</svg>
                            <span class="order-fromTime">07:35</span>
                        </span>
                        <span>
                            <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
 viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
<path d="M56.6,7.4h-2.5V2.5c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.5v4.9h-32V2.5c0-1.4-1.1-2.5-2.5-2.5s-2.5,1.1-2.5,2.5v4.9
    H7.4C3.3,7.4,0,10.7,0,14.8v41.8C0,60.7,3.3,64,7.4,64h49.2c4.1,0,7.4-3.3,7.4-7.4V14.8C64,10.7,60.7,7.4,56.6,7.4z M7.4,12.3h4.9
    v4.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5v-4.9h32v4.9c0,1.4,1.1,2.5,2.5,2.5c1.4,0,2.5-1.1,2.5-2.5v-4.9h2.5
    c1.4,0,2.5,1.1,2.5,2.5v7.4H4.9v-7.4C4.9,13.4,6,12.3,7.4,12.3z M56.6,59.1H7.4c-1.4,0-2.5-1.1-2.5-2.5V27.1h54.2v29.5
    C59.1,58,58,59.1,56.6,59.1z"/>
</g>
</svg>
                            <span class="order-fromDate">02.02.2017, Пн</span>
                        </span>
                    </div>
                </div>
                <div class="fl-info-arr">
                    <h4>
                        <span class="order-toCity"></span>
                        <span class="order-toAirport"></span>
                    </h4>
                    <div class="fl-date-time">
                            <span>
                                <span class="order-toTime">07:35</span>
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
    <g>
        <path d="M32,0C14.4,0,0,14.4,0,32c0,17.6,14.4,32,32,32c17.6,0,32-14.4,32-32C64,14.4,49.6,0,32,0z M32,59.1
            C17.1,59.1,4.9,46.9,4.9,32S17.1,4.9,32,4.9S59.1,17.1,59.1,32S46.9,59.1,32,59.1z"/>
        <path d="M32,12.3c-1.4,0-2.5,1.1-2.5,2.5v14.8h-9.8c-1.4,0-2.5,1.1-2.5,2.5s1.1,2.5,2.5,2.5H32c1.4,0,2.5-1.1,2.5-2.5V14.8
            C34.5,13.4,33.4,12.3,32,12.3z"/>
    </g>
</g>
</svg>
                            </span>
                        <span>
                                <span class="order-toDate">02.02.2017, Пн</span>
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
    <path d="M56.6,7.4h-2.5V2.5c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.5v4.9h-32V2.5c0-1.4-1.1-2.5-2.5-2.5s-2.5,1.1-2.5,2.5v4.9
        H7.4C3.3,7.4,0,10.7,0,14.8v41.8C0,60.7,3.3,64,7.4,64h49.2c4.1,0,7.4-3.3,7.4-7.4V14.8C64,10.7,60.7,7.4,56.6,7.4z M7.4,12.3h4.9
        v4.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5v-4.9h32v4.9c0,1.4,1.1,2.5,2.5,2.5c1.4,0,2.5-1.1,2.5-2.5v-4.9h2.5
        c1.4,0,2.5,1.1,2.5,2.5v7.4H4.9v-7.4C4.9,13.4,6,12.3,7.4,12.3z M56.6,59.1H7.4c-1.4,0-2.5-1.1-2.5-2.5V27.1h54.2v29.5
        C59.1,58,58,59.1,56.6,59.1z"/>
</g>
</svg>
                            </span>
                    </div>
                </div>
            </div>
        </section>

        <section class="fl-in-info hidden">
            <h6>Возвращение</h6>


            <ul class="clearfix fl-extra">
                <!-- <li class="order-number-num">

                </li>
                <li class="order-fl-price">

                </li> -->
            </ul>

            <div class="fl-info">

                <div class="fl-info-dep">
                    <h4>
                        <span class="order-fromCity"></span>
                        <span class="order-fromAirport"></span>
                    </h4>
                    <div class="fl-date-time">
                        <span>
                            <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
 viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
<g>
    <path d="M32,0C14.4,0,0,14.4,0,32c0,17.6,14.4,32,32,32c17.6,0,32-14.4,32-32C64,14.4,49.6,0,32,0z M32,59.1
        C17.1,59.1,4.9,46.9,4.9,32S17.1,4.9,32,4.9S59.1,17.1,59.1,32S46.9,59.1,32,59.1z"/>
    <path d="M32,12.3c-1.4,0-2.5,1.1-2.5,2.5v14.8h-9.8c-1.4,0-2.5,1.1-2.5,2.5s1.1,2.5,2.5,2.5H32c1.4,0,2.5-1.1,2.5-2.5V14.8
        C34.5,13.4,33.4,12.3,32,12.3z"/>
</g>
</g>
</svg>
                            <span class="order-fromTime">07:35</span>
                        </span>
                        <span>
                            <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
 viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
<path d="M56.6,7.4h-2.5V2.5c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.5v4.9h-32V2.5c0-1.4-1.1-2.5-2.5-2.5s-2.5,1.1-2.5,2.5v4.9
    H7.4C3.3,7.4,0,10.7,0,14.8v41.8C0,60.7,3.3,64,7.4,64h49.2c4.1,0,7.4-3.3,7.4-7.4V14.8C64,10.7,60.7,7.4,56.6,7.4z M7.4,12.3h4.9
    v4.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5v-4.9h32v4.9c0,1.4,1.1,2.5,2.5,2.5c1.4,0,2.5-1.1,2.5-2.5v-4.9h2.5
    c1.4,0,2.5,1.1,2.5,2.5v7.4H4.9v-7.4C4.9,13.4,6,12.3,7.4,12.3z M56.6,59.1H7.4c-1.4,0-2.5-1.1-2.5-2.5V27.1h54.2v29.5
    C59.1,58,58,59.1,56.6,59.1z"/>
</g>
</svg>
                            <span class="order-fromDate">02.02.2017, Пн</span>
                        </span>
                    </div>
                </div>
                <div class="fl-info-arr">
                    <h4>
                        <span class="order-toCity"></span>
                        <span class="order-toAirport"></span>
                    </h4>
                    <div class="fl-date-time">
                            <span>
                                <span class="order-toTime">07:35</span>
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
    <g>
        <path d="M32,0C14.4,0,0,14.4,0,32c0,17.6,14.4,32,32,32c17.6,0,32-14.4,32-32C64,14.4,49.6,0,32,0z M32,59.1
            C17.1,59.1,4.9,46.9,4.9,32S17.1,4.9,32,4.9S59.1,17.1,59.1,32S46.9,59.1,32,59.1z"/>
        <path d="M32,12.3c-1.4,0-2.5,1.1-2.5,2.5v14.8h-9.8c-1.4,0-2.5,1.1-2.5,2.5s1.1,2.5,2.5,2.5H32c1.4,0,2.5-1.1,2.5-2.5V14.8
            C34.5,13.4,33.4,12.3,32,12.3z"/>
    </g>
</g>
</svg>
                            </span>
                        <span>
                                <span class="order-toDate">02.02.2017, Пн</span>
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
<g>
    <path d="M56.6,7.4h-2.5V2.5c0-1.4-1.1-2.5-2.5-2.5c-1.4,0-2.5,1.1-2.5,2.5v4.9h-32V2.5c0-1.4-1.1-2.5-2.5-2.5s-2.5,1.1-2.5,2.5v4.9
        H7.4C3.3,7.4,0,10.7,0,14.8v41.8C0,60.7,3.3,64,7.4,64h49.2c4.1,0,7.4-3.3,7.4-7.4V14.8C64,10.7,60.7,7.4,56.6,7.4z M7.4,12.3h4.9
        v4.9c0,1.4,1.1,2.5,2.5,2.5s2.5-1.1,2.5-2.5v-4.9h32v4.9c0,1.4,1.1,2.5,2.5,2.5c1.4,0,2.5-1.1,2.5-2.5v-4.9h2.5
        c1.4,0,2.5,1.1,2.5,2.5v7.4H4.9v-7.4C4.9,13.4,6,12.3,7.4,12.3z M56.6,59.1H7.4c-1.4,0-2.5-1.1-2.5-2.5V27.1h54.2v29.5
        C59.1,58,58,59.1,56.6,59.1z"/>
</g>
</svg>
                            </span>
                    </div>
                </div>
            </div>
        </section>

        <footer class="hidden">

            <div class="clearfix">
                <span>
                    Итого:
                </span>
                <span id="order_total_sum" class="order_total_sum">
                    2448 сом
                </span>
            </div>

            {!! Form::open(array('route' => 'front.passenger', 'method' => 'post','class'=>'check')) !!}
                <input type="hidden" name="flight_1" id="flight_1" />
                <input type="hidden" name="flight_2" id="flight_2" />
                <input type="hidden" name="adult_count" id="adult_count" value="{{ $adult_count }}" />
                <input type="hidden" name="child_count" id="child_count" value="{{ $child_count }}" />
                <input type="hidden" name="infant_count" id="infant_count" value="{{ $infant_count }}" />
                <input type="hidden" name="order_total_sum_post" id="order_total_sum_post" />
                <button type="submit" class="btn next-btn">Продолжить</button>
            {!! Form::close() !!}
        </footer>

    </aside>
</div>


@stop

@section('footer')
<script type="text/javascript">
    var price_1 = 0;
    var price_child_1 = 0;
    var price_infant_1 = 0;
    var price_2 = 0;
    var price_child_2 = 0;
    var price_infant_2 = 0;
    var adult_count = {{ $adult_count }};
    var child_count = {{ $child_count }};
    var infant_count = {{ $infant_count }};
    var result_price = 0;
</script>

<script type="text/javascript">
    
    $(document).ready(function(){
        $('.nav-justified a').click(function(e){
            e.preventDefault();
            var url = "{{ route('front.pickDate') }}";
            $(this).parent().siblings().removeClass('current');
            $(this).parent().addClass('current');
            $.ajax
            ({
                type: "POST",
                url: url,
                data: {
                    date    : $(this).attr('data-date')
                },
                cache: false,
                success: function (data) {
                    if(data){
                        $("#flightsBody").html(data);
                    }
                    else{
                        console.log('no data');
                    }

$('.btn-buy-dep').click(function (e) {
            e.preventDefault();

            var parentTr = $(this).parent().parent();

            $('.btn-buy-dep').removeClass('selected');
            $('.btn-buy-dep').parent().parent().removeClass('fl-selected');

            $(this).addClass('selected');
            parentTr.addClass('fl-selected');

            var flNumber = parentTr.attr('data-number');
            var flPrice = parentTr.attr('data-price');
            var flPrice_child = parentTr.attr('data-child-price');
            var flPrice_infant = parentTr.attr('data-infant-price');
            var flFromDate = parentTr.attr('data-from-date');
            var flFromTime = parentTr.attr('data-from-time');
            var flToDate = parentTr.attr('data-to-date');
            var flToTime = parentTr.attr('data-to-time');
            var flFromCity = parentTr.attr('data-from-city');
            var flFromAirport = parentTr.attr('data-from-airport');
            var flToCity = parentTr.attr('data-to-city');
            var flToAirport = parentTr.attr('data-to-airport');
            var timestamp = parentTr.attr('data-timestamp');
            $('input#flight_1').val(timestamp);
            $('.toTable').slideDown(400);

            $('.fl-out-info').addClass('cont_btn').removeClass('hidden');
            
            $('.fl-out-info .order-number-num').html(flNumber);
            $('.fl-out-info .order-fl-price').html(flPrice);
            $('.fl-out-info .order-fromCity').html(flFromCity);
            $('.fl-out-info .order-fromAirport').html(flFromAirport);
            $('.fl-out-info .order-fromDate').html(flFromDate);
            $('.fl-out-info .order-fromTime').html(flFromTime);
            $('.fl-out-info .order-toCity').html(flToCity);
            $('.fl-out-info .order-toAirport').html(flToAirport);
            $('.fl-out-info .order-toDate').html(flToDate);
            $('.fl-out-info .order-toTime').html(flToTime);
            @if (count($fly_days_return) == 0) $('.sidebar footer').removeClass('hidden'); @endif
            calculate_flight_fee(1, flPrice, flPrice_child, flPrice_infant);

            @if(count($fly_days_return) > 0)
                if(($('.fl-in-info').hasClass('cont_btn')) && ($('.fl-out-info').hasClass('cont_btn'))) {
                    $('.sidebar footer').removeClass('hidden');
                }
            @else
                if($('.fl-in-info').hasClass('cont_btn')){
                    $('.sidebar footer').removeClass('hidden');
                }
            @endif
        });

        $('.btn-buy-arr').click(function (e) {
            e.preventDefault();

            var parentTr = $(this).parent().parent();

            $('.btn-buy-arr').removeClass('selected');
            $('.btn-buy-arr').parent().parent().removeClass('fl-selected');

            $(this).addClass('selected');
            parentTr.addClass('fl-selected');

            var flNumber = parentTr.attr('data-number');
            var flPrice = parentTr.attr('data-price');
            var flPrice_child = parentTr.attr('data-child-price');
            var flPrice_infant = parentTr.attr('data-infant-price');
            var flFromDate = parentTr.attr('data-from-date');
            var flFromTime = parentTr.attr('data-from-time');
            var flToDate = parentTr.attr('data-to-date');
            var flToTime = parentTr.attr('data-to-time');
            var flFromCity = parentTr.attr('data-from-city');
            var flFromAirport = parentTr.attr('data-from-airport');
            var flToCity = parentTr.attr('data-to-city');
            var flToAirport = parentTr.attr('data-to-airport');
            var timestamp = parentTr.attr('data-timestamp');
            $('input#flight_2').val(timestamp);

            $('.fl-in-info').addClass('cont_btn').removeClass('hidden');

            $('.fl-in-info .order-number-num').html(flNumber);
            $('.fl-in-info .order-fl-price').html(flPrice);
            $('.fl-in-info .order-fromCity').html(flFromCity);
            $('.fl-in-info .order-fromAirport').html(flFromAirport);
            $('.fl-in-info .order-fromDate').html(flFromDate);
            $('.fl-in-info .order-fromTime').html(flFromTime);
            $('.fl-in-info .order-toCity').html(flToCity);
            $('.fl-in-info .order-toAirport').html(flToAirport);
            $('.fl-in-info .order-toDate').html(flToDate);
            $('.fl-in-info .order-toTime').html(flToTime);
            calculate_flight_fee(2, flPrice, flPrice_child, flPrice_infant);

            @if(count($fly_days_return) > 0)
                if(($('.fl-in-info').hasClass('cont_btn')) && ($('.fl-out-info').hasClass('cont_btn'))) {
                    $('.sidebar footer').removeClass('hidden');
                }
            @else
                if($('.fl-in-info').hasClass('cont_btn')){
                    $('.sidebar footer').removeClass('hidden');
                }
            @endif
        });

        function calculate_flight_fee(direction, flPrice, flPrice_child, flPrice_infant){
            result_price = 0;
            if (direction==1) {
                price_1 = parseInt(flPrice);
                price_child_1 = parseInt(flPrice_child);
                price_infant_1 = parseInt(flPrice_infant);
            }
            else {
                price_2 = parseInt(flPrice);
                price_child_2 = parseInt(flPrice_child);
                price_infant_2 = parseInt(flPrice_infant);
            }
            result_price = price_1 * adult_count + price_child_1 * child_count + price_infant_1 * infant_count + price_2 * adult_count + price_child_2 * child_count + price_infant_2 * infant_count;
            $('#order_total_sum').html(result_price);
            $('#order_total_sum_post').val(result_price);
            
        }

                }
            });
        });
        $('.arrival ul.nav-justified a').click(function(e){
            e.preventDefault();
            var url = "{{ route('front.pickDateReturn') }}";
            $(this).parent().siblings().removeClass('current');
            $(this).parent().addClass('current');

            $.ajax
            ({
                type: "POST",
                url: url,
                data: {
                    date_return    : $(this).attr('data-date-return')
                },
                cache: false,
                success: function (data) {
                    if(data){
                        $("#flightsBodyReturn").html(data);
                    }
                    else{
                        console.log('no data');
                    }

                    $('.btn-buy-dep').click(function (e) {
            e.preventDefault();

            var parentTr = $(this).parent().parent();

            $('.btn-buy-dep').removeClass('selected');
            $('.btn-buy-dep').parent().parent().removeClass('fl-selected');

            $(this).addClass('selected');
            parentTr.addClass('fl-selected');

            var flNumber = parentTr.attr('data-number');
            var flPrice = parentTr.attr('data-price');
            var flPrice_child = parentTr.attr('data-child-price');
            var flPrice_infant = parentTr.attr('data-infant-price');
            var flFromDate = parentTr.attr('data-from-date');
            var flFromTime = parentTr.attr('data-from-time');
            var flToDate = parentTr.attr('data-to-date');
            var flToTime = parentTr.attr('data-to-time');
            var flFromCity = parentTr.attr('data-from-city');
            var flFromAirport = parentTr.attr('data-from-airport');
            var flToCity = parentTr.attr('data-to-city');
            var flToAirport = parentTr.attr('data-to-airport');
            var timestamp = parentTr.attr('data-timestamp');
            $('input#flight_1').val(timestamp);
            $('.toTable').slideDown(400);

            $('.fl-out-info').addClass('cont_btn').removeClass('hidden');
            
            $('.fl-out-info .order-number-num').html(flNumber);
            $('.fl-out-info .order-fl-price').html(flPrice);
            $('.fl-out-info .order-fromCity').html(flFromCity);
            $('.fl-out-info .order-fromAirport').html(flFromAirport);
            $('.fl-out-info .order-fromDate').html(flFromDate);
            $('.fl-out-info .order-fromTime').html(flFromTime);
            $('.fl-out-info .order-toCity').html(flToCity);
            $('.fl-out-info .order-toAirport').html(flToAirport);
            $('.fl-out-info .order-toDate').html(flToDate);
            $('.fl-out-info .order-toTime').html(flToTime);
            @if (count($fly_days_return) == 0) $('.sidebar footer').removeClass('hidden'); @endif
            calculate_flight_fee(1, flPrice, flPrice_child, flPrice_infant);

            @if(count($fly_days_return) > 0)
                if(($('.fl-in-info').hasClass('cont_btn')) && ($('.fl-out-info').hasClass('cont_btn'))) {
                    $('.sidebar footer').removeClass('hidden');
                }
            @else
                if($('.fl-in-info').hasClass('cont_btn')){
                    $('.sidebar footer').removeClass('hidden');
                }
            @endif
        });

        $('.btn-buy-arr').click(function (e) {
            e.preventDefault();

            var parentTr = $(this).parent().parent();

            $('.btn-buy-arr').removeClass('selected');
            $('.btn-buy-arr').parent().parent().removeClass('fl-selected');

            $(this).addClass('selected');
            parentTr.addClass('fl-selected');

            var flNumber = parentTr.attr('data-number');
            var flPrice = parentTr.attr('data-price');
            var flPrice_child = parentTr.attr('data-child-price');
            var flPrice_infant = parentTr.attr('data-infant-price');
            var flFromDate = parentTr.attr('data-from-date');
            var flFromTime = parentTr.attr('data-from-time');
            var flToDate = parentTr.attr('data-to-date');
            var flToTime = parentTr.attr('data-to-time');
            var flFromCity = parentTr.attr('data-from-city');
            var flFromAirport = parentTr.attr('data-from-airport');
            var flToCity = parentTr.attr('data-to-city');
            var flToAirport = parentTr.attr('data-to-airport');
            var timestamp = parentTr.attr('data-timestamp');
            $('input#flight_2').val(timestamp);

            $('.fl-in-info').addClass('cont_btn').removeClass('hidden');

            $('.fl-in-info .order-number-num').html(flNumber);
            $('.fl-in-info .order-fl-price').html(flPrice);
            $('.fl-in-info .order-fromCity').html(flFromCity);
            $('.fl-in-info .order-fromAirport').html(flFromAirport);
            $('.fl-in-info .order-fromDate').html(flFromDate);
            $('.fl-in-info .order-fromTime').html(flFromTime);
            $('.fl-in-info .order-toCity').html(flToCity);
            $('.fl-in-info .order-toAirport').html(flToAirport);
            $('.fl-in-info .order-toDate').html(flToDate);
            $('.fl-in-info .order-toTime').html(flToTime);
            calculate_flight_fee(2, flPrice, flPrice_child, flPrice_infant);

            @if(count($fly_days_return) > 0)
                if(($('.fl-in-info').hasClass('cont_btn')) && ($('.fl-out-info').hasClass('cont_btn'))) {
                    $('.sidebar footer').removeClass('hidden');
                }
            @else
                if($('.fl-in-info').hasClass('cont_btn')){
                    $('.sidebar footer').removeClass('hidden');
                }
            @endif
        });

        function calculate_flight_fee(direction, flPrice, flPrice_child, flPrice_infant){
            result_price = 0;
            if (direction==1) {
                price_1 = parseInt(flPrice);
                price_child_1 = parseInt(flPrice_child);
                price_infant_1 = parseInt(flPrice_infant);
            }
            else {
                price_2 = parseInt(flPrice);
                price_child_2 = parseInt(flPrice_child);
                price_infant_2 = parseInt(flPrice_infant);
            }
            result_price = price_1 * adult_count + price_child_1 * child_count + price_infant_1 * infant_count + price_2 * adult_count + price_child_2 * child_count + price_infant_2 * infant_count;
            $('#order_total_sum').html(result_price);
            $('#order_total_sum_post').val(result_price);
            
        }
                }
            });

        });

        $('.btn-buy-dep').click(function (e) {
            e.preventDefault();

            var parentTr = $(this).parent().parent();

            $('.btn-buy-dep').removeClass('selected');
            $('.btn-buy-dep').parent().parent().removeClass('fl-selected');

            $(this).addClass('selected');
            parentTr.addClass('fl-selected');

            var flNumber = parentTr.attr('data-number');
            var flPrice = parentTr.attr('data-price');
            var flPrice_child = parentTr.attr('data-child-price');
            var flPrice_infant = parentTr.attr('data-infant-price');
            var flFromDate = parentTr.attr('data-from-date');
            var flFromTime = parentTr.attr('data-from-time');
            var flToDate = parentTr.attr('data-to-date');
            var flToTime = parentTr.attr('data-to-time');
            var flFromCity = parentTr.attr('data-from-city');
            var flFromAirport = parentTr.attr('data-from-airport');
            var flToCity = parentTr.attr('data-to-city');
            var flToAirport = parentTr.attr('data-to-airport');
            var timestamp = parentTr.attr('data-timestamp');
            $('input#flight_1').val(timestamp);
            $('.toTable').slideDown(400);

            $('.fl-out-info').addClass('cont_btn').removeClass('hidden');
            
            $('.fl-out-info .order-number-num').html(flNumber);
            $('.fl-out-info .order-fl-price').html(flPrice);
            $('.fl-out-info .order-fromCity').html(flFromCity);
            $('.fl-out-info .order-fromAirport').html(flFromAirport);
            $('.fl-out-info .order-fromDate').html(flFromDate);
            $('.fl-out-info .order-fromTime').html(flFromTime);
            $('.fl-out-info .order-toCity').html(flToCity);
            $('.fl-out-info .order-toAirport').html(flToAirport);
            $('.fl-out-info .order-toDate').html(flToDate);
            $('.fl-out-info .order-toTime').html(flToTime);
            @if (count($fly_days_return) == 0) $('.sidebar footer').removeClass('hidden'); @endif
            calculate_flight_fee(1, flPrice, flPrice_child, flPrice_infant);

            @if(count($fly_days_return) > 0)
                if(($('.fl-in-info').hasClass('cont_btn')) && ($('.fl-out-info').hasClass('cont_btn'))) {
                    $('.sidebar footer').removeClass('hidden');
                }
            @else
                if($('.fl-in-info').hasClass('cont_btn')){
                    $('.sidebar footer').removeClass('hidden');
                }
            @endif
        });

        $('.btn-buy-arr').click(function (e) {
            e.preventDefault();

            var parentTr = $(this).parent().parent();

            $('.btn-buy-arr').removeClass('selected');
            $('.btn-buy-arr').parent().parent().removeClass('fl-selected');

            $(this).addClass('selected');
            parentTr.addClass('fl-selected');

            var flNumber = parentTr.attr('data-number');
            var flPrice = parentTr.attr('data-price');
            var flPrice_child = parentTr.attr('data-child-price');
            var flPrice_infant = parentTr.attr('data-infant-price');
            var flFromDate = parentTr.attr('data-from-date');
            var flFromTime = parentTr.attr('data-from-time');
            var flToDate = parentTr.attr('data-to-date');
            var flToTime = parentTr.attr('data-to-time');
            var flFromCity = parentTr.attr('data-from-city');
            var flFromAirport = parentTr.attr('data-from-airport');
            var flToCity = parentTr.attr('data-to-city');
            var flToAirport = parentTr.attr('data-to-airport');
            var timestamp = parentTr.attr('data-timestamp');
            $('input#flight_2').val(timestamp);

            $('.fl-in-info').addClass('cont_btn').removeClass('hidden');

            $('.fl-in-info .order-number-num').html(flNumber);
            $('.fl-in-info .order-fl-price').html(flPrice);
            $('.fl-in-info .order-fromCity').html(flFromCity);
            $('.fl-in-info .order-fromAirport').html(flFromAirport);
            $('.fl-in-info .order-fromDate').html(flFromDate);
            $('.fl-in-info .order-fromTime').html(flFromTime);
            $('.fl-in-info .order-toCity').html(flToCity);
            $('.fl-in-info .order-toAirport').html(flToAirport);
            $('.fl-in-info .order-toDate').html(flToDate);
            $('.fl-in-info .order-toTime').html(flToTime);
            calculate_flight_fee(2, flPrice, flPrice_child, flPrice_infant);

            @if(count($fly_days_return) > 0)
                if(($('.fl-in-info').hasClass('cont_btn')) && ($('.fl-out-info').hasClass('cont_btn'))) {
                    $('.sidebar footer').removeClass('hidden');
                }
            @else
                if($('.fl-in-info').hasClass('cont_btn')){
                    $('.sidebar footer').removeClass('hidden');
                }
            @endif
        });

        function calculate_flight_fee(direction, flPrice, flPrice_child, flPrice_infant){
            result_price = 0;
            if (direction==1) {
                price_1 = parseInt(flPrice);
                price_child_1 = parseInt(flPrice_child);
                price_infant_1 = parseInt(flPrice_infant);
            }
            else {
                price_2 = parseInt(flPrice);
                price_child_2 = parseInt(flPrice_child);
                price_infant_2 = parseInt(flPrice_infant);
            }
            result_price = price_1 * adult_count + price_child_1 * child_count + price_infant_1 * infant_count + price_2 * adult_count + price_child_2 * child_count + price_infant_2 * infant_count;
            $('#order_total_sum').html(result_price);
            $('#order_total_sum_post').val(result_price);
            
        }
    });

</script>
<script>

    function asideSticky() {
        var container = $('.search-flight '),
            sidebar   = $('.sidebar'),
            sidebarWidth   = sidebar.outerWidth(),
            right   = ($(window).outerWidth() - container.width())/2;

        window.addEventListener('scroll', function(e){
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 342;

            if (distanceY > shrinkOn) {
                sidebar.css({
                    'position' : 'fixed',
                    'top'      : '32px',
                    'right'    : right,
                    'width'    : sidebarWidth
                });
            } else {
                sidebar.removeAttr('style');
            }
        });
    }
    window.onload = asideSticky();
</script>
@stop