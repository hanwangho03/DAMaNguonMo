<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    protected $table = 'tour';
    protected $primaryKey = 'tourId';

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
        /// Lấy chi tiết tour
        public function getTourDetail($id)
        {
            $tour = self::where('tourId', $id)->first(); // Lấy dữ liệu dưới dạng Model
        
            if ($tour) {
                // Lấy danh sách hình ảnh
                $tour->images = DB::table('images')
                    ->where('tourId', $tour->tourId)
                    ->limit(5)
                    ->pluck('imageUrl')
                    ->map(function ($image) {
                        return asset(str_replace('D:\\travela\\public\\', '', $image));
                    });
        
                // Lấy danh sách timeline
                $tour->timeline = DB::table('timeline')
                    ->where('tourId', $tour->tourId)
                    ->get();
            }
        
            return $tour;
        }
}
