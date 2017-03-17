@include('Front::partials.includes')
@include('Front::partials.header')
<div class="hero">
    <div class="search-flight full-width">
        <h1>Результаты поиска</h1>
        <ul class="wizard">
            <li class="visited"><a href="index.html">Поиск</a></li>
            <li class="current"><em>Рейсы</em></li>
            <li><em>Информация</em></li>
            <li><em>Потверждение</em></li>
        </ul>

        <div class="row">


            <main class="grid grid-70">

                <div class="departure">
                    <h4>
                        <span>Вылет</span>
                        {{ $departure }}
                        -
                        {{ $destination }}
                    </h4>

                    <ul class="tabs nav nav-tabs nav-justified">
                        {{--*/ $view = 1 /*--}} 
                        @for($i=0; $i<count($fly_days); $i++)
                            {{--*/ $least_price = 0 /*--}}
                            @if($fly_days[$i])
                                @foreach($fly_days[$i] as $this_flight)
                                
                                    @if ($least_price == 0 || ($this_flight->adultPriceSom>0 && $this_flight->adultPriceSom < $least_price))
                                        {{--*/ $least_price = $this_flight->adultPriceSom /*--}}
                                    @endif
                                @endforeach

                                 
                                {{--*/ $departureDayru = $fly_days[$i][0]->departureDayru() /*--}}
                                {{--*/ $departureWeekru = $fly_days[$i][0]->departureWeekru() /*--}}
                                {{--*/ $departureMonthru = $fly_days[$i][0]->departureMonthru() /*--}}
                                {{--*/ $day_str = $fly_days[$i][0]->departure_date() /*--}}
                                
                                @if ($day_str)
                                    {{--*/  $day = strtotime($day_str) /*--}}
                            <li role="presentation" @if ($dept_d==$day ) class="current" @endif>
                                <a href="#view{{ $view }}">
                                    <span class="weekday">{{ $departureWeekru }}</span>
                                    <span class="date">{{ $departureDayru }}</span>
                                    <span class="month">{{ $departureMonthru }}</span>
                                </a>
                            </li>
                                    {{--*/ $view++ /*--}}
                                @endif
                            @endif
                        @endfor
                    </ul>

            
                <div class="tabcontents">
                    {{--*/ $view = 1 /*--}}
                    @for($i=0; $i<count($fly_days); $i++)
                        @if($fly_days[$i])
                            {{--*/ $day_str = $fly_days[$i][0]->departure_date() /*--}}
                        @if($day_str)
                            {{--*/ $day = strtotime($day_str) /*--}}
                    <div class="flights tab-content tab-1 current clearfix" id="view{{ $view }}">  
                        
                        <table class="table table-bordered col-lg-12 no-padding">
                            <thead>
                            <tr>
                                <th>Рейс</th>
                                <th>Маршрут</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                            </thead>

                        

                            
                            <tbody>
                            {{--*/ $jcounter=0 /*--}}
                            @for($j=0; $j<count($fly_days[$i]); $j++)
                                {{--*/ $ddt_str = $fly_days[$i][$j]->departureDateTime /*--}}
                                {{--*/ $adt_str = $fly_days[$i][$j]->arrivalDateTime /*--}}
                                {{--*/ $ddt = strtotime($ddt_str) /*--}}
                                {{--*/ $adt = strtotime($adt_str) /*--}}
                            <tr class="" data-price="{{ $fly_days[$i][$j]->adultPriceSom }}" data-child-price="{{ $fly_days[$i][$j]->childPriceSom }}" data-infant-price="{{ $fly_days[$i][$j]->infPriceSom }}" data-number="{{ $fly_days[$i][$j]->flightNumber}}" data-from-date="{{ date('d.m.Y', $ddt) }}" data-from-time="{{ date('H:i', $ddt) }}" data-from-city="{{ $airport_loc[$fly_days[$i][$j]->departureAirport] }}" data-from-airport="{{ $fly_days[$i][$j]->departureAirport }}" data-to-date="{{ date('d.m.Y', $adt) }}" data-to-time="{{ date('H:i', $adt) }}" data-to-city="{{ $airport_loc[$fly_days[$i][$j]->arrivalAirport] }}" data-to-airport="{{ $fly_days[$i][$j]->arrivalAirport }}" data-timestamp="{{ $fly_days[$i][$j]->timestamp }}">
                                <td class="flight">{{ $fly_days[$i][$j]->flightNumber }}</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">{{ date('H:i', $ddt) }}</span>
                                        <span class="place">
                                        {{ $departure }} 
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
                                        <span class="time">{{ date('H:i', $adt) }}</span>
                                        <span class="place">
                                        {{ $destination }}
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
                                    <!-- <button class="btn">
                                        Купить
                                    </button>-->
                                    <div class="radio">
                                        <input id="flight1" type="radio" name="radio_fl_out" class="form-control">
                                    <label for="flight1"></label>
                                </td>
                            </tr>
                            {{--*/ $jcounter++ /*--}} 
                            @endfor
                            @if($jcounter==0)
                            <tr class="" data-price="0" data-number="0" data-from-date="01.01.2011" data-from-time="16:45" data-from-city="BB" data-from-airport="AA" data-to-date="01.01.2011" data-to-time="17:25" data-to-city="oo" data-to-airport="oo">
                                <td colspan="5">Свободных мест нет!</td>
                            </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                    {{--*/ $view++ /*--}}
                    @endif
                    @else
                    @endif
                    @endfor

                </div><!-- tabcontents end -->
                </div><!-- departure end -->

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

    @if(count($fly_days_return) > 0)

                <div class="arrival">
                    <h4>
                        <span>Прибытие</span>
                        {{ $destination }}
                        -
                        {{ $departure }}
                    </h4>

                    <ul class="tabs nav nav-tabs nav-justified">
                    {{--*/ $view = 1 /*--}}
                    @for($i=0; $i<count($fly_days_return); $i++)
                    @if($fly_days_return[$i])
                        {{--*/ $least_price = 0 /*--}}
                        @foreach($fly_days_return[$i] as $this_flight)
                            @if($least_price == 0 || ($this_flight->adultPriceSom>0 && $this_flight->adultPriceSom < $least_price))
                                {{--*/ $least_price = $this_flight->adultPriceSom /*--}}
                            @endif
                        @endforeach
                         
                        {{--*/ $rdepartureDayru = $fly_days_return[$i][0]->departureDayru() /*--}}
                        {{--*/ $rdepartureWeekru = $fly_days_return[$i][0]->departureWeekru() /*--}}
                        {{--*/ $rdepartureMonthru = $fly_days_return[$i][0]->departureMonthru() /*--}}

                        $day_str = $fly_days_return[$i][0]->departure_date() /*--}}
                        @if ($day_str)
                            {{--*/ $day = strtotime($day_str) /*--}}
                        <li role="presentation"@if($retn_d==$day ) class="current" @endif>
                            <a href="#viewt{{ $view }}">
                                <span class="weekday">{{ $rdepartureWeekru }}</span>
                                <span class="date">{{ $rdepartureDayru }}</span>
                                <span class="month">{{ $rdepartureMonthru }}</span>
                            </a>
                        </li>
                    {{--*/  $view++ /*--}}
                    @endif
                    @endif
                    @endfor
                    </ul>

                    
                    {{--*/  $view = 1 /*--}}
                    @for($i=0; $i<count($fly_days_return); $i++)
                        @if($fly_days_return[$i])
                        {{--*/ $day_str = $fly_days_return[$i][0]->departure_date() /*--}}
                        @if($day_str) 
                            {{--*/ $day = strtotime($day_str) /*--}}
                    <div class="flightstab-content tab-1 current clearfix" id="view{{ $view }}">  
                        <table class="table table-bordered col-lg-12 no-padding">
                            <thead>
                            <tr>
                                <th>Рейс</th>
                                <th>Маршрут</th>
                                <th>Стоимость</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            {{--*/ $jcounter=0 /*--}}
                            @for($j=0; $j<count($fly_days_return[$i]); $j++)
                                @if($fly_days_return[$i][$j]->adultPrice==0) continue @endif
                                {{--*/ $ddt_str = $fly_days_return[$i][$j]->departureDateTime /*--}}
                                {{--*/ $adt_str = $fly_days_return[$i][$j]->arrivalDateTime /*---}}
                                {{--*/ $ddt = strtotime($ddt_str) /*--}} 
                                {{--*/ $adt = strtotime($adt_str) /*--}} 
                            <tr class="" data-price="{{ $fly_days_return[$i][$j]->adultPriceSom }}" data-child-price="{{ $fly_days_return[$i][$j]->childPriceSom }}" data-infant-price="{{ $fly_days_return[$i][$j]->infPriceSom }}" data-number="{{ $fly_days_return[$i][$j]->flightNumber}}" data-from-date="{{ date('d.m.Y', $ddt) }}" data-from-time="{{ date('H:i', $ddt)}}" data-from-city="{{ $airport_loc[$fly_days_return[$i][$j]->departureAirport] }}" data-from-airport="{{ $fly_days_return[$i][$j]->departureAirport }}" data-to-date="{{ date('d.m.Y', $adt) }}" data-to-time="{{ date('H:i', $adt)}}" data-to-city="{{ $airport_loc[$fly_days_return[$i][$j]->arrivalAirport] }}" data-to-airport="{{ $fly_days_return[$i][$j]->arrivalAirport }}" data-timestamp="{{ $fly_days_return[$i][$j]->timestamp }}">
                                <td class="flight">{{ $fly_days_return[$i][$j]->flightNumber }}</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">{{ date('H:i', $ddt) }}</span>
                                        <span class="place">
                                        {{ $destination }}
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
                                        <span class="time">{{ date('H:i', $adt) }}</span>
                                        <span class="place">
                                        {{ $departure }}
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    {{ $fly_days_return[$i][$j]->adultPriceSom }}
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <div class="radio">
                                        <input id="flight1" type="radio" name="radio_fl_out" class="form-control">
                                        <label for="flight1"></label>
                                    </div>
                                </td>
                            </tr>
                            {{--*/ $jcounter++ /*--}}
                            @endfor 
                            @if($jcounter==0)
                            <tr class="" data-price="0" data-number="0" data-from-date="01.01.2011" data-from-time="16:45" data-from-city="BB" data-from-airport="AA" data-to-date="01.01.2011" data-to-time="17:25" data-to-city="oo" data-to-airport="oo">
                                <td colspan="5">Бош орун жок</td>
                            </tr>
                            @endif

                            
                            </tbody>
                        </table>
                    </div>
                    {{--*/ $view++ /*--}}
                    @endif
                    @endif
                    @endfor
                </div>
        @endif

            </main>

            <aside class="grid grid-30">
            <!-- order-info -->
            <div class="order-info col-lg-3">
                <table class="col-lg-12 table table-bordered no-padding">
                    <tr class="order-info-header">
                        <td class="col-lg-12" colspan="4">Информация о заказе Тапшырык жѳнүндѳ маалымат</td>
                    </tr>
                    <tr class="order-type-person ">
                        <td class="order-type col-lg-6" colspan="2">
                        @if($return_date) туда и обратно @else в один конец @endif
                        </td>
                        <td class="order-person col-lg-6" colspan="2">
                            <span>@if ($adult_count>0) Взрослые: {{ $adult_count }} @endif</span>
                            <span>@if ($child_count>0) Дети: {{ $child_count }} @endif</span>
                            <span>@if ($infant_count>0) Младенцы: {{ $infant_count }} @endif</span>
                        </td>
                    </tr>

                    <tbody>
                        <tr class="warning single fl_out_header">
                            <td class="order-dir col-lg-12" colspan="4">Отправление</td>
                        </tr>
                        <tr class="warning single fl_out_num_price">
                            <td class="order-number col-lg-6 col-md-6 col-sm-6 col-xs-6" colspan="2">
                                <span>номер рейса</span>
                                <span class="order-number-num"></span>
                            </td>
                            <td class="order-dir-price col-lg-6 col-md-6 col-sm-6 col-xs-6" colspan="2">
                                <span class="order-fl-price"></span>
                                <span> с</span>
                            </td>
                        </tr>
                        <tr class="warning single fl_out_dirs">
                            <td colspan="4" class="order-dirs">
                                <ul>
                                    <li class="col-lg-5 col-md-5 col-sm-5 col-xs-5 fl_out_from_city">
                                        <span class="order-fromCity"></span>
                                        <span class="order-fromAirport"></span>
                                        <span class="order-fromDate"></span>
                                        <span class="order-fromTime"></span>
                                    </li>
                                    <li class="i-plane col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-plane"></i>
                                    </li>
                                    <li class="col-lg-5 col-md-5 col-sm-5 col-xs-5 fl_out_to_city">
                                        <span class="order-toCity"></span>
                                        <span class="order-toAirport"></span>
                                        <span class="order-toDate"></span>
                                        <span class="order-toTime"></span>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>

                    <tr class="blank-space hidden">
                        <td colspan="4"></td>
                    </tr>

                    <tbody>
                        <tr class="warning roundtrip fl_in_header">
                            <td class="order-dir col-lg-12" colspan="4">Возвращение</td>
                        </tr>
                        <tr class="warning roundtrip fl_in_num_price">
                            <td class="order-number col-lg-6" colspan="2">
                                <span>номер рейса</span>
                                <span class="order-number-num"></span>
                            </td>
                            <td class="order-dir-price col-lg-6" colspan="2">
                                <span class="order-fl-price"></span>
                                <span> с</span>
                            </td>
                        </tr>
                        <tr class="warning roundtrip fl_in_dirs">
                            <td colspan="4" class="order-dirs">
                                <ul>
                                    <li class="col-lg-5 col-md-5 col-sm-5 col-xs-5 fl_out_from_city">
                                        <span class="order-fromCity"></span>
                                        <span class="order-fromAirport"></span>
                                        <span class="order-fromDate"></span>
                                        <span class="order-fromTime"></span>
                                    </li>
                                    <li class="i-plane col-lg-2 col-md-2 col-sm-2 col-xs-2">
                                        <i class="fa fa-plane"></i>
                                    </li>
                                    <li class="col-lg-5 col-md-5 col-sm-5 col-xs-5 fl_out_to_city">
                                        <span class="order-toCity"></span>
                                        <span class="order-toAirport"></span>
                                        <span class="order-toDate"></span>
                                        <span class="order-toTime"></span>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </tbody>
                    <tr class="order-total">
                        <td colspan="2">Всего</td>
                        <td class="order-total-sum" colspan="2"><span id='order_total_sum'></span></td>
                    </tr>
                </table>
                
                <div>
                    {!! Form::open(array('route' => 'front.passenger', 'method' => 'post')) !!}
                    <input type="hidden" name="flight_1" id="flight_1" />
                    <input type="hidden" name="flight_2" id="flight_2" />
                    <input type="hidden" name="adult_count" id="adult_count" value="{{ $adult_count }}" />
                    <input type="hidden" name="child_count" id="child_count" value="{{ $child_count }}" />
                    <input type="hidden" name="infant_count" id="infant_count" value="{{ $infant_count }}" />
                    <button type="submit" class="hidden continue-btn btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">Продолжить</button>
                    {!! Form::close() !!}                
                    
                    
                </div>
            </div>
            </aside>
        </div>

    </div><!-- end of hero -->
@include('Front::partials.footerResultPage')