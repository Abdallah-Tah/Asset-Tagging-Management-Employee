<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AmazonSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'region',
        'location',
        'address',
        'city',
        'state',
        'zip',
        'square_feet',
        'labor_budget',
        'labor_hours',
        'user_id',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function employee()
    {
        return $this->belongsToMany('App\Models\Employee');
    }
}