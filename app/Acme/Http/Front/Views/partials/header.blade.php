<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Air Manas</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datetimepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/build.css') }}">

    <meta name="_token" content="{!! csrf_token() !!}"/>

    @yield('head')
</head>
<body> 

<div class="header">
    <div class="top">
    </div>

    <div class="container">

        <nav>
            <div class="brand">
                <a href="{{ route('front.home') }}" id="clearSession">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo">
                </a>
            </div>

            <ul class="menu">
                <li>
                    <a href="{{ route('front.home') }}">Главная</a>
                </li>
                <li>
                    <a href="#">Как купить билет?</a>
                </li>
                <li>
                    <a href="#">О нас</a>
                </li>
                <li>
                    <a href="#">Контакты</a>
                </li>
                <!--<li class="search-form">-->
                    <!--<span id="searchToggle" class="transition">-->
                        <!--<i class="ico ico-search"></i>-->
                    <!--</span>-->
                    <!--<form id="searchForm" class="hidden transition">-->
                        <!--<input type="text" name="searchText">-->
                        <!--<span id="searchClose">-->
                            <!--<i class="ico ico-close"></i>-->
                        <!--</span>-->
                        <!--<button id="searchButton" type="submit" name="searchSubmit">-->
                            <!--<i class="ico ico-search"></i>-->
                        <!--</button>-->
                    <!--</form>-->
                <!--</li>-->
            </ul>
        </nav>
    </div>
</div>