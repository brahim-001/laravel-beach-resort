<?php

namespace App\Http\Controllers;

use App\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $reservation = Reservation::orderBy('id', 'desc')->get();
        // return response()->json($reservation);
    
        $reservations = DB::table('users')
        ->join('reservations', 'reservations.customer_id', '=', 'users.id')
        ->select('*','users.id as id_cus ')
        ->get();

        return response()->json($reservations);
    }
    
    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reservation = new Reservation;
        $reservation->total_price=$request->total_price;
        $reservation->number_of_nights=$request->number_of_nights;
        $reservation->checkin=$request->checkin;
        $reservation->checkout=$request->checkout;
        $reservation->customer_id =$request->customer_id ;
        $reservation->room_name  =$request->room_name ;
        $reservation->save();
        return response()->json($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reservation = Reservation::findOrFail($id);
        return response()->json($reservation);
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
        
        $reservation = Reservation::findOrFail($id);
        $reservation->total_price=$request->total_price;
        $reservation->checkin=$request->checkin;
        $reservation->checkout=$request->checkout;
        $reservation->customer_id =$request->customer_id ;
        $reservation->room_id  =$request->room_id  ;
        $reservation->room_name  =$request->room_name  ;

        $reservation->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->delete();
        return response()->json($reservation);
    }
}