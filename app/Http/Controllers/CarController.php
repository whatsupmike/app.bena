<?php

    namespace App\Http\Controllers;

    use App\Car;
    use Illuminate\Http\Request;

    class CarController extends Controller
    {
        /**
         * Display a listing of the resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function index()
        {
            $data = Car::all();

            return view('content.car.index', compact('data'));
        }

        /**
         * Show the form for creating a new resource.
         *
         * @return \Illuminate\Http\Response
         */
        public function create()
        {
            return view('content.car.create');
        }

        /**
         * Store a newly created resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @return \Illuminate\Http\Response
         */
        public function store(Request $request)
        {
            $this->validate($request, [
                'car_name' => 'required',
                'registration_plate' => 'required',
                'odometer' => 'required|numeric',
            ]);

            $car = new Car;

            $car->name = $request->car_name;
            $car->registrationPlate = $request->registration_plate;
            $car->odometer = $request->odometer;

            $car->save();

            return redirect()->route('car.index');
        }

        /**
         * Display the specified resource.
         *
         * @param  \App\Car $car
         * @return \Illuminate\Http\Response
         */
        public function show(Car $car)
        {
            //
        }

        /**
         * Show the form for editing the specified resource.
         *
         * @param  \App\Car $car
         * @return \Illuminate\Http\Response
         */
        public function edit(Car $car)
        {

            return view('content.car.edit', compact('car'));
        }

        /**
         * Update the specified resource in storage.
         *
         * @param  \Illuminate\Http\Request $request
         * @param  \App\Car $car
         * @return \Illuminate\Http\Response
         */
        public function update(Request $request, Car $car)
        {
            $this->validate($request, [
                'name' => 'required',
                'registrationPlate' => 'required',
            ]);

            $car->name = $request->name;
            $car->registrationPlate = $request->registrationPlate;

            $car->update();

            return redirect()->route('car.index');
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Car $car
         * @return \Illuminate\Http\Response
         */
        public function destroy(Car $car)
        {
            //
        }
    }
