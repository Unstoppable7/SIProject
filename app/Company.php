<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'audit_id','name', 'registry_number', 'address',
        'latitud_number', 'longitude_number',
        'mobile_number', 'phone_number',
        'email', 'country_code', 'branch_status',
        'active_status'
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('audit_id', 'company_id', 'product_id', 'in_original', 'original_stock_number', 'in_replacement', 'replacement_stock_number', 'status');
    }
}
