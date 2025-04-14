<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoice';
    public $timestamps = false;
    protected $primaryKey = 'invoiceId'; 
    protected $fillable = [
        'bookingId',
        'amount',
        'dateIssued',
        'details'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class, 'bookingId', 'id');
    }
}
