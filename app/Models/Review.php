<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'destination_name',
        'rating',
        'comment',
        'travel_date',
    ];

    protected $casts = [
        'travel_date' => 'date',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
