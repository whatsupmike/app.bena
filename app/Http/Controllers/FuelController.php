<?php

namespace App\Http\Controllers;

use App\Fuel;
use App\Car;
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
        //
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
            $cars[$car->car_id] =  $car->name;

        }

        return view('content.fuel.create', compact('cars'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'car_id' => 'required',
            'fuelQuantity' => 'required|numeric',
            'fuelPrice' => 'required|numeric']);


        if(!$request->exists('isFullFueling')){
            $isFullFueling = 0;
            $lastFullFueling = Fuel::lastFullFueling($request->car_id)->fuel_id;

        }
        else if ($request->isFullFueling == 1){
            $isFullFueling = 1;
            $lastFullFueling = null;
        }

        $fuel = new Fuel();

        $fuel->car_id = $request->car_id;
        $fuel->user_id = Auth::id();
        $fuel->fuelQuantity = $request->fuelQuantity;
        $fuel->fuelPrice = $request->fuelPrice;
        $fuel->fuelValue = number_format(($request->fuelQuantity*$request->fuelPrice), 2, '.', '');

        $fuel->isFullFueling = $isFullFueling;
        $fuel->lastFullFueling = $lastFullFueling;

        $fuel->save();

        return redirect()->route('trip.create');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function show(Fuel $fuel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function edit(Fuel $fuel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Fuel $fuel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Fuel  $fuel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fuel $fuel)
    {
        //
    }
}
