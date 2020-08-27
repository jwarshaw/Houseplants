<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    protected $fillable = [
        "date",
        "height_inches",
        "water_cups",
    ];

    public function houseplant()
    {
        return $this->belongsTo("App\Houseplant");
    }
}
