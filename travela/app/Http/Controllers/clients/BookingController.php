<?php

namespace App\Http\Controllers\clients;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Tour;
use App\Models\Users;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // Hiển thị form đặt tour
    public function showBookingForm($id)
{
    $tour = Tour::where('tourId', $id)->firstOrFail(); // Lấy thông tin tour từ ID
    
    // Lấy userId từ session
    $userId = session('userId'); 

    // Nếu user chưa đăng nhập, chuyển hướng về trang đăng nhập
    if (!$userId) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt tour.');
    }

    // Lấy thông tin user từ database
    $user = Users::where('userId', $userId)->first();

    return view('clients.tour-booking', compact('tour', 'user'));
}

    // Xử lý lưu booking vào database
    public function storeBooking(Request $request)
    {
        // Kiểm tra userId từ session
        $userId = session('userId');
        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt tour.');
        }
    
        // Tạo booking
        $booking = Booking::create([
            'tourId' => (int) $request->tourId,
            'userId' => (int) $userId,
            'bookingDate' => now(),
            'numAdult' => (int) $request->numAdult,
            'numChild' => (int) $request->numChild,
            'totalPrice' => (float) str_replace(',', '', $request->totalPrice),
            'bookingStatus' => 'pending',
            'email' => trim($request->email),
            'phoneNumber' => trim($request->phoneNumber),
            'address' => trim($request->address),
            'fullName' => trim($request->fullName)
        ]);
    
        // Lấy thông tin tour
        $tour = Tour::find($request->tourId);
    
        // Tạo invoice
        $invoice = Invoice::create([
            'bookingId' => $booking->bookingId, // Liên kết với booking vừa tạo
            'amount' => $booking->totalPrice, // Số tiền từ booking
            'dateIssued' => now(), // Ngày phát hành là thời điểm hiện tại
            'details' => "Hóa đơn cho booking tour {$tour->titlle} (Mã tour: {$tour->tourId})" // Chi tiết hóa đơn
        ]);
    
        // Trả về view booking-success với booking, tour và invoice
        return view('clients.booking-success', compact('booking', 'tour', 'invoice'))
            ->with('success', 'Đặt tour và tạo hóa đơn thành công!');
    }
    public function showInvoice($invoiceId)
    {
        $invoice = Invoice::findOrFail($invoiceId);
        return view('clients.invoice-detail', compact('invoice'));
    }
    public function showBookingSuccess(Request $request)
{
    // Lấy userId từ session
    $userId = session('userId');

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
    }

    // Lấy booking mới nhất của user
    $booking = Booking::where('userId', $userId)->orderBy('bookingId', 'desc')->first();

    // Kiểm tra nếu không có booking nào
    if (!$booking) {
        return redirect()->route('home')->with('error', 'Bạn chưa có đơn hàng nào.');
    }

    // Lấy thông tin tour
    $tour = Tour::find($booking->tourId);

    // Lấy thông tin hóa đơn
    $invoice = Invoice::where('bookingId', $booking->bookingId)->first();

    return view('clients.booking-success', compact('booking', 'tour', 'invoice'));
}
// Hiển thị danh sách tour đã đặt của người dùng
public function userBookings()
{
    $userId = session('userId'); // Lấy userId từ session

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem danh sách tour đã đặt.');
    }

    // Lấy danh sách tour mà người dùng đã đặt
    $bookings = Booking::where('booking.userId', $userId)
        ->join('tour', 'booking.tourId', '=', 'tour.tourId') 
        ->select(
            'booking.bookingId', 
            'booking.bookingDate', 
            'booking.numAdult', 
            'booking.numChild', 
            'booking.totalPrice', 
            'booking.bookingStatus', 
            'booking.fullName',     // Thêm trường fullName
            'booking.email',        // Thêm trường email
            'booking.phoneNumber',  // Thêm trường phoneNumber
            'booking.address',      // Thêm trường address
            'tour.titlle', 
            'tour.startDate', 
            'tour.priceAdult', 
            'tour.priceChild'
        )
        ->orderBy('booking.bookingDate', 'desc')
        ->get();

    return view('clients.user-bookings', compact('bookings'));
}
    
}
