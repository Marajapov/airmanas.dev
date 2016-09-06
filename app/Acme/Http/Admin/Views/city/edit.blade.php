@extends('Admin::layouts.default')
@section('title', "Редактирование")

@section('styles')
    <meta name="_token" content="{!! csrf_token() !!}"/>
@stop

@section('content')
    <!-- include subcategory nav -->
    @include('Admin::city.nav')
    <!-- end subcategory nav -->

    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Редактировать</h4>
                        </div>
                        <div class="content">
                            {!! Form::model($city, ['route' => ['admin.city.update', $city], 'method' => 'PUT']) !!}
                            @include('Admin::city.form', [$city])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection