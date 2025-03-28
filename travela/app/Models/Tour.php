<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tour extends Model
{
    protected $table =  'tour';
    protected $table_tour_images = 'images';
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
             ->where('reviews.hidden', 0) // Thêm điều kiện này
             ->orderBy('reviews.timestamp', 'desc')
             ->select('reviews.comment', 'reviews.timestamp', 'user.userName')
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

    // Admin
    public function getAllTours_Admin($perPage = 4){
        $allTours = DB::table($this->table)
            ->orderByDesc('availability')
            ->paginate($perPage);

        foreach ($allTours as $tour) {
            $tour->images = DB::table('images')
                ->where('tourId', $tour->tourId)
                ->pluck('imageURL')
                ->map(function ($image) {
                    return str_replace('travela\public\\', '', $image); // Chỉ giữ phần sau "public/"
                });
        }

        return $allTours;
    }

    public function createTour($data) {
        $validColumns = [
            'titlle', 'description', 'images', 'quantity', 'priceAdult',
            'priceChild', 'destination', 'availability', 'itinerary',
            'reviews', 'startDate', 'endDate'
        ];
    
        // Giải mã JSON nếu có dữ liệu ảnh
        $data['images'] = !empty($data['images']) ? json_decode($data['images'], true) : [];
    
        // Lọc dữ liệu đầu vào
        $filteredData = array_intersect_key($data, array_flip($validColumns));
    
        // Lấy ảnh đầu tiên (nếu có) để lưu vào cột `images`
        $filteredData['images'] = !empty($data['images']) ? $data['images'][0] : null;
    
        // Chèn dữ liệu vào bảng `tour`
        $tourID = DB::table($this->table)->insertGetId($filteredData);
    
        // Lưu tất cả ảnh vào bảng `tour_images`
        if (!empty($data['images']) && count($data['images']) > 1) {
            foreach (array_slice($data['images'], 1) as $image) { // Bỏ ảnh đầu tiên
                DB::table($this->table_tour_images)->insert([
                    'tourId'      => $tourID,
                    'imageURL'    => $image,
                    'uploadDate'  => now(),
                ]);
            }
        }
        return $tourID;
    }
    
    

    public function editTour($data, $id) {
        // Danh sách các cột hợp lệ trong bảng `tour`
        $validColumns = [
            'titlle', 'description', 'images', 'quantity', 'priceAdult',
            'priceChild', 'destination', 'availability', 'itinerary',
            'reviews', 'startDate', 'endDate'
        ];
        // Giải mã JSON nếu có dữ liệu ảnh
        $data['images'] = !empty($data['images']) ? json_decode($data['images'], true) : [];
    
        // Lọc dữ liệu đầu vào
        $filteredData = array_intersect_key($data, array_flip($validColumns));
        // Lấy dữ liệu hiện tại của tour
        $existingTour = DB::table($this->table)->where('tourId', $id)->first();
        if (!$existingTour) {
            return false; // Không tìm thấy tour
        }
    
        // Giữ lại ảnh cũ nếu không có ảnh mới
        $existingImages = json_decode($existingTour->images, true) ?? [];
        $newImages = !empty($data['images']) 
            ? (is_array($data['images']) ? $data['images'] : json_decode($data['images'], true)) 
            : [];

        if (!empty($newImages)) {
            // Lấy ảnh đầu tiên nếu có ảnh mới
            $filteredData['images'] = json_encode([$newImages[0]]);
        } else {
            // Giữ nguyên danh sách ảnh cũ
            $filteredData['images'] = json_encode($existingImages);
        }

    
        // Kiểm tra nếu không có dữ liệu hợp lệ để cập nhật
        if (empty($filteredData)) {
            return false; // Không có dữ liệu để cập nhật
        }
    
        // Cập nhật dữ liệu trong bảng `tour`
        $updatedRows = DB::table($this->table)
            ->where('tourId', $id)
            ->update($filteredData);
    
        // Nếu có ảnh mới, cập nhật bảng `images`
        if (!empty($newImages)) {
            DB::table($this->table_tour_images)->where('tourId', $id)->delete(); // Xóa ảnh cũ
        
            // Bỏ ảnh đầu tiên trong danh sách
            $filteredImages = array_slice($newImages, 1);
        
            foreach ($filteredImages as $image) {
                DB::table($this->table_tour_images)->insert([
                    'tourId' => $id,
                    'imageURL' => $image,
                    'description' => 'No description',
                    'uploadDate' => now()
                ]);
            }
        }        
    
        return $updatedRows; // Trả về số dòng đã cập nhật
    }
    
    

    public function getTourById($id) {
        $tour = DB::table($this->table)
            ->where('tourId', $id)
            ->first(); // Lấy một bản ghi
    
        if ($tour) {
            // Lấy danh sách hình ảnh từ bảng `images`
            $tour->images = DB::table($this->table_tour_images)
                ->where('tourId', $tour->tourId)
                ->pluck('imageUrl')
                ->map(function ($image) {
                    return asset(str_replace('travela/public/', '', $image));
                })->toArray();
        }
    
        return $tour;
    }
    

    public function deleteTour($id)
    {
        return DB::table($this->table)->where('tourId', $id)->update([
            'availability' => false
        ]);
    }
    public function getPopularDestinations($limit = 6)
    {
        // Lấy danh sách destinations duy nhất từ bảng tour
        $destinations = DB::table($this->table)
            ->select('destination')
            ->where('availability', 1)
            ->groupBy('destination')
            ->limit($limit)
            ->get();
    
        // Thêm thông tin tourId, ảnh và số lượng tours
        foreach ($destinations as $destination) {
            $tour = DB::table($this->table)
                ->where('destination', $destination->destination)
                ->where('availability', 1)
                ->first();
    
            if ($tour) {
                $destination->tourId = $tour->tourId; // Thêm tourId
                $destination->image = DB::table('images')
                    ->where('tourId', $tour->tourId)
                    ->pluck('imageUrl')
                    ->map(function ($image) {
                        return asset(str_replace('travela\\public\\', '', $image));
                    })
                    ->first();
                $destination->tourCount = DB::table($this->table)
                    ->where('destination', $destination->destination)
                    ->where('availability', 1)
                    ->count();
            } else {
                $destination->tourId = null;
                $destination->image = asset('clients/assets/images/destinations/default.jpg');
                $destination->tourCount = 0;
            }
        }
    
        return $destinations;
    }
}
