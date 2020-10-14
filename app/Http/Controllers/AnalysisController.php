<?php

namespace App\Http\Controllers;

use App\Fuel;
use App\Passenger;
use App\PassengersDebts;
use App\Settlements;
use App\Trip;
use Illuminate\Http\Request;
use Mockery\Generator\StringManipulation\Pass\Pass;

class AnalysisController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function index()
    {

        $data = PassengersDebts::with('passenger')->where('isPaid', 0)->get();

        $passengersDebts = array();

        foreach ($data as $passengerDebt) {
            $passenger_id = $passengerDebt->passenger_id;
            if (isset($passengersDebts[$passenger_id]['id'])) {
                $passengersDebts[$passenger_id]['toPay'] += $passengerDebt->toPay;
            } else {
                $passengersDebts[$passenger_id]['id'] = $passenger_id;
                $passengersDebts[$passenger_id]['name'] = $passengerDebt->passenger->name;
                $passengersDebts[$passenger_id]['toPay'] = $passengerDebt->toPay;
            }
        }

        return view('content.analysis.index', compact('passengersDebts'));
    }

    /**
     * Go to settlement.
     *
     * @return \Illuminate\Http\Response
     */
    function settlement()
    {
        return view('content.analysis.index');
    }



    function settle()
    {
        $toPay = $this->getToPayArray();

        foreach ($toPay as $id => $passengerPay) {
            $passengerDebt = new PassengersDebts();
            $passengerDebt->passenger_id = $id;
            $passengerDebt->settlement_id = $passengerPay['settlement'];
            $passengerDebt->toPay = $passengerPay['toPay'];
            $passengerDebt->isPaid = 0;
            $passengerDebt->save();
        }

        if (count($toPay)==0) {
            flash(trans('analysis.messages.void'))->error();
        } else {
            flash(trans('analysis.messages.success'))->success();
        }
        return redirect()->route('analysis');
    }

    function getToPayArray()
    {
        $fuels = $this->getFuelsToAnalysis();
        $settlement_id = $fuels[1]->id;
        $passengers = array();
        $users = array();
        foreach ($fuels[0] as $fuel) {
            $trips = $this->getTripsForFuel($fuel['id']);


            foreach ($trips as $trip) {
                if ($trip['onPassengers'] == 1) {
                    if (count($trip['passengers']) != 0) {
                        $price = ($trip['distance']/count($trip['passengers']))*$fuel['pricePerKm'];

                        foreach ($trip['passengers'] as $passenger) {
                            if (isset($passengers[$passenger['id']])) {
                                $passengers[$passenger['id']] += $price;
                            } else {
                                $passengers[$passenger['id']] = $price;
                            }
                        }
                    } else {
                        if (isset($users[$trip['user']])) {
                            $users[$trip['user']] += $trip['distance']*$fuel['pricePerKm'];
                        } else {
                            $users[$trip['user']] = $trip['distance']*$fuel['pricePerKm'];
                        }
                    }
                } else {
                    $price = ($trip['distance']/(count($trip['passengers'])+1))*$fuel['pricePerKm'];

                    foreach ($trip['passengers'] as $passenger) {
                        if (isset($passengers[$passenger['id']])) {
                            $passengers[$passenger['id']] += $price;
                        } else {
                            $passengers[$passenger['id']] = $price;
                        }
                    }

                    if (isset($users[$trip['user']])) {
                        $users[$trip['user']] += $price;
                    } else {
                        $users[$trip['user']] = $price;
                    }
                }
            }
        }

        $joinedUsersPassengers = $this->joinUserPaymentsAndPassengerPayments($users, $passengers);
        $toppedValuesArray = $this->ceilToPayValues($joinedUsersPassengers);

        $toPayArray = $this->addPassengerNameAndSettlementToPrice($toppedValuesArray, $settlement_id);

        return $toPayArray;
    }

    function getFuelsToAnalysis()
    {
        $fullFuels = Fuel::where('isAccounted', 0)->where('isFullFueling', 1);

        $fuels = array();
        foreach ($fullFuels->cursor() as $fuel) {
            $fuels[$fuel->fuel_id]['id'] = $fuel->fuel_id;
            $fuels[$fuel->fuel_id]['car_id'] = $fuel->car_id;
            $fuels[$fuel->fuel_id]['amount'] = $fuel->fuelQuantity;
            $fuels[$fuel->fuel_id]['value'] = $fuel->fuelValue;

            $notFullFuels = Fuel::where('isAccounted', 0)->where('isFullFueling', 0)->where('lastFullFueling', $fuel->fuel_id);

            foreach ($notFullFuels->cursor() as $notFull) {
                $fuels[$fuel->fuel_id]['amount'] += $notFull->fuelQuantity;
                $fuels[$fuel->fuel_id]['value'] += $notFull->fuelValue;
                Fuel::where('fuel_id', $notFull->fuel_id)->update(['isAccounted' => 1]);
            }
            $fuels[$fuel->fuel_id]['distance'] = $this->getDistanceForFuel($fuel->fuel_id);
            $fuels[$fuel->fuel_id]['pricePerKm'] = $fuels[$fuel->fuel_id]['value']/$fuels[$fuel->fuel_id]['distance'];
            Fuel::where('fuel_id', $fuel->fuel_id)->update(['isAccounted' => 1]);
        }
        $settlement = new Settlements();

        $settlement->content = json_encode($fuels);

        $settlement->save();
        return [$fuels, $settlement];
    }

    function getDistanceForFuel($fuel_id)
    {
        $trips = Trip::where('fuel_id', $fuel_id);

        $before = ( $trips->first()->odometerBefore);
        $after = (($trips->latest()->first()->odometerAfter));


        return $after - $before;
    }

    function getTripsForFuel($fuel_id)
    {
        $trips = Trip::where('fuel_id', $fuel_id);

        $trips_data = array();
        foreach ($trips->cursor() as $trip) {
            $trips_data[$trip->trip_id]['id'] = $trip->trip_id;
            $trips_data[$trip->trip_id]['distance'] = $trip->odometerAfter - $trip->odometerBefore;
            $trips_data[$trip->trip_id]['user'] = $trip->user_id;
            $trips_data[$trip->trip_id]['onPassengers'] = $trip->onPassengers;
            $trips_data[$trip->trip_id]['passengers'] = $this->getPassengersForTrip($trip->trip_id);
        }
        return $trips_data;
    }

    function getPassengersForTrip($trip_id)
    {
        $passengers = Trip::find($trip_id)->passengers()->get();

        $passengers_data = array();
        foreach ($passengers as $passenger) {
            $passengers_data[$passenger->passenger_id]['id'] = $passenger->passenger_id;
            $passengers_data[$passenger->passenger_id]['name'] = $passenger->name;
        }

        return $passengers_data;
    }

    function joinUserPaymentsAndPassengerPayments($userPayments, $passengerPayments)
    {
        $passengers = $passengerPayments;
        foreach ($userPayments as $key => $userPayment) {
            $passenger = Passenger::where('user_id', $key)->first();
            $passenger_id = $passenger->passenger_id;

            if (isset($passengers[$passenger_id])) {
                $passengers[$passenger_id] += $userPayment;
            } else {
                $passengers[$passenger_id] = $userPayment;
            }
        }
        return $passengers;
    }

    function ceilToPayValues($toPayArray)
    {
        $toPay = $toPayArray;

        foreach ($toPay as $key => $value) {
            $toPay[$key] = ceil($value);
        }

        return $toPay;
    }

    function addPassengerNameAndSettlementToPrice($toPayArray, $settlement)
    {
        $toPay = array();
        foreach ($toPayArray as $key => $value) {
            $passenger = Passenger::find($key);
            $toPay[$key]['name'] = $passenger->name;
            $toPay[$key]['toPay'] = $value;
            $toPay[$key]['settlement'] = $settlement;
        }

        return $toPay;
    }

    function paid(Request $request)
    {
        PassengersDebts::where('passenger_id', $request->id)->where('isPaid', 0)->update(['isPaid' => 1]);
        return $request->id;
    }
}
