<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    protected $guarded = [];
    protected $dates = ['expires_at'];
    protected $hidden = ['id','created_at','updated_at'];

    public function getExpiresAtAttribute($value)
    {
        return $value ?? 'N/A';
    }

    public function getIssuerAttribute($value)
    {
        return $value ?? 'No SSL Certificate';
    }
}
