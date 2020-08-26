<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Houseplant extends Model
{
    protected $fillable = [
        'name',
        'recommended_care',
    ];
}
