<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessModel extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'business';
    protected $primaryKey = 'business_id';
    protected $fillable = ['location', 'latitude', 'longitude', 'term', 'radius', 'categories', 'locale', 'price', 'open_now', 'open_at', 'attributes', 'sort_by', 'device_platform', 'reservation_date', 'reservation_time', 'reservation_covers', 'matches_party_size_param', 'limit', 'offset'];
}
