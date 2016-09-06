@extends('Admin::layouts.default')
@section('title', "Город")

@section('styles')
    <meta name="_token" content="{!! csrf_token() !!}"/>
@stop

@section('content')

    @include('Admin::city.nav')

    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Новый город</h4>
                        </div>
                        <div class="content">
                            {!! Form::model($city, ['route' => 'admin.city.store']) !!}
                                @include('Admin::city.form', [$city])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/admin/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/transition.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/collapse.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/ru.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/admin/bootstrap-datetimepicker.js') }}"></script>
    
@stop