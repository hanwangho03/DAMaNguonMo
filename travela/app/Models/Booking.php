<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking'; 

    protected $primaryKey = 'bookingId'; 

    public $timestamps = false; 

    protected $fillable = [
        'tourId',
        'userId',
        'bookingDate',
        'numAdult',
        'numChild',
        'totalPrice',
        'bookingStatus',
        'specialRequests',
        'email',
        'phoneNumber',
        'address',
        'fullName'
    ];

    protected $casts = [
        'bookingDate' => 'date',
        'totalPrice' => 'double',
        'numAdult' => 'integer',
        'numChild' => 'integer',
        'specialRequests' => 'string',
    ];

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
