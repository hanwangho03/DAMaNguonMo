<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    protected $table = 'tour';

    public function getAllTours($perPage = 4)
{
    $allTours = DB::table($this->table)
        ->where('availability', 1)
        ->paginate($perPage);

    foreach ($allTours as $tour) {
        $tour->images = DB::table('images')
            ->where('tourId', $tour->tourId)
            ->pluck('imageUrl')
            ->map(function ($image) {
                return asset(str_replace('D:\\travela\\public\\', '', $image)); // Chuyển đổi đường dẫn
            })
            ->toArray();
    }

    return $allTours;
}
        //Lấy chi tiết tour
        public function getTourDetail($id)
        {
            $getTourDetail = DB::table($this->table)
                ->where('tourId', $id)
                ->first();
    
            if ($getTourDetail) {
                // Lấy danh sách hình ảnh thuộc về tour
                $getTourDetail->images = DB::table('images')
                    ->where('tourId', $getTourDetail->tourId)
                    ->limit(5)
                    ->pluck('imageUrl');
    
                // Lấy danh sách timeline thuộc về tour
                $getTourDetail->timeline = DB::table('timeline')
                    ->where('tourId', $getTourDetail->tourId)
                    ->get();
            }
    
    
            return $getTourDetail;
        }
}
