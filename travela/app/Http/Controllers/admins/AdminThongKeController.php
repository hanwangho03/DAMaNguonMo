<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AdminThongKeController extends Controller
{
    public function showMostBookedTours()
{
    $mostBookedTours = DB::table('BOOKING')
        ->join('TOUR', 'BOOKING.tourId', '=', 'TOUR.tourId')
        ->select(
            'TOUR.tourId',
            'TOUR.titlle', 
            'TOUR.priceAdult',
            'TOUR.priceChild',
            'TOUR.startDate',
            DB::raw('COUNT(BOOKING.tourId) as booking_count')
        )
        ->groupBy('TOUR.tourId', 'TOUR.titlle', 'TOUR.priceAdult', 'TOUR.priceChild', 'TOUR.startDate')
        ->orderByDesc('booking_count')
        ->get();

    $tourData = $mostBookedTours->map(function ($tour) {
        return [
            'titlle' => $tour->titlle, 
            'booking_count' => $tour->booking_count
        ];
    })->toArray();

    return view('admin.stats_tours', compact('mostBookedTours', 'tourData'));
}
}
