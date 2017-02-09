<div class="hero">
    <div class="search-flight absolute">
        <h1>Поиск авиабилетов</h1>
        <ul class="flight-type clearfix">
            <li class="current one-way">
                <a href="#">
                    В одну сторону
                </a>
            </li>
            <li class="round-trip">
                <a href="#">
                    Туда и обратно
                </a>
            </li>
        </ul>
        {!! Form::open(array('route' => 'front.search', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
            <fieldset>
                <legend>Маршрут</legend>
                <div class="row">
                    <div class="grid grid-45">
                        <div class="form-group">
                            <label for="fromAddress">Откуда</label>
                            <select class="form-control selectpicker" name="departure" id="fromAddress" data-live-search="true" data-width="100%">
                    <?php foreach($airport_loc as $key=>$value) { ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                    <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-10">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <span id="swap">
                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                 viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                            <g>
                                <path d="M60.5,28.6H0.3L24,4.9c1.4-1.4,3.6-1.4,5,0c1.4,1.4,1.4,3.6,0,5L17.2,21.6h43.3c1.9,0,3.5,1.6,3.5,3.5S62.4,28.6,60.5,28.6
                                    z"/>
                                <path d="M37.5,60.2c-0.9,0-1.8-0.3-2.5-1c-1.4-1.4-1.4-3.6,0-5l11.8-11.8H3.5c-1.9,0-3.5-1.6-3.5-3.5s1.6-3.5,3.5-3.5h60.2L40,59.1
                                    C39.3,59.8,38.4,60.2,37.5,60.2z"/>
                            </g>
                            </svg>
                        </span>
                        </div>
                    </div>
                    <div class="grid grid-45">
                        <div class="form-group">
                            <label for="toAddress">Куда</label>
                            <select class="form-control selectpicker" name="destination" id="toAddress" data-live-search="true" data-width="100%">
                        <?php foreach($airport_loc as $key=>$value) { ?>
                            <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                        <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="row">
                <fieldset class="info-dates grid grid-45">
                    <legend>Даты перелета</legend>
                    <div class="row">
                        <div class="grid col-md-6">
                            <div class="form-group">
                                <label for="departure_date">Дата вылета</label>
                                <div class="input-group" id="datetimepickerdate1">
                                    <input id="departure_date" name="departure_date" type="text" class="form-control"/>
                                    <span class="input-group-addon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                         viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                                    <g>
                                        <path d="M55.1,8.5h-8.5V2.2c0-1.2-1-2.2-2.2-2.2s-2.2,1-2.2,2.2v6.3H21.8V2.2c0-1.2-1-2.2-2.2-2.2c-1.2,0-2.2,1-2.2,2.2v6.3H8.9
                                            c-4.5,0-8.3,3.7-8.3,8.3v39c0,4.5,3.7,8.3,8.3,8.3h46.3c4.5,0,8.3-3.7,8.3-8.3v-39C63.4,12.2,59.7,8.5,55.1,8.5z M8.9,12.9h8.5v3
                                            c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2v-3h20.4v3c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2v-3h8.5c2.1,0,3.9,1.7,3.9,3.9v7.4H5v-7.4
                                            C5,14.6,6.7,12.9,8.9,12.9z M55.1,59.6H8.9c-2.1,0-3.9-1.7-3.9-3.9V28.6h54v27.1C59,57.9,57.3,59.6,55.1,59.6z"/>
                                        <path d="M17.5,31.8c-4.2,0-7.7,3.5-7.7,7.7s3.5,7.7,7.7,7.7s7.7-3.3,7.7-7.6S21.8,31.8,17.5,31.8z M17.5,42.8
                                            c-1.8,0-3.3-1.5-3.3-3.3c0-1.8,1.5-3.3,3.3-3.3c1.7,0,3.3,1.5,3.3,3.3C20.8,41.3,19.3,42.8,17.5,42.8z"/>
                                        <path d="M20.8,50.4h-6.6c-1.2,0-2.2,1-2.2,2.2c0,1.2,1,2.2,2.2,2.2h6.6c1.2,0,2.2-1,2.2-2.2C23,51.4,22,50.4,20.8,50.4z"/>
                                        <path d="M36.4,50.4h-6.6c-1.2,0-2.2,1-2.2,2.2c0,1.2,1,2.2,2.2,2.2h6.6c1.2,0,2.2-1,2.2-2.2C38.6,51.4,37.6,50.4,36.4,50.4z"/>
                                        <path d="M36.4,37.3h-6.6c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2h6.6c1.2,0,2.2-1,2.2-2.2S37.6,37.3,36.4,37.3z"/>
                                        <path d="M52,50.4h-6.6c-1.2,0-2.2,1-2.2,2.2c0,1.2,1,2.2,2.2,2.2H52c1.2,0,2.2-1,2.2-2.2C54.2,51.4,53.2,50.4,52,50.4z"/>
                                        <path d="M52,37.3h-6.6c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2H52c1.2,0,2.2-1,2.2-2.2S53.2,37.3,52,37.3z"/>
                                    </g>
                                    </svg>
                                </span>
                                </div>
                            </div>
                        </div>
                        <div class="grid col-md-6">

                            <div class="form-group">
                                <label for="return_date">Дата прибытия</label>
                                <div class="input-group disabled" id="datetimepickerdate2">
                                    <input id="return_date" name="return_date" type="text" class="form-control"/>
                                    <span class="input-group-addon">
                                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                             viewBox="0 0 64 64" style="enable-background:new 0 0 64 64;" xml:space="preserve">
                                        <g>
                                            <path d="M55.1,8.5h-8.5V2.2c0-1.2-1-2.2-2.2-2.2s-2.2,1-2.2,2.2v6.3H21.8V2.2c0-1.2-1-2.2-2.2-2.2c-1.2,0-2.2,1-2.2,2.2v6.3H8.9
                                                c-4.5,0-8.3,3.7-8.3,8.3v39c0,4.5,3.7,8.3,8.3,8.3h46.3c4.5,0,8.3-3.7,8.3-8.3v-39C63.4,12.2,59.7,8.5,55.1,8.5z M8.9,12.9h8.5v3
                                                c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2v-3h20.4v3c0,1.2,1,2.2,2.2,2.2s2.2-1,2.2-2.2v-3h8.5c2.1,0,3.9,1.7,3.9,3.9v7.4H5v-7.4
                                                C5,14.6,6.7,12.9,8.9,12.9z M55.1,59.6H8.9c-2.1,0-3.9-1.7-3.9-3.9V28.6h54v27.1C59,57.9,57.3,59.6,55.1,59.6z"/>
                                            <path d="M17.5,31.8c-4.2,0-7.7,3.5-7.7,7.7s3.5,7.7,7.7,7.7s7.7-3.3,7.7-7.6S21.8,31.8,17.5,31.8z M17.5,42.8
                                                c-1.8,0-3.3-1.5-3.3-3.3c0-1.8,1.5-3.3,3.3-3.3c1.7,0,3.3,1.5,3.3,3.3C20.8,41.3,19.3,42.8,17.5,42.8z"/>
                                            <path d="M20.8,50.4h-6.6c-1.2,0-2.2,1-2.2,2.2c0,1.2,1,2.2,2.2,2.2h6.6c1.2,0,2.2-1,2.2-2.2C23,51.4,22,50.4,20.8,50.4z"/>
                                            <path d="M36.4,50.4h-6.6c-1.2,0-2.2,1-2.2,2.2c0,1.2,1,2.2,2.2,2.2h6.6c1.2,0,2.2-1,2.2-2.2C38.6,51.4,37.6,50.4,36.4,50.4z"/>
                                            <path d="M36.4,37.3h-6.6c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2h6.6c1.2,0,2.2-1,2.2-2.2S37.6,37.3,36.4,37.3z"/>
                                            <path d="M52,50.4h-6.6c-1.2,0-2.2,1-2.2,2.2c0,1.2,1,2.2,2.2,2.2H52c1.2,0,2.2-1,2.2-2.2C54.2,51.4,53.2,50.4,52,50.4z"/>
                                            <path d="M52,37.3h-6.6c-1.2,0-2.2,1-2.2,2.2s1,2.2,2.2,2.2H52c1.2,0,2.2-1,2.2-2.2S53.2,37.3,52,37.3z"/>
                                        </g>
                                    </svg>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </fieldset>

                <fieldset class="grid grid-45">
                    <legend>Информация о пассажирах</legend>
                    <div class="row">
                        <div class="grid col-md-4">
                            <div class="form-group">
                                <label for="to">Взрослые</label>
                                <select class="form-control selectpicker" name="adult_count" id="to" data-width="100%">
                                    <option value="0">0</option>
                                    <option value="1" selected>1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid col-md-4">
                            <div class="form-group">
                                <label for="to">Дети</label>
                                <select class="form-control selectpicker" name="child_count" id="to" data-width="100%">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="grid col-md-4">
                            <div class="form-group">
                                <label for="to">Младенцы</label>
                                <select class="form-control selectpicker" name="infant_count" id="to" data-width="100%">
                                    <option value="0">0</option>
                                    <option value="1">1</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </fieldset>
            </div>


            <div class="text-right">
                <button id="submitBtn" type="submit" class="btn btn-default">
                    Найти
                </button>
            </div>
        {!! Form::close() !!}
    </div>

</div><!-- end of hero -->