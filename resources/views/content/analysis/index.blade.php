@extends('layouts.app')

@section('content')

    @include('partials.header', [   'title' => trans('analysis.index.header'),
                                    'links' =>[ 'settlement' =>['route'=>route('analysis.settlement'),
                                                                'button_title'=>trans('analysis.index.settlement_button'),
                                                                'content'=>'<i class="fa fa-handshake-o fa-3x" aria-hidden="true"></i>'] ]])
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-offset-3 col-md-6">
                @include('flash::message')
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <td>{{ trans('analysis.index.table.no') }}</td>
                        <td>{{ trans('analysis.index.table.passenger_name') }}</td>
                        <td>{{ trans('analysis.index.table.to_pay') }}</td>
                        @if(Auth::id() == 1)
                            <td>{{ trans('analysis.index.table.actions') }}</td>
                        @endif
                    </tr>
                    </thead>
                    @foreach($passengersDebts as $passenger)

                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $passenger['name'] }}</td>
                            <td style="text-align: right;">{{$passenger['toPay']}} zł</td>
                            @if(Auth::id() == 1)
                                <td><input type="checkbox" data-id="{{$passenger['id']}}" class="to-pay"></td>
                            @endif
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
<script src="{{ mix('js/analysis.js') }}"></script>
@endpush