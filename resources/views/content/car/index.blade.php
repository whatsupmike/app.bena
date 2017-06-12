@extends('layouts.app')

@section('content')

    @include('partials.header', [   'title' => trans('cars.index.header'),
                                    'links' =>[ 'create-car' =>['route'=>route('car.create'),
                                                                'button_title'=>'',
                                                                'content'=>'<i class="fa fa-plus fa-3x" aria-hidden="true"></i>'] ]])


@endsection