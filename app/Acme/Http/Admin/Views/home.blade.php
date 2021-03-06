@extends('Admin::layouts.default')
@section('title', "Admin panel")

@section('content')

<nav class="navbar navbar-default navbar-fixed">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            {{--<ul class="nav navbar-nav navbar-left">--}}
            {{--<li>--}}
            {{--<a href="{{ route('admin.order.create') }}" class="btn btn-success btn-block">--}}
            {{--Добавить заказ--}}
            {{--<i class="pe-7s-note2"></i>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{ auth()->user()->getName() }}
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Личный кабинет</a></li>

                        <li class="divider"></li>
                        <li><a href="javascript:document.getElementById('logout-form').submit()">Выйти</a></li>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>

<div class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <div class="card ">
                    <div class="header">
                        <h4 class="title">Админ Панель</h4>
                    </div>
                    <div class="content">
                        <div class="table-full-width">
                            
                        </div>

                        <div class="footer">
                            <hr>
                            <div class="stats">
                                <i class="fa fa-history"></i> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection