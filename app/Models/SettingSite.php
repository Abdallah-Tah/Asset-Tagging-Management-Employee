<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingSite extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amazon_site_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function amazonSite()
    {
        return $this->belongsToMany('App\Models\AmazonSite');
    }
}
