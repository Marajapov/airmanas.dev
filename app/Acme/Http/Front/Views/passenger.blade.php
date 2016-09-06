@include('Front::partials.main_header')
@include('Front::partials.header')


            </div>

<div class="main-content container no-padding">

    <!-- flight-info -->
    <div class="flight-info clearfix">
        <h5 class="text-center">Информация о пассажирах</h5>
        <table class="table table-bordered col-lg-12 no-padding">
            <tbody>
                <tr class="active first-row hidden-xs">
                    <td>Маршрут</td>
                    <td>Номер рейса</td>
                    <td>Дата вылета</td>
                    <td>Время вылета</td>
                    <td>Дата прибытия</td>
                    <td>Время прибытия</td>
                </tr>
                <tr class="hidden-xs">
                    <td>{{ $departure->departureAirport }}<i class="fa fa-plane"></i>{{ $departure->arrivalAirport}}</td>
                    <td>{{ $departure->flightNumber }}</td>
                    <td>{{ date('d.m.Y', strtotime($departure->departureDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($departure->departureDateTime)) }}</td>
                    <td>{{ date('d.m.Y', strtotime($departure->arrivalDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($departure->arrivalDateTime)) }}</td>
                </tr>
				@if ($return)
                <tr class="hidden-xs">
                    <td>{{ $return->departureAirport }}<i class="fa fa-plane"></i>{{ $return->arrivalAirport }}</td>
                    <td>{{ $return->flightNumber}}</td>
                    <td>{{ date('d.m.Y', strtotime($return->departureDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($return->departureDateTime)) }}</td>
                    <td>{{ date('d.m.Y', strtotime($return->arrivalDateTime)) }}</td>
                    <td>{{ date('H:i', strtotime($return->arrivalDateTime)) }}</td>
                </tr>
				@endif
            </tbody>
        </table>
    </div> <!-- end flight-info -->

    <div id="formAlert" class="alert alert-danger alert-hidden" role="alert">
        <button type="button" class="close">
            <span aria-hidden="true">&times;</span>
        </button>
        <strong>Заполните все поля!</strong>
    </div>

    <!-- USER INFO FORM-->
    {!! Form::open(array('route' => 'front.flight_preview', 'method' => 'post','name'=>'userInfoForm','id'=>'userInfoForm')) !!}

        <!-- USER INFO TABLE-->
        <div id="user-info" class="user-info clearfix">

            <h5 class="text-center">Информация о пассажирах</h5>

            <div class="clearfix">

                @for($i=0; $i < $adult_count; $i++)

                    <table class="table table-striped table-bordered col-lg-12 no-padding">
                        <tbody>
                        <tr class="info">
                            <td colspan="4">
                                <h4>
                                    {{--*/ $i+1 /*--}} - взрослый
                                </h4>
                            </td>
                        </tr>
                        <tr class="contact_row">
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="" for="sex{{ $counter }}">Пол</label>
                                    <select id="sex{{ $counter }}" name="sex{{ $counter }}" class="form-control required">
                                        <option selected disabled>пол</option>
                                        <option value="M" selected="">мужской</option>
                                        <option value="F">женский</option>
                                    </select>
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="name{{ $counter }}">Имя</label>
                                    <input type="text" class="form-control" id="name{{ $counter }}" name="name{{ $counter}}" required="required">
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="" for="surname{{ $counter}}">Фамилия</label>
                                    <input type="text" class="form-control" id="surname{{ $counter }}" name="surname{{ $counter }}" required="required">
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="    date-birth clearfix">
                                    <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12" for="bd_day{{ $counter }}">Дата рождения</label>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personAdult">
                                        <select class="form-control" id="bd_day{{ $counter }}" name="bd_day{{ $counter }}" required="">
                                            <option selected disabled>день</option>
                                            @for($k=1;$k<32;$k++)
                                                <option value="{{ $k }}">{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    {{--*/ $options = makeSelectOptionMonths() /*--}}

                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personChild">
                                        <select class="form-control" id="bd_month{{ $counter }}" name="bd_month{{ $counter }}" required="">
                                            <option selected disabled>месяц</option>
                                            <?php echo $options; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personBaby">
                                        <select class="form-control" id="bd_year{{ $counter }}" name="bd_year{{ $counter }}" required="">
                                            <option selected disabled>год</option>
                                            @for($k=$this_year;$k>1900;$k--)
                                                <option value="{{ $k}}">{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                {{--*/ $counter++ /*--}}
                @endfor


                @for($i=0; $i < $child_count; $i++)

                    <table class="table table-striped table-bordered col-lg-12 no-padding">
                        <tbody>
                        <tr class="warning">
                            <td colspan="4">
                                <h4>
                                    {{ $i+1 }}- ребенок
                                </h4>
                            </td>
                        </tr>
                        <tr class="contact_row">
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="" for="sex{{ $counter }}">Пол</label>
                                    <select id="sex{{ $counter }}" name="sex{{ $counter }}" class="form-control required" required="required">
                                        <option selected disabled>пол</option>
                                        <option value="M">мужской</option>
                                        <option value="F">женский</option>
                                    </select>
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="name{{ $counter }}">Имя</label>
                                    <input type="text" class="form-control" id="name{{ $counter }}" name="name{{ $counter }}" required="required">
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="" for="surname{{ $counter }}">Фамилия</label>
                                    <input type="text" class="form-control" id="surname{{ $counter }}" name="surname{{ $counter }}" required="required">
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="    date-birth clearfix">
                                    <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12" for="bd_day{{ $counter }}">Дата рождения</label>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personAdult">
                                        <select class="form-control" id="bd_day{{ $counter }}" name="bd_day{{ $counter }}" required="required">
                                            <option selected disabled>день</option>
                                            @for($k=1;$k<32;$k++)
                                                <option value="{{ $k }}">{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personChild">
                                        <select class="form-control" id="bd_month{{ $counter }}" name="bd_month{{ $counter }}" required="required">
                                            <option selected disabled>месяц</option>
                                            <?php echo $options; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personBaby">
                                        <select class="form-control" id="bd_year{{ $counter }}" name="bd_year{{ $counter }}" required="required">
                                            <option selected disabled>год</option>
                                            @for($k=$this_year;$k>1900;$k--) { ?>
                                                <option value="{{ $k }}">{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                {{--*/ $counter++ /*--}}
                @endfor


                @for($i=0; $i < $infant_count; $i++)

                    <table class="table table-striped table-bordered col-lg-12 no-padding">
                        <tbody>
                        <tr class="danger">
                            <td colspan="4">
                                <h4>
                                    {{ $i+1 }} - младенец
                                </h4>
                            </td>
                        </tr>
                        <tr class="contact_row">
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="" for="sex{{ $counter }}">Пол</label>
                                    <select id="sex{{ $counter }}" name="sex{{ $counter }}" class="form-control" required="required">
                                        <option selected disabled>пол</option>
                                        <option value="M" selected="">мужской</option>
                                        <option value="F">женский</option>
                                    </select>
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label for="name{{ $counter }}">Имя</label>
                                    <input type="text" class="form-control" id="name{{ $counter }}" name="name{{ $counter }}" required="required">
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="form-group">
                                    <label class="" for="surname{{ $counter }}">Фамилия</label>
                                    <input type="text" class="form-control" id="surname{{ $counter }}" name="surname{{ $counter }}" required="required">
                                </div>
                            </td>
                            <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                <div class="    date-birth clearfix">
                                    <label class="col-lg-12 col-md-12 col-sm-12 col-xs-12" for="bd_day{{ $counter }}">Дата рождения</label>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personAdult">
                                        <select class="form-control" id="bd_day{{ $counter }}" name="bd_day{{ $counter }}" required="required">
                                            <option selected disabled>день</option>
                                            @for($k=1;$k<32;$k++)
                                                <option value="{{ $k }}">{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personChild">
                                        <select class="form-control" id="bd_month{{ $counter }}" name="bd_month{{ $counter }}" required="required">
                                            <option selected disabled>месяц</option>
                                            <?php echo $options; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-4 personType personBaby">
                                        <select class="form-control" id="bd_year{{ $counter }}" name="bd_year{{ $counter }}" required="required">
                                            <option selected disabled>год</option>
                                            @for($k=$this_year;$k>1900;$k--)
                                                <option value="{{ $k}}">{{ $k }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                {{--*/ $counter++ /*--}}
                @endfor

            </div>


        </div>

        <div class="contact-info">
            <table class="table table-striped table-bordered col-lg-12 no-padding">
                <tbody>
                <tr class="success">
                    <td colspan="4">Контактная информация</td>
                </tr>
                <tr class="contact_row">
                    <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="name">Имя</label>
                            <input type="text" class="form-control" id="name" name="name" required="">
                        </div>
                    </td>
                    <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="surname">Фамилия</label>
                            <input type="text" class="form-control" id="surname" name="surname" required="">
                        </div>
                    </td>
                    <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="phone">Телефон</label>
                            <input type="text" class="form-control" id="phone" name="phone" required="">
                        </div>
                    </td>
                    <td class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <div class="form-group">
                            <label for="email">Эл. почта</label>
                            <input type="text" class="form-control" id="email" name="email" required="">
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <input type="hidden" name="total" value="{{ $total }}" />
        <input type="hidden" name="flight_1" id="flight_1" value="{{ $flight_1 }}" />
        <input type="hidden" name="flight_2" id="flight_2" value="{{ $flight_2 }}" />
        <input type="hidden" name="adult_count" id="adult_count" value="{{ $adult_count }}" />
        <input type="hidden" name="child_count" id="child_count" value="{{ $child_count }}" />
        <input type="hidden" name="infant_count" id="infant_count" value="{{ $infant_count }}" />

        <input name="submit" type="submit" class="continue-btn btn btn-danger col-lg-12 col-md-12 col-sm-12 col-xs-12">
{!! Form::close() !!}
	
</div>

@include('Front::partials.footer')