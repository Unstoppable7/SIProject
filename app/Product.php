<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'audit_id', 'name', 'status ',
    ];

    public function companies()
    {
        return $this->belongsToMany('App\Company')->withPivot('audit_id', 'company_id', 'product_id', 'in_original', 'original_stock_number', 'in_replacement', 'replacement_stock_number', 'status');
    }
}
