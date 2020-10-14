<?php

    namespace App\Http\Controllers;

    use App\Fuel;
    use App\Car;
    use App\Trip;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $carsModels = Car::all();

        $cars = [];
        foreach ($carsModels as $car) {
            $cars[$car->car_id] = $car->name;
        }

        return view('content.fuel.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
            'car_id' => 'required',
            'fuelQuantity' => 'required|numeric',
            'fuelValue' => 'required|numeric']
        );


        if (!$request->exists('isFullFueling')) {
            $isFullFueling = 0;
            $lastFullFueling = null; //Fuel::lastFullFueling($request->car_id)->fuel_id;
        } elseif ($request->isFullFueling == 1) {
            $isFullFueling = 1;
            $lastFullFueling = null;
        }

        $fuel = new Fuel();

        $fuel->car_id = $request->car_id;
        $fuel->user_id = Auth::id();
        $fuel->fuelQuantity = $request->fuelQuantity;
        $fuel->fuelPrice = number_format(($request->fuelValue / $request->fuelQuantity ), 2, '.', '');
        $fuel->fuelValue = $request->fuelValue;

        $fuel->fuelNotes = $request->fuelNotes;

        $fuel->isFullFueling = $isFullFueling;
        $fuel->lastFullFueling = $lastFullFueling;

        $fuel->save();

        if ($isFullFueling == 1) {
            // Assign full fueling to trips
            $trips = Trip::whereNull('fuel_id')->update(['fuel_id' => Fuel::lastFullFueling($request->car_id)->fuel_id]);

            //Assign full fueling to no full fuelings
            Fuel::where('isFullFueling', 0)->whereNull('lastFullFueling')->update(['lastFullFueling' => Fuel::lastFullFueling($request->car_id)->fuel_id]);
        }

        flash(trans('fuels.messages.success'))->success();
        return redirect()->route('trip.create');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fuel $fuel
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel $fuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fuel $fuel
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel $fuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Fuel                $fuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel $fuel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fuel $fuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fuel $fuel)
    {
        //
    }
}
