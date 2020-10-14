<?php

    namespace App\Http\Controllers;

    use App\Fuel;
    use App\Passenger;
    use App\Trip;
    use App\Car;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Validator;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cars = Car::all();
        return view('content.trip.index', compact('cars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cars = Car::all();

        $data = ['odometerBeforeValue' => '123', 'odometerBefore' => '234'];
        foreach ($cars as $car) {
            $data['cars'][$car->car_id] = ['name' => $car->name,
                'data' => [
                    'odometerBeforeValue' => $car->odometer,
                    'odometerBefore' => number_format($car->odometer, 0, ',', ' ')]];
        }
        $passengers = Passenger::all();

        $data['passengers'] = [];

        foreach ($passengers as $passenger) {
            $data['passengers'][$passenger->passenger_id] = $passenger->name;
        }

        return view('content.trip.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
            'car_id' => 'required',
            'odometerAfter' => 'required|integer',
                ]
        );

        $car_id = $request->car_id;
        $odometerAfter = $request->odometerAfter;

        $car = Car::find($car_id);

        $validator->after(
            function ($validator) use ($car, $odometerAfter) {


                if ($car->odometer >= $odometerAfter) {
                    $validator->errors()->add('odometerAfter', trans('trips.js.error.no-negative-trip'));
                }

                if (Fuel::lastFullFueling($car->id)->count() == 0) {
                    $validator->errors()->add('lastFullFueling', trans('trips.messages.no-full-fueling'));
                }
            }
        );

        if ($validator->fails()) {
            return redirect()->route('trip.create')
                ->withErrors($validator)
                ->withInput();
        } else {
            $trip = new Trip();

            if (!$request->exists('onPassengers')) {
                $onPassengers = 0;
            } elseif ($request->onPassengers == 1) {
                $onPassengers = 1;
            }

            $trip->car_id = $car->car_id;
            $trip->user_id = Auth::id();
            $trip->odometerBefore = $car->odometer;
            $trip->odometerAfter = $odometerAfter;

            $trip->tripNotes = $request->tripNotes;
            $trip->onPassengers = $onPassengers;

            //$trip->fuel_id = Fuel::lastFullFueling($car->car_id)->fuel_id;

            $trip->save();

            $car->odometer = $odometerAfter;
            $car->save();

            if (count($request->tripPassengers) != 0) {
                foreach ($request->tripPassengers as $passenger_name) {
                    if (intval($passenger_name) == 0) {
                        $checkedPassenger = Passenger::where('name', '=', $passenger_name);
                        if ($checkedPassenger->count() == 0) {
                            $passenger = new Passenger();
                            $passenger->name = ucwords($passenger_name);
                            $passenger->save();

                            $trip->passengers()->attach($passenger);
                        } else {
                            $trip->passengers()->attach($checkedPassenger->first());
                        }
                    } else {
                        $trip->passengers()->attach($passenger_name);
                    }
                }
            }
            flash(trans('trips.messages.success'))->success();

            return redirect()->route('trip.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Trip                $trip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Trip $trip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        //
    }
}
