<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Binnacle extends Model
{
    protected $fillable = [
        'binnacle_id', 'user_id', 'created_at', 'updated_at'
    ];
}
