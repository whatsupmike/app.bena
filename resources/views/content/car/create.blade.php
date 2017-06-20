@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('partials.header', ['title' => trans('cars.create.header') ])
    <div class="col-md-6 col-md-offset-3">
        {{Form::open(['url'=>'car', 'method'=>'post', 'class'=>'form-horizontal', 'id'=>'car-create-form'])}}

        <div class="form-group {{ $errors->has('car_name') ? 'has-error' : '' }}">
            {{Form::label('car_name', trans('cars.create.labels.car_name'), ['class' => 'col-md-4 control-label'])}}
            <div class="col-md-6">
                {{Form::text('car_name', old('car_name') ,['class' => 'form-control'])}}
            </div>
        </div>

        <div class="form-group {{ $errors->has('registration_plate') ? 'has-error' : '' }}">
            {{Form::label('registration_plate', trans('cars.create.labels.registration_plate'), ['class' => 'col-md-4 control-label'])}}
            <div class="col-md-6">
                {{Form::text('registration_plate', old('registration_plate') ,['class' => 'form-control'])}}
            </div>
        </div>

        <div class="form-group {{ $errors->has('odometer') ? 'has-error' : '' }}">
            {{Form::label('odometer', trans('cars.create.labels.odometer'), ['class' => 'col-md-4 control-label'])}}
            <div class="col-md-6">
                {{Form::text('odometer', old('odometer') ,['class' => 'form-control'])}}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {{ Form::button('<i class="fa fa-btn fa-sign-in"></i> '.trans('cars.create.buttons.submit'), [ 'class' => 'btn btn-primary', 'type' => 'submit', 'id' =>'car-create-form-submit']) }}
            </div>
        </div>

        @if($errors->any())
            <div class="form-group">
                <div class="col-md-8 col-md-offset-2">
                    <div class="alert alert-danger" role="alert">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        {{Form::close()}}
    </div>
</div>
@endsection