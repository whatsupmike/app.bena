@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        @include('partials.header', ['title' => trans('trips.create.header') ])

        <div class="col-md-6 col-md-offset-3">
            @include('flash::message')
            {{Form::open(['url'=>'trip', 'method'=>'post', 'class'=>'form-horizontal', 'id'=>'trip-create-form'])}}

            <div class="form-group {{ $errors->has('car_id') ? 'has-error' : '' }}">
                {{Form::label('car_id', trans('trips.create.labels.car_select'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {!!  Form::select_with_data('car_id', $cars ,old('car_id') ,['class' => 'form-control', 'id' => 'car_select'])!!}
                </div>
            </div>

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

            <div class="form-group {{ $errors->has('tripNotes') ? 'has-error' : '' }}">

                {{Form::label('tripNotes', trans('trips.create.labels.trip_notes'), ['class' => 'col-md-4 control-label'])}}
                <div class="col-md-6">
                    {{ Form::textarea('tripNotes', old('tripNotes'),['class' => 'form-control', 'style' => 'height:100px !important;']) }}
                </div>
            </div>


            <div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    {{ Form::button('<i class="fa fa-btn fa-sign-in"></i> '.trans('cars.create.buttons.submit'), [ 'class' => 'btn btn-primary', 'type' => 'submit', 'id' =>'trip-create-form-submit']) }}
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
<script src="{{ mix('js/trips.js') }}"></script>
@endpush