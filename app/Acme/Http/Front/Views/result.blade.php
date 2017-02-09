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

                    <ul class="nav-justified">
                        {{--*/ $view = 1 /*--}} 
                        @for($i=0; $i<count($fly_days); $i++)
                            {{--*/ $least_price = 0 /*--}}
                            @if($fly_days[$i])
                                @foreach($fly_days[$i] as $this_flight)
                                
                                    @if ($least_price == 0 || ($this_flight->adultPriceSom>0 && $this_flight->adultPriceSom < $least_price))
                                        {{--*/ $least_price = $this_flight->adultPriceSom /*--}}
                                    @endif
                                @endforeach

                                {{--*/ $day_str = $fly_days[$i][0]->departure_date() /*--}}
                                
                                @if ($day_str)
                                    {{--*/  $day = strtotime($day_str) /*--}}
                            <li role="presentation" @if ($dept_d==$day ) class="current" @endif>
                                <a href="#view{{ $view }}">
                                    <span class="tday hidden-xs">{{ date('d', $day) }}</span>
                                    <span class="tday hidden-lg hidden-md hidden-sm">12</span>
                                    <span class="tmonth-tweek">
                                        <span class="tmonth hidden-xs"> {{ date('F', $day) }}</span><span class="tweek"> 
                                        {{ date('D', $day) }}</span>
                                        <span style="color:red; font-size:10px">@if($least_price>0) {{ $least_price}} сом @else no flight @endif</span>
                                    </span>
                                    <div class="clear"></div>
                                </a>
                            </li>
                                    {{--*/ $view++ /*--}}
                                @endif
                            @endif
                        @endfor
                        <li class="current">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                       
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
                            <tbody>
                            <tr>
                                <td class="flight">193</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">07:35</span>
                                        <span class="place">
                                        FRU, Бишкек
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
                                        <span class="time">08:10</span>
                                        <span class="place">
                                        OSS, Ош
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    2448
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <button class="btn">
                                        Купить
                                    </button>
                                    <!--<div class="radio">-->
                                    <!--<input id="flight1" type="radio" name="radio_fl_out" class="form-control">-->
                                    <!--<label for="flight1"></label>-->
                                    <!--</div>-->
                                </td>
                            </tr>
                            <tr>
                                <td class="flight">193</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">07:35</span>
                                        <span class="place">
                                        FRU, Бишкек
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
                                        <span class="time">08:10</span>
                                        <span class="place">
                                        OSS, Ош
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    2448
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <button class="btn">
                                        Купить
                                    </button>
                                    <!--<div class="radio">-->
                                    <!--<input id="flight2" type="radio" name="radio_fl_out" class="form-control">-->
                                    <!--<label for="flight2"></label>-->
                                    <!--</div>-->
                                </td>
                            </tr>
                            <tr>
                                <td class="flight">193</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">07:35</span>
                                        <span class="place">
                                        FRU, Бишкек
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
                                        <span class="time">08:10</span>
                                        <span class="place">
                                        OSS, Ош
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    2448
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <button class="btn">
                                        Купить
                                    </button>
                                    <!--<div class="radio">-->
                                    <!--<input id="flight3" type="radio" name="radio_fl_out" class="form-control">-->
                                    <!--<label for="flight3"></label>-->
                                    <!--</div>-->
                                </td>
                            </tr>
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

                <div class="arrival">
                    <h4>
                        <span>Прибытие</span>
                        Ош
                        <!--<i>-->
                        <!--<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"-->
                        <!--viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve">-->
                        <!--<g>-->
                        <!--<g>-->
                        <!--<path d="M15.6,13.6l7.5-0.8c0.1,0,0.2-0.1,0.3-0.1l0.4-0.4c0.2-0.2,0.2-0.5,0-0.7l-0.4-0.4c-0.1-0.1-0.2-0.1-0.3-0.1l-7.5-0.7-->
                        <!--L8.8,1.6C8.7,1.5,8.6,1.4,8.5,1.4H6.9C6.6,1.4,6.4,1.7,6.5,2l3.3,8.4L3,11.2L1.2,8.4C1.1,8.3,0.9,8.2,0.9,8.2H0.5-->
                        <!--C0.2,8.2,0,8.5,0.1,8.8l1,3.2l-1,3.2c-0.1,0.3,0.1,0.6,0.4,0.6h0.4c0.2,0,0.3-0.1,0.3-0.2L3,12.8l6.8,0.8L6.5,22-->
                        <!--c-0.1,0.3,0.1,0.6,0.4,0.6h1.6c0.2,0,0.3-0.1,0.3-0.2L15.6,13.6z"/>-->
                        <!--</g>-->
                        <!--</g>-->
                        <!--</svg>-->
                        <!--</i>-->
                        -
                        Бишкек
                    </h4>

                    <ul class="nav-justified">
                        <li class="">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                        <li class="current">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
                        <li class="">
                            <a href="#">
                                <span class="weekday">ПН</span>
                                <span class="date">02</span>
                                <span class="month">февраль</span>
                            </a>
                        </li>
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
                            <tbody>
                            <tr>
                                <td class="flight">193</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">07:35</span>
                                        <span class="place">
                                        FRU, Бишкек
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
                                        <span class="time">08:10</span>
                                        <span class="place">
                                        OSS, Ош
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    2448
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <button class="btn">
                                        Купить
                                    </button>
                                    <!--<div class="radio">-->
                                    <!--<input id="flight1" type="radio" name="radio_fl_out" class="form-control">-->
                                    <!--<label for="flight1"></label>-->
                                    <!--</div>-->
                                </td>
                            </tr>
                            <tr>
                                <td class="flight">193</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">07:35</span>
                                        <span class="place">
                                        FRU, Бишкек
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
                                        <span class="time">08:10</span>
                                        <span class="place">
                                        OSS, Ош
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    2448
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <button class="btn">
                                        Купить
                                    </button>
                                    <!--<div class="radio">-->
                                    <!--<input id="flight2" type="radio" name="radio_fl_out" class="form-control">-->
                                    <!--<label for="flight2"></label>-->
                                    <!--</div>-->
                                </td>
                            </tr>
                            <tr>
                                <td class="flight">193</td>
                                <td class="direction">
                                    <div class="dep-info text-right grid grid-40">
                                        <span class="time">07:35</span>
                                        <span class="place">
                                        FRU, Бишкек
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
                                        <span class="time">08:10</span>
                                        <span class="place">
                                        OSS, Ош
                                    </span>
                                    </div>
                                </td>
                                <td class="price">
                                <span class="count">
                                    2448
                                </span>
                                    <span class="currency">
                                    сом
                                </span>
                                </td>
                                <td class="check">
                                    <button class="btn">
                                        Купить
                                    </button>
                                    <!--<div class="radio">-->
                                    <!--<input id="flight3" type="radio" name="radio_fl_out" class="form-control">-->
                                    <!--<label for="flight3"></label>-->
                                    <!--</div>-->
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </main>

            <aside class="grid grid-30">

            </aside>
        </div>

    </div><!-- end of hero -->
@include('Front::partials.footer')