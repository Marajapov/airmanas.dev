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
        <li class="visited"><a href="{{ route('front.home') }}">Поиск</a></li>
        <li class="visited"><a href="#">Рейсы</a></li>
        <li class="current"><em>Информация</em></li>
        <li><em>Потверждение</em></li>
    </ul>


    <main class="content grid grid-70 grid-padding-right">

        {!! Form::open(array('route' => 'front.flight_preview', 'method' => 'post')) !!}
            <div>
                <h4>
                    Информация о пассажирах
                </h4>

                <div class="passengers">
                    <table class="table p-table">
                        <thead>
                        <tr>
                            <th>Пол</th>
                            <th>Имя</th>
                            <th>Фамилия</th>
                            <th>Дата рождения</th>
                        </tr>
                        </thead>
                        <tbody>
                        @for($i=0; $i < $adult_count; $i++)
                        <tr class="no-border adult">
                            <td colspan="4" class="hidden">
                                <span>{{ $i+1 }} x</span>
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 28.4 64" style="enable-background:new 0 0 28.4 64;" xml:space="preserve">
<g>
    <circle cx="14.2" cy="7.1" r="7.1"/>
    <path d="M28.4,20.9c-0.2-1.8-1.7-3.1-3.6-3.1h-3.6H7.1H3.6c-1.8,0-3.3,1.3-3.6,3.1c0,0.1,0,0.4,0,0.5v20.1c0,1.3,1.1,2.4,2.4,2.4
        s2.4-1.1,2.4-2.4V26.1c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2v35.6c0,1.3,1.1,2.4,2.4,2.4H19c1.3,0,2.4-1.1,2.4-2.4V26.1
        c0-0.7,0.5-1.2,1.2-1.2s1.2,0.5,1.2,1.2v15.4c0,1.3,1.1,2.4,2.4,2.4s2.4-1.1,2.4-2.4V21.3C28.4,21.2,28.4,21,28.4,20.9z"/>
