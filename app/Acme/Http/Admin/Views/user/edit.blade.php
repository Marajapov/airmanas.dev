@extends('Admin::layouts.default')
@section('title', $user->getName())

@section('styles')
  <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}"/>
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
                            <h4 class="title">Редактировать</h4>
                        </div>
                        <div class="content">
				{!! Form::model($user, ['route' => ['admin.user.update', $user], 'method' => 'PUT', 'class'=>'form-horizontal']) !!}
				@include('Admin::user.form', $user)
				{!! Form::close() !!}
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop