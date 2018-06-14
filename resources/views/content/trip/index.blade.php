@extends('layouts.app')

@section('content')

    @include('partials.header', [   'title' => trans('trips.index.header'),
                                    'links' =>[ 'create-trip' =>[   'route'=>route('trip.create'),
                                                                    'button_title'=>trans('trips.index.add_button'),
                                                                    'content'=>'<i class="fa fa-plus fa-3x" aria-hidden="true"></i>'] ]])
    <div class="container-fluid">

        <div class="row">
            <!-- Nav tabs -->


            <div class="col-md-offset-3 col-md-6">
                @include('flash::message')
                <ul class="nav nav-tabs" role="tablist">
                    @foreach($cars as $car)
                        @if($loop->iteration == 1)
                            @php
                                $active = 'active';
                            @endphp
                        @else
                            @php
                                $active = '';
                            @endphp
                        @endif
                        <li role="presentation" class="{{$active}}"><a href="#{{ $car->slug }}" aria-controls="home"
                                                                  role="tab" data-toggle="tab">{{ $car->name }}</a></li>
                    @endforeach
                </ul>

                <div class="tab-content">
                    @foreach($cars as $car)
                        @if($loop->iteration == 1)
                            @php
                                $active = 'active';
                            @endphp
                        @else
                            @php
                                $active = '';
                            @endphp
                        @endif
                        <div role="tabpanel" class="tab-pane {{$active}}" id="{{ $car->slug }}">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <td class="text-right">{{ trans('trips.index.table.no') }}</td>
                                    <td>{{ trans('trips.index.table.car_name') }}</td>
                                    <td class="text-right">{{ trans('trips.index.table.distance') }}</td>
                                    <td class="text-right">{{ trans('trips.index.table.odometer_after') }}</td>
                                    <td class="text-right">{{ trans('trips.index.table.actions') }}</td>
                                </tr>
                                </thead>
                                @foreach($car->trips as $trip)

                                    <tr>
                                        <td class="text-right">{{ $loop->iteration }}</td>
                                        <td>{{ $car->name }}</td>
                                        <td class="text-right">{{number_format($trip->odometerAfter - $trip->odometerBefore, 0, ',', ' ')}}
                                            km
                                        </td>
                                        <td class="text-right">{{number_format($trip->odometerAfter, 0, ',', ' ')}}km
                                        </td>
                                        <td class="text-right"><a
                                                    href="{{ route('trip.edit', ['trip' => $trip->slug]) }}"> <i
                                                        class="fa fa-pencil fa-2x"
                                                        aria-hidden="true"></i></a>
                                        </td>
                                    </tr>

                                @endforeach
                            </table>
                        </div>
                    @endforeach
                </div>


            </div>
        </div>
    </div>

@endsection