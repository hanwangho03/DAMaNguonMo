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
                return asset(str_replace('travela\\public\\', '', $image));
            })
            ->toArray();
    }

    return $allTours;
}
        public function getTourDetail($id)
        {
            $tour = self::where('tourId', $id)->first();
        
            if ($tour) {
                $tour->images = DB::table('images')
                    ->where('tourId', $tour->tourId)
                    ->limit(5)
                    ->pluck('imageUrl')
                    ->map(function ($image) {
                        return asset(str_replace('travela\\public\\', '', $image));
                    });
        
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
             ->where('reviews.hidden', 0)
             ->orderBy('reviews.timestamp', 'desc')
             ->select('reviews.comment', 'reviews.timestamp', 'user.userName')
             ->get();
     }
 
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
                    return str_replace('travela\public\\', '', $image);
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
    
        $data['images'] = !empty($data['images']) ? json_decode($data['images'], true) : [];
    
        $filteredData = array_intersect_key($data, array_flip($validColumns));
    
        $filteredData['images'] = !empty($data['images']) ? $data['images'][0] : null;
    
        $tourID = DB::table($this->table)->insertGetId($filteredData);
    
        if (!empty($data['images']) && count($data['images']) > 1) {
            foreach (array_slice($data['images'], 1) as $image) {
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
        $validColumns = [
            'titlle', 'description', 'images', 'quantity', 'priceAdult',
            'priceChild', 'destination', 'availability', 'itinerary',
            'reviews', 'startDate', 'endDate'
        ];
        $data['images'] = !empty($data['images']) ? json_decode($data['images'], true) : [];
    
        $filteredData = array_intersect_key($data, array_flip($validColumns));
        $existingTour = DB::table($this->table)->where('tourId', $id)->first();
        if (!$existingTour) {
            return false;
        }
    
        $existingImages = json_decode($existingTour->images, true) ?? [];
        $newImages = !empty($data['images']) 
            ? (is_array($data['images']) ? $data['images'] : json_decode($data['images'], true)) 
            : [];

        if (!empty($newImages)) {
            $filteredData['images'] = json_encode([$newImages[0]]);
        } else {
            $filteredData['images'] = json_encode($existingImages);
        }

    
        if (empty($filteredData)) {
            return false; 
        }
    
        $updatedRows = DB::table($this->table)
            ->where('tourId', $id)
            ->update($filteredData);
    
        if (!empty($newImages)) {
            DB::table($this->table_tour_images)->where('tourId', $id)->delete(); 
        
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
    
        return $updatedRows; 
    }
    
    

    public function getTourById($id) {
        $tour = DB::table($this->table)
            ->where('tourId', $id)
            ->first(); 
    
        if ($tour) {
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
        $destinations = DB::table($this->table)
            ->select('destination')
            ->where('availability', 1)
            ->groupBy('destination')
            ->limit($limit)
            ->get();
    
        foreach ($destinations as $destination) {
            $tour = DB::table($this->table)
                ->where('destination', $destination->destination)
                ->where('availability', 1)
                ->first();
    
            if ($tour) {
                $destination->tourId = $tour->tourId; 
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
