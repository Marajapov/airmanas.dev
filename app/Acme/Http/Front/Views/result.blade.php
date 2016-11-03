@include('Front::partials.main_header')
@include('Front::partials.header')
    <!-- main-content -->
    <div class="main-content container no-padding">
    <!-- breadcrumbs -->
    <ol class="breadcrumb breadcrumb3 clearfix">
        <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><a href="#">Издѳѳ</a><i></i></li>
        <li class="active col-lg-3 col-md-3 col-sm-3 col-xs-3">Рейстер<i></i></li>
        <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><a href="#">Жүргүнчү</a><i></i></li>
        <li class="col-lg-3 col-md-3 col-sm-3 col-xs-3"><a href="#">Далилдөө</a></li>
    </ol>
        <!-- ticket-info -->
        <div class="ticket-info col-lg-9">
            <!-- fromTable -->
            <div class="fromTable col-lg-12 no-padding">
                <!-- breadcrumbs -->
                <ol class="breadcrumb breadcrumb2">
                    <li class="dir_name">Учуу</li>
                    <li><span>{{ $departure }}</span><i class="fa fa-plane"></i><span>{{ $destination }}</span></li>
                </ol> <!-- end breadcrumbs -->
                <!-- steps -->
                <div id="steps" class="steps no-padding">
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

                                {{--*/ $day_str = $fly_days[$i][0]->departure_date() /*--}}
                                
                                @if ($day_str)
                                    {{--*/  $day = strtotime($day_str) /*--}}
                                    <li role="presentation" @if ($dept_d==$day ) class="selected" @endif>
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
                    </ul>
                </div> <!-- steps end  // // -->

                <!-- tab-contents -->
                <div class="tabcontents">
                    {{--*/ $view = 1 /*--}}
                    
                        @for($i=0; $i<count($fly_days); $i++)
                        @if($fly_days[$i])
                            
                            {{--*/ $day_str = $fly_days[$i][0]->departure_date() /*--}}
                            @if($day_str)
                                {{--*/ $day = strtotime($day_str) /*--}}
                    <div id="view{{ $view }}" class="tab-content tab-1 current clearfix">
                        <table class="table table-bordered col-lg-12 no-padding">
                            <tr class="first-row active">
                                <td class="col-lg-2 text-uppercase">№ рейстин номуру</td>
                                <td class="col-lg-3 text-uppercase">Учуу</td>
                                <td class="col-lg-3 text-uppercase">Келүү</td>
                                <td class="col-lg-3 text-uppercase">Баасы</td>
                                <td class="col-lg-1 text-uppercase">Тандоо</td>
                            </tr>
                            {{--*/ $jcounter=0 /*--}}
                            @for($j=0; $j<count($fly_days[$i]); $j++)
                                
                                    {{--*/ $ddt_str = $fly_days[$i][$j]->departureDateTime /*--}}
                                    {{--*/ $adt_str = $fly_days[$i][$j]->arrivalDateTime /*--}}
                                    {{--*/ $ddt = strtotime($ddt_str) /*--}}
                                    {{--*/ $adt = strtotime($adt_str) /*--}}
                            
                            <tr class="" data-price="{{ $fly_days[$i][$j]->adultPriceSom }}" data-child-price="{{ $fly_days[$i][$j]->childPriceSom }}" data-infant-price="{{ $fly_days[$i][$j]->infPriceSom }}" data-number="{{ $fly_days[$i][$j]->flightNumber}}" data-from-date="{{ date('d.m.Y', $ddt) }}" data-from-time="{{ date('H:i', $ddt) }}" data-from-city="{{ $airport_loc[$fly_days[$i][$j]->departureAirport] }}" data-from-airport="{{ $fly_days[$i][$j]->departureAirport }}" data-to-date="{{ date('d.m.Y', $adt) }}" data-to-time="{{ date('H:i', $adt) }}" data-to-city="{{ $airport_loc[$fly_days[$i][$j]->arrivalAirport] }}" data-to-airport="{{ $fly_days[$i][$j]->arrivalAirport }}" data-timestamp="{{ $fly_days[$i][$j]->timestamp }}">
                                <td>{{ $fly_days[$i][$j]->flightNumber }}</td>
                                <td class="timef">{{ date('H:i', $ddt) }}</span></td>
                                <td class="timet">{{ date('H:i', $adt) }}</span></td>
                                <td class="tprice">{{ $fly_days[$i][$j]->adultPriceSom }}</td>
                                <td>
                                    <input name="radio_fl_out" type="radio"/>
                                </td>
                            </tr>
                            {{--*/ $jcounter++ /*--}} 
                            @endfor
                            @if ($jcounter==0) 
                            <tr class="" data-price="0" data-number="0" data-from-date="01.01.2011" data-from-time="16:45" data-from-city="BB" data-from-airport="AA" data-to-date="01.01.2011" data-to-time="17:25" data-to-city="oo" data-to-airport="oo">
                                <td colspan="5">Бош орун жок</td>
                                
                            </tr>
                            @endif
                        </table>
                    </div>
                    
                    {{--*/ $view++ /*--}}
                        @endif

                        @else
                        @endif

                        @endfor
                    
                </div> <!-- tab-contents end -->


            </div> <!-- fromTable end -->
   <!-- start 0 -->
            <!-- toTable -->
            <div class="toTable col-lg-12 no-padding">
            
            @if(count($fly_days_return) > 0)
            <!-- breadcrumbs -->
            <ol class="breadcrumb breadcrumb2">
                <li class="dir_name">Кайтуу</li>
                <li class="fl-dir"><span>{{ $destination }}</span><i class="fa fa-plane"></i><span>{{ $departure }}</span></li>
            </ol> <!-- end breadcrumbs -->
                <!-- steps -->
                <div id="steps" class="steps">
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
                                {{--*/ $day_str = $fly_days_return[$i][0]->departure_date() /*--}}
                                @if ($day_str)
                                    {{--*/ $day = strtotime($day_str) /*--}}
                        
                        <li role="presentation"@if($retn_d==$day ) class="selected" @endif>
                            <a href="#viewt{{ $view }}">
                                <span class="tday hidden-xs">{{ date('d', $day) }}</span>
                                <span class="tday hidden-lg hidden-md hidden-sm">12</span>
                                <span class="tmonth-tweek">
                                    <span class="tmonth hidden-xs">{{ date('F', $day) }}</span><span class="tweek"> 
                                    {{ date('D', $day) }}</span>
                                    <span style="color:red; font-size:10px">@if ($least_price>0) {{ $least_price }} сом @else no flight @endif</span>
                                </span>
                                <div class="clear"></div>
                            </a>
                        </li>
                        
                        
                    {{--*/  $view++ /*--}}
                        @endif

                        @endif
                        
                        @endfor
                    </ul>
                </div> <!-- steps end -->
               


<!-- start -->
                <!-- tabcontents -->
                <div class="tabcontents">
                        {{--*/  $view = 1 /*--}}
                            @for($i=0; $i<count($fly_days_return); $i++)
                                
                                @if($fly_days_return[$i])
                                
                                {{--*/ $day_str = $fly_days_return[$i][0]->departure_date() /*--}}
                                @if($day_str) 
                                    {{--*/ $day = strtotime($day_str) /*--}}
                          
                    <div id="viewt{{ $view }}" class="tab-content tab-1 current clearfix">
                        <table class="table table-bordered col-lg-12 no-padding">
                            <tr class="first-row active">
                                <td class="col-lg-2 text-uppercase">№ рейстин номуру</td>
                                <td class="col-lg-3 text-uppercase">Учуу</td>
                                <td class="col-lg-3 text-uppercase">Келүү</td>
                                <!--                        <td class="col-lg-3">Информация о рейсе</td>-->
                                <td class="col-lg-3 text-uppercase">Баасы</td>
                                <td class="col-lg-1 text-uppercase">Тандоо</td>

                            </tr>
                            
                            {{--*/ $jcounter=0 /*--}}
                            @for($j=0; $j<count($fly_days_return[$i]); $j++)
                                @if($fly_days_return[$i][$j]->adultPrice==0) continue @endif
                                
                                    {{--*/ $ddt_str = $fly_days_return[$i][$j]->departureDateTime /*--}}
                                    {{--*/ $adt_str = $fly_days_return[$i][$j]->arrivalDateTime /*---}}
                                    {{--*/ $ddt = strtotime($ddt_str) /*--}} 
                                    {{--*/ $adt = strtotime($adt_str) /*--}} 
                            <tr class="" data-price="{{ $fly_days_return[$i][$j]->adultPriceSom }}" data-child-price="{{ $fly_days_return[$i][$j]->childPriceSom }}" data-infant-price="{{ $fly_days_return[$i][$j]->infPriceSom }}" data-number="{{ $fly_days_return[$i][$j]->flightNumber}}" data-from-date="{{ date('d.m.Y', $ddt) }}" data-from-time="{{ date('H:i', $ddt)}}" data-from-city="{{ $airport_loc[$fly_days_return[$i][$j]->departureAirport] }}" data-from-airport="{{ $fly_days_return[$i][$j]->departureAirport }}" data-to-date="{{ date('d.m.Y', $adt) }}" data-to-time="{{ date('H:i', $adt)}}" data-to-city="{{ $airport_loc[$fly_days_return[$i][$j]->arrivalAirport] }}" data-to-airport="{{ $fly_days_return[$i][$j]->arrivalAirport }}" data-timestamp="{{ $fly_days_return[$i][$j]->timestamp }}">
                                <td>{{ $fly_days_return[$i][$j]->flightNumber }}</td>
                                <td class="timef">{{ date('H:i', $ddt) }}</span></td>
                                <td class="timet">{{ date('H:i', $adt) }}</span></td>
                                <td class="tprice">{{ $fly_days_return[$i][$j]->adultPriceSom }}</td>
                                <td>
                                    <input name="radio_fl_in" type="radio"/>
                                </td>
                            </tr>

                            {{--*/ $jcounter++ /*--}}
                            @endfor 
                            @if($jcounter==0)
                            <tr class="" data-price="0" data-number="0" data-from-date="01.01.2011" data-from-time="16:45" data-from-city="BB" data-from-airport="AA" data-to-date="01.01.2011" data-to-time="17:25" data-to-city="oo" data-to-airport="oo">
                                <td colspan="5">Бош орун жок</td>
                            </tr>
                            @endif
                        </table>
                    </div>

                   {{--*/ $view++ /*--}}
                        @endif

                        @endif

                        @endfor
                </div> <!-- tabcontents end -->

            @endif
            </div> <!-- toTable end -->
        </div> <!-- ticket-info -->
        
<!-- end -->

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



    </div>


</div>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.js') }}"></script>
<!--        <script src="js/bootstrap-datepicker.js"></script>-->
<script src="{{ asset('assets/dist/js/standalone/selectize.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/moment.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/ru.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/transition.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/collapse.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/bootstrap-datetimepicker.min.js') }}"></script>

<script type="text/javascript">

    //            $('select').selectize();

</script>

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

    $(function () {
        
        
        $('#swap').click(function() {
            var tmp = document.getElementById('fromAddress').value;
            document.getElementById('fromAddress').value = document.getElementById('toAddress').value;
            document.getElementById('toAddress').value = tmp;
        });

        $('#checkDir').click(function(){
            $(this).toggleClass('checked');
            $('#secondDate').toggleClass('visible');
        });

        $('#datetimepickerdate1').datetimepicker({
            language: 'ru',
            minDate: moment(),
            pickTime: false
        });
        $('#datetimepickerdate2').datetimepicker({
            language: 'ru',
            pickTime: false
        });
        $("#datetimepickerdate1").on("dp.change",function (e) {
            $('#datetimepickerdate2').data("DateTimePicker").setMinDate(e.date);
        });
        $("#datetimepickerdate2").on("dp.change",function (e) {
            $('#datetimepickerdate1').data("DateTimePicker").setMaxDate(e.date);
        });


    });
</script>
<!-- start -->

<script type="text/javascript">

        $('input:radio[name="radio_fl_out"]').change(
            function(){
                if ($(this).is(':checked')) {
                    $('input:radio[name="radio_fl_out"]').removeClass('selected');
                    $('input:radio[name="radio_fl_out"]').parent().parent().removeClass('info');
                    $(this).addClass('selected');
                    var parentTr = $(this).parent().parent();
                    parentTr.addClass('info');
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

                    $('.order-info').css('display', 'block');

                    $('.fl_out_header').css('display', 'table-row').addClass('cont_btn');
                    $('.fl_out_num_price').css('display', 'table-row');
                    $('.fl_out_dirs').css('display', 'table-row');
                    
                    $('.fl_out_num_price .order-number-num').html(flNumber);
                    $('.fl_out_num_price .order-fl-price').html(flPrice);
                    $('.fl_out_dirs .order-fromCity').html(flFromCity);
                    $('.fl_out_dirs .order-fromAirport').html(flFromAirport);
                    $('.fl_out_dirs .order-fromDate').html(flFromDate);
                    $('.fl_out_dirs .order-fromTime').html(flFromTime);
                    $('.fl_out_dirs .order-toCity').html(flToCity);
                    $('.fl_out_dirs .order-toAirport').html(flToAirport);
                    $('.fl_out_dirs .order-toDate').html(flToDate);
                    $('.fl_out_dirs .order-toTime').html(flToTime);
                    @if (count($fly_days_return) == 0) $('.continue-btn').removeClass('hidden'); @endif
                    calculate_flight_fee(1, flPrice, flPrice_child, flPrice_infant);
                }
            }
        );

        $('input:radio[name="radio_fl_in"]').change(
            function(){
                if ($(this).is(':checked')) {
                    $('input:radio[name="radio_fl_in"]').removeClass('selected');
                    $('input:radio[name="radio_fl_in"]').parent().parent().removeClass('info');
                    $(this).addClass('selected');
                    var parentTr = $(this).parent().parent();
                    parentTr.addClass('info');

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

                    $('.order-info').css('display', 'block');

                    $('.fl_in_header').css('display', 'table-row').addClass('cont_btn');
                    $('.fl_in_num_price').css('display', 'table-row');
                    $('.fl_in_dirs').css('display', 'table-row');

                    $('.fl_in_num_price .order-number-num').html(flNumber);
                    $('.fl_in_num_price .order-fl-price').html(flPrice);
                    $('.fl_in_dirs .order-fromCity').html(flFromCity);
                    $('.fl_in_dirs .order-fromAirport').html(flFromAirport);
                    $('.fl_in_dirs .order-fromDate').html(flFromDate);
                    $('.fl_in_dirs .order-fromTime').html(flFromTime);
                    $('.fl_in_dirs .order-toCity').html(flToCity);
                    $('.fl_in_dirs .order-toAirport').html(flToAirport);
                    $('.fl_in_dirs .order-toDate').html(flToDate);
                    $('.fl_in_dirs .order-toTime').html(flToTime);
                    calculate_flight_fee(2, flPrice, flPrice_child, flPrice_infant);
                }
            });

        $(document).change(function(){
            @if(count($fly_days_return) > 0)
            if(($('.fl_in_header').hasClass('cont_btn')) && ($('.fl_out_header').hasClass('cont_btn'))){
                $('.continue-btn').removeClass('hidden');
            }
            @else
            if($('.fl_in_header').hasClass('cont_btn')){
                $('.continue-btn').removeClass('hidden');
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
            
        }
</script>


</body>

</html>