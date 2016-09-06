@extends('Admin::layouts.default')
@section('title', $city->getName())

@section('content')

    @include('Admin::city.nav')

    <div class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-12">
                    <div class="card card-info">
                        <div class="header">
                            <h4 class="title">
                                {{ $city->getName() }}
                            </h4>
                        </div>

                        <div class="content">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td class="heading">
                                                        Название
                                                    </td>
                                                    <td>
                                                        {{ $city->getName() }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="heading">
                                                        Код Аэропорта
                                                    </td>
                                                    <td>
                                                        {{ $city->getAirportCode() }}
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </div>


                                    
                                    <div class="actions">
                                        <a href="{{ route('admin.city.edit', $city)}}" class="btn btn-primary">
                                            Редактировать
                                        </a>
                                        <a href="#" onclick="history.go(-1);" class="btn btn-default">Назад</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection