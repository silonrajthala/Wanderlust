<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'destination_name',
        'travel_date',
        'travelers',
        'special_requests',
        'status',
        'total_price',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'total_price' => 'decimal:2',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
