<?php

namespace App\Http\Controllers;

use App\Houseplant;
use Illuminate\Http\Request;

class HouseplantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $houseplants = Houseplant::all();

        return response()->json([
            "houseplants" => $houseplants,
            "success" => true
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "name" => "required",
        ]);

        $houseplant = Houseplant::create($request->all());
        
        return response()->json([
            "success" => true
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Houseplant  $houseplant
     * @return \Illuminate\Http\Response
     */
    public function show(Houseplant $houseplant)
    {
        $houseplant->load("notes");

        return response()->json([
            "houseplant" => $houseplant,
            "success" => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Houseplant  $houseplant
     * @return \Illuminate\Http\Response
     */
    public function destroy(Houseplant $houseplant)
    {
        $houseplant->delete();

        return response()->json([
            "success" => true
        ], 200);
    }
}
