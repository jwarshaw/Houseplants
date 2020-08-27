<?php

namespace App\Http\Controllers;

use App\Note;
use App\Houseplant;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Houseplant  $houseplant
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Houseplant $houseplant, Request $request)
    {
        $validatedData = $request->validate([
            "date" => "required",
            "water_cups" => "required",
        ]);

        $note = $houseplant->notes()->create([
            "date" => $request->date,
            "water_cups" => $request->water_cups,
            "height_inches" => $request->height_inches,
        ]);

        return response()->json([
            "note" => $note,
            "success" => true
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(Note $note)
    {
        $note->delete();

        return response()->json([
            "success" => true
        ], 200);
    }
}
