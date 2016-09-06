@extends('Admin::layouts.default')
@section('title', "Города")

@section('content')
@include('Admin::city.nav')
<div class="content">
    <div class="container-fluid">

        <div class="row">

            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">
                            Области
                        </h4>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover">
                            <thead>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Действия</th>
                            </thead>
                            <tbody>
                                @foreach($cities as $city)
                                    <tr class="success">
                                        <td>{{ $city->getId() }}</td>
                                        <td>
                                            <a href="{{ route('admin.city.show', $city) }}">
                                                {{ $city->getName() }}
                                            </a>
                                        </td>

                                        <td>
                                            <ul>
                                                <li>
                                                    <a rel="tooltip" class="view" href="{{ route('admin.city.show', $city) }}" title="Посмотреть">
                                                        <i class="pe-7s-next-2"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a rel="tooltip" class="edit" href="{{ route('admin.city.edit', $city) }}" title="Редактировать">
                                                        <i class="pe-7s-pen"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a rel="tooltip" class="delete" href="{{ route('admin.city.softDelete', $city) }}" title="Удалить">
                                                        <i class="pe-7s-trash"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection