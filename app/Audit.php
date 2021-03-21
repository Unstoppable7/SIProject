<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Audit extends Model
{
    protected $fillable = [
        'audit_id', 'table_name', 'row_code',
        'operation_type_code', 'statement',
        'error', 'user_id',
        'mac_code', 'ip_code', 'error_status'
    ];
}
