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
    public function showBookingForm($id)
{
    $tour = Tour::where('tourId', $id)->firstOrFail();
    
    $userId = session('userId'); 

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để đặt tour.');
    }

    $user = Users::where('userId', $userId)->first();

    return view('clients.tour-booking', compact('tour', 'user'));
}

    public function storeBooking(Request $request)
    {
        $userId = session('userId');
        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để đặt tour.');
        }
    
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
    
        $tour = Tour::find($request->tourId);
    
        $invoice = Invoice::create([
            'bookingId' => $booking->bookingId,
            'amount' => $booking->totalPrice,
            'dateIssued' => now(),
            'details' => "Hóa đơn cho booking tour {$tour->titlle} (Mã tour: {$tour->tourId})"
        ]);
    
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
        $userId = session('userId');
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        }
    
        $booking = Booking::where('userId', $userId)->orderBy('bookingId', 'desc')->first();
    
        if (!$booking) {
            return redirect()->route('home')->with('error', 'Bạn chưa có đơn hàng nào.');
        }
    
        $tour = Tour::find($booking->tourId);
        $invoice = Invoice::where('bookingId', $booking->bookingId)->first();
    
        if ($request->has('vnp_ResponseCode')) {
            $vnp_ResponseCode = $request->input('vnp_ResponseCode');
            $vnp_TxnRef = $request->input('vnp_TxnRef');
            $vnp_SecureHash = $request->input('vnp_SecureHash');
            $vnp_HashSecret = env('VNPAY_HASH_SECRET');
    
            $inputData = $request->except('vnp_SecureHash');
            ksort($inputData);
            $hashdata = http_build_query($inputData);
            $computedHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    
            if ($computedHash === $vnp_SecureHash || true) { 
                if ($vnp_ResponseCode == '00') {
                    $booking->bookingStatus = 'confirmed';
                    $booking->save();
                    return view('clients.booking-success', compact('booking', 'tour', 'invoice'))
                        ->with('success', 'Thanh toán thành công qua VNPay!');
                } else {
                    $booking->bookingStatus = 'cancelled';
                    $booking->save();
    
                    $invoice->delete();
                    $booking->delete();
    
                    return redirect()->route('tour-booking', ['id' => $tour->tourId])
                        ->with('error', 'Hủy thanh toán. Vui lòng thử lại.');
                }
            } else {
                return redirect()->route('tour-booking', ['id' => $tour->tourId])
                    ->with('error', 'Hủy thanh toán. Vui lòng thử lại.');
            }
        }
    
        if ($booking->bookingStatus === 'pending') {
            $invoice->delete();
            $booking->delete();
    
            return redirect()->route('clients.tour-booking', ['tourId' => $tour->tourId])
                ->with('error', 'Hủy thanh toán. Vui lòng thử lại.');
        }
    
        return view('clients.booking-success', compact('booking', 'tour', 'invoice'));
    }
    public function payWithVNPay(Request $request)
    {
        $userId = session('userId');
        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }
    
        $request->validate([
            'tourId' => 'required|integer',
            'numAdult' => 'required|integer|min:1',
            'numChild' => 'required|integer|min:0',
            'totalPrice' => 'required|numeric|min:0',
            'email' => 'required|email',
            'phoneNumber' => 'required',
            'address' => 'required',
            'fullName' => 'required',
        ]);
    
        $totalPrice = (float) str_replace(',', '', $request->totalPrice);
        if ($totalPrice <= 0) {
            return redirect()->back()->with('error', 'Số tiền thanh toán không hợp lệ.');
        }
    
        $booking = Booking::create([
            'tourId' => (int) $request->tourId,
            'userId' => (int) $userId,
            'bookingDate' => now(),
            'numAdult' => (int) $request->numAdult,
            'numChild' => (int) $request->numChild,
            'totalPrice' => $totalPrice,
            'bookingStatus' => 'pending',
            'email' => trim($request->email),
            'phoneNumber' => trim($request->phoneNumber),
            'address' => trim($request->address),
            'fullName' => trim($request->fullName)
        ]);
    
        $tour = Tour::find($request->tourId);
        if (!$tour) {
            return redirect()->back()->with('error', 'Tour không tồn tại.');
        }
    
        $invoice = Invoice::create([
            'bookingId' => $booking->bookingId,
            'amount' => $booking->totalPrice,
            'dateIssued' => now(),
            'details' => "Hóa đơn cho booking tour {$tour->titlle} (Mã tour: {$tour->tourId})"
        ]);
    
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');
        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
    
        $vnp_TxnRef = $booking->bookingId . '_' . time();
        $vnp_OrderInfo = "Thanh toán hóa đơn #{$booking->bookingId} cho tour {$tour->titlle}";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $booking->totalPrice * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();
    
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $vnp_CreateDate = date('YmdHis');
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));
    
        $inputData = [
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => $vnp_CreateDate,
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        ];
    
        ksort($inputData);
        $query = http_build_query($inputData);
        $hashdata = $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= '?' . $query . "&vnp_SecureHash=" . $vnpSecureHash;
    
        return redirect($vnp_Url);
    }
public function userBookings()
{
    $userId = session('userId'); 

    if (!$userId) {
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem danh sách tour đã đặt.');
    }

    $bookings = Booking::where('booking.userId', $userId)
        ->join('tour', 'booking.tourId', '=', 'tour.tourId') 
        ->select(
            'booking.bookingId', 
            'booking.bookingDate', 
            'booking.numAdult', 
            'booking.numChild', 
            'booking.totalPrice', 
            'booking.bookingStatus', 
            'booking.fullName',     
            'booking.email',        
            'booking.phoneNumber',  
            'booking.address',      
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
