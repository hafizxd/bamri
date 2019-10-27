<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Bus;
use App\Driver;
use App\Order;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();

        return view('orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $buses = Bus::all();
        $drivers = Driver::all();

        return view('orders.create', compact('buses', 'drivers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Order::create([
            'bus_id' => $request->bus,
            'driver_id' => $request->driver,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'rent_date' => $request->rent_date,
            'total_days' => $request->total_days 
        ]);

        return redirect()->route('orders.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);

        return view('orders.edit', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Order::find($id)->update([
            'bus_id' => $request->bus,
            'driver_id' => $request->driver,
            'contact_name' => $request->contact_name,
            'contact_phone' => $request->contact_phone,
            'rent_date' => $request->rent_date,
            'total_days' => $request->total_days
        ]);
        
        return redirect()->route('orders.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Order::destroy($id);

        return redirect()->route('orders.index');
    }


    public function getBus(Request $request) {
        $startRentDate = new Carbon($request->rentDate);
        $endRentDate = new Carbon($request->rentDate);
        $endRentDate = $endRentDate->addDays($request->totalDays);

        // get bus
        $returnBuses = [];
        $buses = Bus::all();

        foreach($buses as $bus) {
            $hasRunningOrder = false;
            if ($bus->orders) {

                foreach($bus->orders as $order) {
                    $orderRentDate = new Carbon($order->rent_date);
                    $orderEndDate = new Carbon($order->rent_date); 
                    $orderEndDate = $orderEndDate->addDays($order->totalDays);

                    if (($startRentDate < $orderRentDate && $endRentDate > $orderEndDate) || ($startRentDate >= $orderRentDate && $startRentDate <= $orderEndDate) || ($endRentDate >= $orderRentDate && $endRentDate <= $orderEndDate)) {
                        $hasRunningOrder = true;
                    } 
                }

            }
            if (!$hasRunningOrder) array_push($returnBuses, $bus);
        }

        

        return response()->json($returnBuses);
    }


    public function getDriver(Request $request) {
        $startRentDate = new Carbon($request->rentDate);
            $endRentDate = new Carbon($request->rentDate);
            $endRentDate = $endRentDate->addDays($request->totalDays);

        // get driver
            $returnDrivers = [];
            $drivers = Driver::all();

            foreach($drivers as $driver) {
                $hasRunningOrder = false;
                if ($driver->orders) {
                    foreach($driver->orders as $order) {
                        $orderRentDate = new Carbon($order->rent_date);
                        $orderEndDate = new Carbon($order->rent_date); 
                        $orderEndDate = $orderEndDate->addDays($order->totalDays);

                        if (($startRentDate < $orderRentDate && $endRentDate > $orderEndDate) || ($startRentDate >= $orderRentDate && $startRentDate <= $orderEndDate) || ($endRentDate >= $orderRentDate && $endRentDate <= $orderEndDate)) {
                            $hasRunningOrder = true;
                        } 
                    }

                }
                if (!$hasRunningOrder) array_push($returnDrivers, $driver);
            }

            return response()->json($returnDrivers);
    }   

}

