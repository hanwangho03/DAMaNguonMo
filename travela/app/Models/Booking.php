<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking'; // Tên bảng trong database

    protected $primaryKey = 'bookingId'; // Khóa chính

    public $timestamps = false; // Nếu bảng không có `created_at` và `updated_at`

    protected $fillable = [
        'tourId',
        'userId',
        'bookingDate',
        'numAdult',
        'numChild',
        'totalPrice',
        'bookingStatus',
        'specialRequests', // Sửa lại tên cho đúng
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

    // Quan hệ với bảng Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId');
    }

    // Quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
