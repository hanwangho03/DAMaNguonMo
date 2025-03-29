<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
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
    public function thongKeDoanhThu()
    {
        // Truy vấn tổng doanh thu theo tháng
        $doanhThuTheoThang = Invoice::select(
                DB::raw("DATE_FORMAT(dateIssued, '%Y-%m') as thang"),
                DB::raw("SUM(amount) as tong_doanh_thu")
            )
            ->groupBy('thang')
            ->orderBy('thang', 'asc')
            ->get();

        // Tách ra mảng tháng và doanh thu để truyền sang view
        $labels = $doanhThuTheoThang->pluck('thang');
        $data = $doanhThuTheoThang->pluck('tong_doanh_thu');

        return view('admin.thongke.doanhthu_pie_chart', compact('labels', 'data'));
    }
}
