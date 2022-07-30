<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paycheck extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amazon_site_id',
        'from',
        'to',
        'pay_stub_number',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function amazonSite()
    {
        return $this->belongsToMany('App\Models\AmazonSite');
    }

    public function settingSite()
    {
        return $this->hasMany('App\Models\SettingSite');
    }

    public function employee()
    {
        return $this->belongsToMany('App\Models\Employee');
    }
}
