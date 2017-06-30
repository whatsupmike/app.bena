@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.header', ['title' => trans('fuels.create.header') ])

        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
            {{Form::open(['url'=>'fuel', 'method'=>'post', 'class'=>'form-horizontal', 'id'=>'fuel-create-form'])}}

            <div class="form-group {{ $errors->has('car_id') ? 'has-error' : '' }}">
                {{Form::label('car_id', trans('fuels.create.labels.car_select'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {!!  Form::select('car_id', $cars ,old('car_id') ,['class' => 'form-control', 'id' => 'car_select'])!!}
                </div>
            </div>
            <hr>
            <div class="form-group {{ $errors->has('fuelQuantity') ? 'has-error' : '' }}">
                {{Form::label('fuelQuantity', trans('fuels.create.labels.fuel_quantity'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <div class="input-group">
                        {{Form::text('fuelQuantity', old('fuelQuantity') ,['class' => 'form-control', 'id' => 'fuel-quantity'])}}
                        <div class="input-group-addon">l</div>
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('fuelPrice') ? 'has-error' : '' }}">
                {{Form::label('fuelPrice', trans('fuels.create.labels.fuel_price'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <div class="input-group">
                        {{Form::text('fuelPrice', old('fuelPrice') ,['class' => 'form-control', 'id' => 'fuel-price'])}}
                        <div class="input-group-addon">zł / l</div>
                    </div>
                </div>
            </div>


            <div class="form-group {{ $errors->has('fuelValue') ? 'has-error' : '' }}">

                {{Form::label('fuelValue', trans('fuels.create.labels.fuel_value'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <p id="fuel-value" style="padding-top: 7px"></p>
                </div>
            </div>
            <div class="form-group {{ $errors->has('isFullFueling') ? 'has-error' : '' }}">

                {{Form::label('isFullFueling', ' ', ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <p style="padding-top: 7px">{{Form::checkbox('isFullFueling', '1', true)}} {{trans('fuels.create.labels.is_full')}}</p>
                </div>
            </div>
            <hr>
            <div class="form-group {{ $errors->has('fuelNotes') ? 'has-error' : '' }}">

                {{Form::label('fuelNotes', trans('fuels.create.labels.fuel_notes'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {{ Form::textarea('fuelNotes', old('fuelNotes'),['class' => 'form-control', 'style' => 'height:100px !important;']) }}
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {{ Form::button('<i class="fa fa-btn fa-sign-in"></i> '.trans('fuels.create.buttons.submit'), [ 'class' => 'btn btn-primary col-xs-12', 'type' => 'submit', 'id' =>'fuels-create-form-submit']) }}
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

@push('scripts')
<script src="{{ mix('js/fuels.js') }}"></script>
@endpush