@extends('Front::layouts.default')
@include('Front::partials.main_header')
@include('Front::partials.header')

@section('content')

<div class="sub-header col-lg-12 col-md-12 col-sm-12 no-padding">

  @include('Front::partials.search_form')
                    
  @include('Front::partials.slider')

  </div>

</div>
@include('Front::partials.main_content')
@include('Front::partials.footer')