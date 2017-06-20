@extends('layouts.app')

@section('content')
<div class="container-fluid">
    @include('partials.header', ['title' => trans('cars.edit.header') ])
    <div class="col-md-6 col-md-offset-3">
        {{Form::model($car, ['route'=>['car.update',$car->slug], 'method'=>'put', 'class'=>'form-horizontal', 'id'=>'car-create-form'])}}

        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            {{Form::label('name', trans('cars.edit.labels.car_name'), ['class' => 'col-md-4 control-label'])}}
            <div class="col-md-6">
                {{Form::text('name', old('name') ,['class' => 'form-control'])}}
            </div>
        </div>

        <div class="form-group {{ $errors->has('registrationPlate') ? 'has-error' : '' }}">
            {{Form::label('registrationPlate', trans('cars.edit.labels.registration_plate'), ['class' => 'col-md-4 control-label'])}}
            <div class="col-md-6">
                {{Form::text('registrationPlate', old('registrationPlate') ,['class' => 'form-control'])}}
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6 col-md-offset-4">
                {{ Form::button('<i class="fa fa-btn fa-sign-in"></i> '.trans('cars.edit.buttons.submit'), [ 'class' => 'btn btn-primary', 'type' => 'submit', 'id' =>'car-edit-form-submit']) }}
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