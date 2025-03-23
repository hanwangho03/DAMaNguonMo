<?php

namespace App\Models\clients;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    use HasFactory;
    protected $table = 'tour';
    protected $primaryKey = 'tourId'; // Định nghĩa khóa chính

    public function getHomeTours()
    {
        $tours = DB::table('tour')->get();

        foreach ($tours as $tour) {
            $tour->images = DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageURL')
                ->map(function ($image) {
                    return str_replace('travela\public\\', '', $image); // Chỉ giữ phần sau "public/"
                });
        }

        return $tours;
    }
}
