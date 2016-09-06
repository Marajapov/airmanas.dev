@extends('Front::layouts.default')

@section('styles')
  <link rel="stylesheet" href="{{ asset('front/css/slick.css') }}"/>
@stop

@section('content')
  <section class="section-item">
    <div class="container">
      <div class="row">
        <ol class="breadcrumb">
          <li><a href="{{ route('front.home')}}">Главная</a></li>
          <li><a href="#">Квартиры</a></li>
          <li class="active">1-комнатная квартира на Ибраимова 63</li>
        </ol>
        <h2>
          <span>1-комнатная квартира на Ибраимова 63</span>
        </h2>

        <div class="pd-panel clearfix">

          <div class="photos col-md-5">

            <div class="slider-for">
              <div>
                <img src="{{ asset('front/images/items/shirt_1.jpg') }}" alt=""></div>
              <div>
                <img src="{{ asset('front/images/items/shirt_2.jpg') }}" alt=""></div>
              <div>
                <img src="{{ asset('front/images/items/shirt_3.jpg') }}" alt=""></div>
              <div>
                <img src="{{ asset('front/images/items/shirt_1.jpg') }}" alt=""></div>
              <div>
                <img src="{{ asset('front/images/items/shirt_2.jpg') }}" alt=""></div>
              <div>
                <img src="{{ asset('front/images/items/shirt_3.jpg') }}" alt=""></div>
            </div>

            <div class="slider-nav">
              <div class="transition">
                <img src="{{ asset('front/images/items/small/shirt_1.jpg') }}" alt=""></div>
              <div class="transition">
                <img src="{{ asset('front/images/items/small/shirt_2.jpg') }}" alt=""></div>
              <div class="transition">
                <img src="{{ asset('front/images/items/small/shirt_3.jpg') }}" alt=""></div>
              <div class="transition">
                <img src="{{ asset('front/images/items/small/shirt_1.jpg') }}" alt=""></div>
              <div class="transition">
                <img src="{{ asset('front/images/items/small/shirt_2.jpg') }}" alt=""></div>
              <div class="transition">
                <img src="{{ asset('front/images/items/small/shirt_3.jpg') }}" alt=""></div>
            </div>

          </div>

          <div class="flat-info col-md-7">
            <div class="flat-price">
              <div class="price-block">
                <span>час</span>
                <h4>300 сом</h4>
              </div>
              <div class="price-block">
                <span>ночь</span>
                <h4>800 сом</h4>
              </div>
              <div class="price-block">
                <span>сутки</span>
                <h4>1500 сом</h4>
              </div>
              <div class="price-block">
                <span>месяц</span>
                <h4>15000 сом</h4>
              </div>
            </div>

            <div class="info-block">
              <div class="address">
                <h4>Адрес</h4>
                <p>
                  Ибраимова, 63
                  <a href="#map">показать на карте</a>
                </p>
              </div>
              <div class="desc">
                <h4>Описание</h4>
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, eos odit provident ratione repudiandae sapiente unde. Accusantium cum dolorem earum inventore labore odio quia quidem soluta veritatis vero. Alias aliquam cupiditate dignissimos eaque itaque minus nesciunt nostrum obcaecati quo sequi.
                </p>
              </div>
              <div class="options">
                <h4>Условия</h4>
                <ul class="check-list">
                  <li class="active">Консьерж</li>
                  <li class="active">Домофон</li>
                  <li>Видеонаблюдение</li>
                  <li>Огороженная территория</li>
                  <li class="active">Чистый подъезд</li>
                  <li>Можно с животными</li>
                  <li class="active">Можно с детьми</li>
                  <li class="active">Изолированные комнаты</li>
                  <li class="active">Мебель</li>

                  <li>Раздельный санузел</li>

                  <li>Совмещенный санузел</li>

                  <li class="active">Более 1-го санузла</li>

                  <li>Кондиционер</li>

                  <li>Нагреватель воды</li>

                  <li>Посудомоечная машина</li>

                  <li class="active">Стиральная машина</li>

                  <li class="active">Холодильник</li>

                  <li class="active">Кухонная утварь</li>

                  <li class="active">ТВ</li>

                  <li class="active">Развитая инфраструктура</li>

                  <li class="active">Парковка</li>

                  <li>Подземный паркинг</li>

                </ul>
              </div>

              <div class="contacts">
                <h4>Контакты</h4>
                <p>
                  <span>+996 312 45-68-97</span>
                  <span>+996 312 45-68-97</span>
                  <span>+996 312 45-68-97</span>
                </p>
              </div>

            </div>

          </div>

        </div>

        <div id="map">
          <div id="map_canvas" style="width: 100%; height:460px;"></div>
          <input name="latitude" id="latitude" type="hidden">
          <input name="longitude" id="longitude" type="hidden">
          <input name="zoom" id="zoom" type="hidden">
        </div>

      </div>
    </div>
  </section>
@stop

@section('footer')

  <script type="text/javascript" src="{{ asset('front/js/jquery.touchSwipe.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front/js/jquery-migrate-1.2.1.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('front/js/slick.min.js') }}"></script>

  <script>
    $(document).ready(function(){
      $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        asNavFor: '.slider-nav',
        arrows: true,
        prevArrow: '<i class="pd-nav pd-left"></i>',
        nextArrow: '<i class="pd-nav pd-right"></i>'
      });

      $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        arrows: false,
        focusOnSelect: true
      });
    });
  </script>

  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAkDCwNRQqDIE_kz7uBfmNl1iOBsCT2nt8&sensor=true"></script>
  <script>
    $(document).ready(function(){
      initialize();

      function initialize() {
        var mapOptions = {
          zoom: 14,
          center: new google.maps.LatLng(0,0),
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);
        geocoder = new google.maps.Geocoder();

        var image = 'images/beachflag.png';
        var myLatLng = new google.maps.LatLng(0,0);


        var marker = new google.maps.Marker({
          position: myLatLng,
          map: map,
          title: "Test"
        });
      }
    });
  </script>
@stop