@extends('Admin::layouts.default')
@section('title', 'Добавить пользователя')

@section('styles')
    <meta name="_token" content="{!! csrf_token() !!}"/>
    <link rel="stylesheet" href="{{ asset('css/admin/build.css') }}"/>
@endsection

@section('content')

    <!-- include bottom nav -->
    @include('Admin::user.nav')
    <!-- end bottom nav -->

    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h4 class="title">Новый пользователь</h4>
                        </div>
                        <div class="content">
                            {!! Form::model($user, ['route' => 'admin.user.store']) !!}
                            @include('Admin::user.form', [$user])
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop