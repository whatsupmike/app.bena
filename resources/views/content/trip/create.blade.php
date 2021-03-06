@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.header', ['title' => trans('trips.create.header') ])

        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
            @if($errors->any())
                <div class="form-group">
                    <div class="col-md-12">
                        <div class="alert alert-danger" role="alert">
                            @foreach($errors->all() as $error)
                                {{ $error }}<br>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
            {{Form::open(['url'=>'trip', 'method'=>'post', 'class'=>'form-horizontal', 'id'=>'trip-create-form'])}}

            <div class="form-group {{ $errors->has('car_id') ? 'has-error' : '' }}">
                {{Form::label('car_id', trans('trips.create.labels.car_select'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {!!  Form::select_with_data('car_id', $cars ,old('car_id') ,['class' => 'form-control', 'id' => 'car_select'])!!}
                </div>
            </div>
            <hr>
            <div class="form-group {{ $errors->has('odometerBefore') ? 'has-error' : '' }}">

                {{Form::label('odometerBefore', trans('trips.create.labels.odometer_before'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <p id="odometer-before" data-odometer="" style="padding-top: 7px"></p>
                </div>
            </div>

            <div class="form-group {{ $errors->has('odometerAfter') ? 'has-error' : '' }}">
                {{Form::label('odometerAfter', trans('trips.create.labels.odometer_after'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <div class="input-group">
                        {{Form::text('odometerAfter', old('odometerAfter') ,['class' => 'form-control', 'id' => 'odometer-after'])}}
                        <div class="input-group-addon">km</div>
                    </div>
                </div>
            </div>

            <div class="form-group {{ $errors->has('odometerBefore') ? 'has-error' : '' }}">

                {{Form::label('tripDistance', trans('trips.create.labels.trip_distance'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <p id="trip-distance" style="padding-top: 7px"></p>
                </div>
            </div>
            <hr>
            <div class="form-group {{ $errors->has('tripPassengers') ? 'has-error' : '' }}">

                {{Form::label('tripPassengers', trans('trips.create.labels.trip_passengers'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {{ Form::select('tripPassengers[]', $passengers, old('tripPassengers'),['class' => 'form-control', 'id' => 'passengers-select', 'multiple'=>'multiple']) }}
                </div>
            </div>
            <div class="form-group {{ $errors->has('onPassengers') ? 'has-error' : '' }}">

                {{Form::label('onPassengers', ' ', ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    <p style="padding-top: 7px">{{Form::checkbox('onPassengers', '1', false)}} {{trans('trips.create.labels.on_passengers')}}</p>
                </div>
            </div>
            <hr>
            <div class="form-group {{ $errors->has('tripNotes') ? 'has-error' : '' }}">

                {{Form::label('tripNotes', trans('trips.create.labels.trip_notes'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {{ Form::textarea('tripNotes', old('tripNotes'),['class' => 'form-control', 'style' => 'height:100px !important;']) }}
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {{ Form::button('<i class="fa fa-btn fa-sign-in"></i> '.trans('cars.create.buttons.submit'), [ 'class' => 'btn btn-primary col-xs-12', 'type' => 'submit', 'id' =>'trip-create-form-submit']) }}
                </div>
            </div>


            {{Form::close()}}
        </div>
    </div>
@endsection

@push('scripts')
<script src="{{ mix('js/trips.js') }}"></script>
<script src="{{ asset('js/select2.full.min.js') }}"></script>
@endpush

@push('styles')
<link href="{{ asset('css/select2.min.css') }}" rel="stylesheet" />
@endpush