</g>
</svg>
                            </td>
                        </tr>

                        <tr>
                            <td class="p-gender">
                                <select class="form-control selectpicker" name="sex{{ $counter }}" data-width="auto" required>
                                    <option selected disabled>пол</option>
                                    <option value="M" selected="">м</option>
                                    <option value="F">ж</option>
                                </select>
                            </td>
                            <td class="p-name">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name{{ $counter}}" required>
                                </div>
                            </td>
                            <td class="p-surname">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="surname{{ $counter }}" required>
                                </div>
                            </td>
                            <td class="p-birthdate">
                                <select class="form-control selectpicker" name="bd_day{{ $counter }}" title="день" data-size="8" data-width="fit">
                                @for($k=1;$k<32;$k++)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endfor
                                </select>

                                {{--*/ $options = makeSelectOptionMonths() /*--}}

                                <select class="form-control selectpicker" name="bd_month{{ $counter }}" title="месяц" data-size="8" data-width="fit">
                                    <option selected disabled>месяц</option>
                                    <?php echo $options; ?>
                                </select>

                                <select class="form-control selectpicker" name="bd_year{{ $counter }}" title="год" data-size="8" data-width="fit">
                                    @for($k=$this_year;$k>1900;$k--)
                                        <option value="{{ $k}}">{{ $k }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        {{--*/ $counter++ /*--}}
                        @endfor

                        @for($i=0; $i < $child_count; $i++)
                        <tr class="no-border child">
                            <td colspan="4" class="hidden">
                                <span>{{--*/ $i+1 /*--}} x</span>
                                <svg version="1.1" id="Слой_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 22.6 32" style="enable-background:new 0 0 22.6 32;" xml:space="preserve">
<g>
    <path d="M22.2,7.9c-0.7-0.7-1.7-0.7-2.4,0l-4.4,4.4H7.3L2.9,7.9c-0.7-0.7-1.7-0.7-2.4,0s-0.7,1.7,0,2.4l6.3,6.3v6.2v4.5v2.9
        c0,0.9,0.8,1.7,1.7,1.7s1.7-0.8,1.7-1.7v-2.9v-2.1c0-0.7,0.5-1.1,1.1-1.1c0.7,0,1.1,0.5,1.1,1.1v2.1v2.9c0,0.9,0.8,1.7,1.7,1.7
        s1.7-0.8,1.7-1.7v-2.9v-4.6v-6.2l6.3-6.3C22.8,9.6,22.8,8.6,22.2,7.9z"/>
    <circle cx="11.4" cy="5" r="5"/>
</g>
</svg>
                            </td>
                        </tr>
                        <tr>
                            <td class="p-gender">
                                <select class="form-control selectpicker" name="sex{{ $counter }}" data-width="auto" required>
                                    <option selected disabled>пол</option>
                                    <option value="M" selected="">м</option>
                                    <option value="F">ж</option>
                                </select>
                            </td>
                            <td class="p-name">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name{{ $counter}}" required>
                                </div>
                            </td>
                            <td class="p-surname">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="surname{{ $counter }}" required>
                                </div>
                            </td>
                            <td class="p-birthdate">
                                <select class="form-control selectpicker" name="bd_day{{ $counter }}" title="день" data-size="8" data-width="fit">
                                @for($k=1;$k<32;$k++)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endfor
                                </select>

                                {{--*/ $options = makeSelectOptionMonths() /*--}}

                                <select class="form-control selectpicker" name="bd_month{{ $counter }}" title="месяц" data-size="8" data-width="fit">
                                    <option selected disabled>месяц</option>
                                    <?php echo $options; ?>
                                </select>

                                <select class="form-control selectpicker" name="bd_year{{ $counter }}" title="год" data-size="8" data-width="fit">
                                    @for($k=$this_year;$k>1900;$k--)
                                        <option value="{{ $k}}">{{ $k }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        {{--*/ $counter++ /*--}}
                        @endfor

                        @for($i=0; $i < $infant_count; $i++)
                        <tr class="no-border infant">
                            <td colspan="4" class="hidden">
                                <span>{{--*/ $i+1 /*--}} x</span>
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
                            </td>
                        </tr>
                        <tr>
                            <td class="p-gender">
                                <select class="form-control selectpicker" name="sex{{ $counter }}" data-width="auto" required>
                                    <option selected disabled>пол</option>
                                    <option value="M" selected="">м</option>
                                    <option value="F">ж</option>
                                </select>
                            </td>
                            <td class="p-name">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name{{ $counter}}" required>
                                </div>
                            </td>
                            <td class="p-surname">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="surname{{ $counter }}" required>
                                </div>
                            </td>
                            <td class="p-birthdate">
                                <select class="form-control selectpicker" name="bd_day{{ $counter }}" title="день" data-size="8" data-width="fit">
                                @for($k=1;$k<32;$k++)
                                    <option value="{{ $k }}">{{ $k }}</option>
                                @endfor
                                </select>

                                {{--*/ $options = makeSelectOptionMonths() /*--}}

                                <select class="form-control selectpicker" name="bd_month{{ $counter }}" title="месяц" data-size="8" data-width="fit">
                                    <option selected disabled>месяц</option>
                                    <?php echo $options; ?>
                                </select>

                                <select class="form-control selectpicker" name="bd_year{{ $counter }}" title="год" data-size="8" data-width="fit">
                                    @for($k=$this_year;$k>1900;$k--)
                                        <option value="{{ $k}}">{{ $k }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                        {{--*/ $counter++ /*--}}
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

            <div>
                <h4>
                    Контактная информация
                </h4>

                <div class="passengers">
                    <table class="table p-table">
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
                            <td class="p-name">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </td>
                            <td class="p-surname">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="surname" required>
                                </div>
                            </td>
                            <td class="p-phone">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" required placeholder="996555111222">
                                </div>
                            </td>
                            <td class="p-email">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" required>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

                <div class="next-btn check">
                    <button class="btn" type="submit" name="submit">
                        Продолжить
                    </button>
                </div>
            </div>

        <input type="hidden" name="total" value="{{ $total }}" />
        <input type="hidden" name="flight_1" id="flight_1" value="{{ $flight_1 }}" />
        <input type="hidden" name="flight_2" id="flight_2" value="{{ $flight_2 }}" />
        <input type="hidden" name="adult_count" id="adult_count" value="{{ $adult_count }}" />
        <input type="hidden" name="child_count" id="child_count" value="{{ $child_count }}" />
        <input type="hidden" name="infant_count" id="infant_count" value="{{ $infant_count }}" />

        <input type="hidden" name="departureFlightNumber" value="{{ $departure->flightNumber }}">
        <input type="hidden" name="departureDateTime" value="{{ $departureDT }}">
        <input type="hidden" name="departureArrivalDateTime" value="{{ $departureADT }}">
        <input type="hidden" name="departureFareReference" value="{{ $departure->fareReference }}">
        <input type="hidden" name="order_total_sum_post" value="{{ $order_total_sum_post }}">
        @if($return)
            <input type="hidden" name="returnFlightNumber" value="{{ $return->flightNumber }}">
            <input type="hidden" name="returnDateTime" value="{{ $return->departureDateTime }}">
            <input type="hidden" name="returnArrivalDateTime" value="{{ $return->arrivalDateTime }}">
            <input type="hidden" name="returnFareReference" value="{{ $return->fareReference }}">
        @else
            <input type="hidden" name="returnFlightNumber" value="0">
            <input type="hidden" name="returnDateTime" value="0">
            <input type="hidden" name="returnArrivalDateTime" value="0">
            <input type="hidden" name="returnFareReference" value="0">
        @endif
        
{!! Form::close() !!}


    </main>

    <aside class="sidebar grid grid-30 grid-border-left">
        <header>
            <h4 class="fl-title">Информация о рейсе</h4>
            <ul class="clearfix fl-extra">
                <li class="order-type">
                    @if($flight_2) туда и обратно @else в один конец @endif
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

        <section class="fl-out-info">
            <h6>Отправление</h6>


            <ul class="clearfix fl-extra">
                <li class="order-number-num" data-text="Рейс">
                    {{ $departure->flightNumber }}
                </li>
                <li class="order-fl-price hidden">
                    {{ $departure->adultPriceSom }} сом
                </li>
            </ul>

            <div class="fl-info">

                <div class="fl-info-dep">
                    <h4>
                        <!-- <span class="order-fromCity">Бишкек </span> -->
                        <span class="order-fromAirport">({{ $departure->departureAirport }})</span>
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
                            <span class="order-fromTime">{{ date('H:i', strtotime($departure->departureDateTime)) }}</span>
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
                            <span class="order-fromDate">{{ date('d.m.Y', strtotime($departure->departureDateTime)) }}</span>
                        </span>
                    </div>
                </div>
                <div class="fl-info-arr">
                    <h4>
                        <!-- <span class="order-toCity">Ош</span> -->
                        <span class="order-toAirport">({{ $departure->arrivalAirport }})</span>
                    </h4>
                    <div class="fl-date-time">
                            <span>
                                <span class="order-toTime">{{ date('H:i', strtotime($departure->arrivalDateTime)) }}</span>
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
                                <span class="order-toDate">{{ date('d.m.Y', strtotime($departure->arrivalDateTime)) }}</span>
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
    
    @if ($return)
        <section class="fl-in-info hidden">
            <h6>Возвращение</h6>


            <ul class="clearfix fl-extra">
                <li class="order-number-num">
                    {{ $return->flightNumber}}
                </li>
                <li class="order-fl-price">
                    {{ $return->adultPriceSom }} сом
                </li>
            </ul>

            <div class="fl-info">

                <div class="fl-info-dep">
                    <h4>
                        <!-- <span class="order-fromCity">Бишкек </span> -->
                        <span class="order-fromAirport">({{ $return->departureAirport }})</span>
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
                            <span class="order-fromTime">{{ date('H:i', strtotime($return->departureDateTime)) }}</span>
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
                            <span class="order-fromDate">{{ date('d.m.Y', strtotime($return->departureDateTime)) }}</span>
                        </span>
                    </div>
                </div>
                <div class="fl-info-arr">
                    <h4>
                        <!-- <span class="order-toCity">Ош</span> -->
                        <span class="order-toAirport">({{ $return->arrivalAirport }})</span>
                    </h4>
                    <div class="fl-date-time">
                            <span>
                                <span class="order-toTime">{{ date('H:i', strtotime($return->arrivalDateTime)) }}</span>
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
                                <span class="order-toDate">{{ date('d.m.Y', strtotime($return->arrivalDateTime)) }}</span>
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

        @endif

        <footer class="">

            <div class="clearfix">
                <span>
                    Итого:
                </span>
                <span id="order_total_sum" class="order_total_sum">
                    {{ $order_total_sum_post }} сом
                </span>
            </div>
        </footer>

    </aside>
    
    </main>
</div>
@stop