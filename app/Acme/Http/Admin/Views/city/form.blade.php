<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Название на русском</label>
            {!! Form::text('name', null, ["class" => "form-control", "required" => true, "placeholder" => "Название на русском"]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Название на английском</label>
            {!! Form::text('nameEn', null, ["class" => "form-control", "placeholder" => "Название на английском"]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Код страны</label>
            {!! Form::text('country_code', null, ["class" => "form-control", "required" => true, "placeholder" => "Код страны"]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Код города</label>
            {!! Form::text('city_code', null, ["class" => "form-control", "placeholder" => "Код города"]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Код Аэропорта</label>
            {!! Form::text('airport_code', null, ["class" => "form-control", "placeholder" => "Код Аэропорта"]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Название Аэропорта</label>
            {!! Form::text('airport_name', null, ["class" => "form-control", "placeholder" => "Название на Аэропорта"]) !!}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label for="name">Название Аэропорта (EN)</label>
            {!! Form::text('airport_nameEn', null, ["class" => "form-control", "placeholder" => "Название на Аэропорта (EN)"]) !!}
        </div>
    </div>
</div>

<div class="action">
    <button type="submit" class="btn btn-primary">Сохранить</button>
    <button onclick="history.go(-1);" class="btn btn-default">Назад</button>
</div>