<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;

class AdminThongKeController extends Controller
{
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
