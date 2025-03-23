<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    // Tên bảng nếu không theo quy ước Laravel
    protected $primaryKey = 'reviewId';

    protected $fillable = [
        'tourId',
        'userId',
        'comment',
        'timestamp',
        'hidden'
    ];

    // Nếu không sử dụng timestamps mặc định của Laravel
    public $timestamps = false;

    // Relationship với User
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    // Relationship với Tour
    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId');
    }
}
