@extends('layouts.app')

@section('content')

    @include('partials.header', [   'title' => trans('cars.index.header'),
                                    'links' =>[ 'create-car' =>['route'=>route('car.create'),
                                                                'button_title'=>trans('cars.index.add_button'),
                                                                'content'=>'<i class="fa fa-plus fa-3x" aria-hidden="true"></i>'] ]])
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-offset-3 col-md-6">


                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>{{ trans('cars.index.table.no') }}</td>
                        <td>{{ trans('cars.index.table.car_name') }}</td>
                        <td>{{ trans('cars.index.table.registration_plate') }}</td>
                        <td>{{ trans('cars.index.table.actions') }}</td>
                    </tr>
                    </thead>
                    @foreach($data as $car)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $car->name }}</td>
                            <td>{{$car->registrationPlate}}</td>
                            <td><a href="{{ route('car.edit', ['car' => $car->slug]) }}"> <i class="fa fa-pencil fa-2x"
                                                                                             aria-hidden="true"></i></a>
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection