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
                return asset(str_replace('travela\\public\\', '', $image)); // Chuyển đổi đường dẫn
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
                        return asset(str_replace('travela\\public\\', '', $image));
                    });
        
                // Lấy danh sách timeline
                $tour->timeline = DB::table('timeline')
                    ->where('tourId', $tour->tourId)
                    ->get();
            }
        
            return $tour;
        }
        
    /**
     * Lấy danh sách review của tour
     */
     // Hàm lấy tất cả review của một tour
     public function getReviewsForTour($id)
     {
         return DB::table('reviews')
             ->join('user', 'reviews.userId', '=', 'user.userId')
             ->where('reviews.tourId', $id)
             ->orderBy('reviews.timestamp', 'desc')
             ->select('reviews.comment', 'reviews.timestamp', 'user.userName') // Thay fullName bằng userName
             ->get();
     }
 
     // Hàm thêm review mới vào database
     public function addReview($tourId, $userId, $comment)
     {
         return DB::table('reviews')->insert([
             'tourId' => $tourId,
             'userId' => $userId,
             'comment' => $comment,
             'timestamp' => now()
         ]);
     }
     public function searchToursByDestination($destination, $perPage = 4)
    {
        $query = DB::table($this->table)
            ->where('availability', 1);

        if (!empty($destination)) {
            $query->where('destination', 'like', '%' . $destination . '%');
        }

        $tours = $query->paginate($perPage);

        foreach ($tours as $tour) {
            $tour->images = DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl')
                ->map(function ($image) {
                    return asset(str_replace('travela\\public\\', '', $image));
                })
                ->toArray();
        }

        return $tours;
    }
}
