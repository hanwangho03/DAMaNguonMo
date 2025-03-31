<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\Invoice;
use App\Models\User; // Đổi từ Users thành User

class AdminBookingController extends Controller
{
    // Hiển thị danh sách booking
    public function index()
    {   
        $bookings = Booking::with(['tour', 'user'])->orderBy('bookingDate', 'desc')->paginate(6);
        return view('admin.bookings.index', compact('bookings'));
    }

    // Cập nhật trạng thái booking
    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::findOrFail($id);
        $booking->bookingStatus = $request->input('bookingStatus');
        $booking->save();

        return redirect()->back()->with('success', 'Trạng thái booking đã được cập nhật.');
    }

    // Xóa booking
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->delete();

        return redirect()->back()->with('success', 'Booking đã được xóa.');
    }
}

