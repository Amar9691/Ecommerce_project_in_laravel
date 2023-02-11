<?php

namespace App\Http\Controllers;

use App\Models\pincode;
use Illuminate\Http\Request;

class PincodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $status = Pincode::where('pincode',$request->pin)->first();

        if($status->deliverystatus == Null )
        {
             echo "sorry we can't delivery at this location";

        }
        else
        { 
            echo $status->deliverystatus;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function show(pincode $pincode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function edit(pincode $pincode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pincode $pincode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pincode  $pincode
     * @return \Illuminate\Http\Response
     */
    public function destroy(pincode $pincode)
    {
        //
    }
}
