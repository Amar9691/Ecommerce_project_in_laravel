<?php

namespace App\Http\Controllers;

use App\Models\subscribe;
use Illuminate\Http\Request;

class SubscribeController extends Controller
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
            
        $result = subscribe::create([
              'email'=>$request->email,
         ]);

         if($result)
         {
            return redirect()->route('main')->with('message','You are successfully Subscribed');
         }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function show(subscribe $subscribe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function edit(subscribe $subscribe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, subscribe $subscribe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\subscribe  $subscribe
     * @return \Illuminate\Http\Response
     */
    public function destroy(subscribe $subscribe)
    {
        //
    }
}
