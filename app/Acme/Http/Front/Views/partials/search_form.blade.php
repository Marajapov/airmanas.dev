<div class="search-wrapper col-lg-4 col-md-4">
    <div class="search-inner col-lg-12 col-md-12">
        <h4 class="">Авиарейсти издѳѳ</h4>
        
        {!! Form::open(array('route' => 'front.search', 'method' => 'post', 'enctype' => 'multipart/form-data', 'class'=> 'main-search', 'id'=> 'mainForm', 'name'=>'theForm')) !!}
            <div class="form-group cityFrom">
                <label for="">Каяктан?</label>
                <select id="fromAddress" name="departure" class="form-control" placeholder="Шаарды тандаңыз...">
            <?php foreach($airport_loc as $key=>$value) { ?>
                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
            <?php } ?>

                </select>
            </div>
            <div class="form-group swapbtn">
                <label style="visibility: hidden" for="">алмаштыруу</label>
                <a id="swap" class="btn btn-default col-lg-12" role="button"><i class="fa fa-exchange"></i></a>
            </div>
            <div class="form-group cityTo">
                <label for="">Каякка?</label>
                <select id="toAddress" name="destination" class="form-control" placeholder="Шаарды тандаңыз...">
                    <?php foreach($airport_loc as $key=>$value) { ?>
                        <option value="<?php echo $key; ?>"<?php if ($key=="OSS") echo " selected"; ?>><?php echo $value; ?></option>
            <?php } ?>
                </select>
            </div>
            <div class="clear"></div>

            <div class="form-group">
                <div class="checkbox">
                    <label>
                        <input id="checkDir" type="checkbox">
                        барып кайра келүү
                    </label>
                </div>
            </div>

            <div class="clear"></div>


            <div id="firstDate" class="form-group dateFrom">
                <label for="exampleInputFile">Учуунун күнү</label>
                <div class='input-group date1' id='datetimepickerdate1'>
                    <input id="departure_date" name="departure_date" type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                </div>
            </div>
            <div id="secondDate" class="form-group dateTo">
                <label for="exampleInputFile">Келүүнүн күнү</label>
                <div class='input-group date2' id='datetimepickerdate2'>
                    <input id="return_date" name="return_date" type='text' class="form-control" />
                                        <span class="input-group-addon">
                                            <span class="glyphicon glyphicon-calendar"></span>
                                        </span>
                </div>
            </div>
            <div class="clear"></div>

            <div class="form-group personType personAdult">
                <label for="">Улуулар</label>
                <select class="form-control" name="adult_count" id="adult_count">
          <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
          <option value="5">5</option>
          <option value="6">6</option>
                </select>
            </div>
            <div class="form-group personType personChild">
                <label for="">Кичүүлѳр(2-12)</label>
                <select class="form-control" name="child_count" id="child_count">
                    <option value="0">0</option>
          <option value="1">1</option>
          <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="form-group personType personBaby">
                <label for="">Наристелер (0-2)</label>
                <select class="form-control" name="infant_count" id="infant_count">
                    <option value="0">0</option>
                    <option value="1">1</option>
                </select>
            </div>
            <div class="clear"></div>

            <button type="submit" id="search_submit" name="search_submit" class="pull-right btn btn-danger searchbtn col-lg-12 col-md-12 col-md-pull-0 col-sm-6 col-sm-pull-3 col-xs-12">Издѳѳ</button>
            <div class="clear"></div>
        {!! Form::close() !!}

    </div>


</div>