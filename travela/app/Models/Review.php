<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    protected $primaryKey = 'reviewId';

    protected $fillable = [
        'tourId',
        'userId',
        'comment',
        'timestamp',
        'hidden'
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class, 'tourId');
    }
}
