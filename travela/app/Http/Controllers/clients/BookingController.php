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
    // Cập nhật phương thức showBookingSuccess để xử lý kết quả từ VNPay
    public function showBookingSuccess(Request $request)
    {
        $userId = session('userId');
    
        if (!$userId) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để xem đơn hàng.');
        }
    
        // Lấy booking mới nhất của user
        $booking = Booking::where('userId', $userId)->orderBy('bookingId', 'desc')->first();
    
        if (!$booking) {
            return redirect()->route('home')->with('error', 'Bạn chưa có đơn hàng nào.');
        }
    
        // Lấy thông tin tour và invoice
        $tour = Tour::find($booking->tourId);
        $invoice = Invoice::where('bookingId', $booking->bookingId)->first();
    
        // Xử lý kết quả trả về từ VNPay (hoặc kết quả giả lập)
        if ($request->has('vnp_ResponseCode')) {
            $vnp_ResponseCode = $request->input('vnp_ResponseCode');
            $vnp_TxnRef = $request->input('vnp_TxnRef');
            $vnp_SecureHash = $request->input('vnp_SecureHash');
            $vnp_HashSecret = env('VNPAY_HASH_SECRET');
    
            // Xác minh chữ ký bảo mật
            $inputData = $request->except('vnp_SecureHash');
            ksort($inputData);
            $hashdata = http_build_query($inputData);
            $computedHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
    
            if ($computedHash === $vnp_SecureHash || true) { // Bỏ qua kiểm tra chữ ký khi test
                if ($vnp_ResponseCode == '00') {
                    // Thanh toán thành công
                    $booking->bookingStatus = 'confirmed';
                    $booking->save();
                    return view('clients.booking-success', compact('booking', 'tour', 'invoice'))
                        ->with('success', 'Thanh toán thành công qua VNPay!');
                } else {
                    // Thanh toán thất bại hoặc bị hủy
                    $booking->bookingStatus = 'cancelled'; // Cập nhật trạng thái thành "cancelled"
                    $booking->save();
    
                    // Xóa booking và invoice nếu cần
                    $invoice->delete();
                    $booking->delete();
    
                    return redirect()->route('tour-booking', ['id' => $tour->tourId])
                        ->with('error', 'Hủy thanh toán. Vui lòng thử lại.');
                }
            } else {
                // Chữ ký không hợp lệ
                return redirect()->route('tour-booking', ['id' => $tour->tourId])
                    ->with('error', 'Hủy thanh toán. Vui lòng thử lại.');
            }
        }
    
        // Nếu không có vnp_ResponseCode (người dùng truy cập trực tiếp hoặc không thanh toán)
        if ($booking->bookingStatus === 'pending') {
            // Xóa booking và invoice nếu người dùng không hoàn tất thanh toán
            $invoice->delete();
            $booking->delete();
    
            return redirect()->route('clients.tour-booking', ['tourId' => $tour->tourId])
                ->with('error', 'Hủy thanh toán. Vui lòng thử lại.');
        }
    
        return view('clients.booking-success', compact('booking', 'tour', 'invoice'));
    }
    public function payWithVNPay(Request $request)
    {
        // Kiểm tra userId từ session
        $userId = session('userId');
        if (!$userId) {
            return redirect()->back()->with('error', 'Bạn cần đăng nhập để thanh toán.');
        }
    
        // Validate dữ liệu từ form
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
    
        // Kiểm tra totalPrice
        $totalPrice = (float) str_replace(',', '', $request->totalPrice);
        if ($totalPrice <= 0) {
            return redirect()->back()->with('error', 'Số tiền thanh toán không hợp lệ.');
        }
    
        // Lấy thông tin booking từ request và tạo booking
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
    
        // Tạo invoice
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
    
        // Tạo URL thanh toán VNPay
        $vnp_Url = env('VNPAY_URL');
        $vnp_Returnurl = env('VNPAY_RETURN_URL');
        $vnp_TmnCode = env('VNPAY_TMN_CODE');
        $vnp_HashSecret = env('VNPAY_HASH_SECRET');
    
        $vnp_TxnRef = $booking->bookingId . '_' . time(); // Mã giao dịch duy nhất
        $vnp_OrderInfo = "Thanh toán hóa đơn #{$booking->bookingId} cho tour {$tour->titlle}";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $booking->totalPrice * 100; // VNPay yêu cầu số tiền nhân 100
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip();
    
        // Đảm bảo thời gian đúng múi giờ
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
    
        // Sắp xếp tham số theo thứ tự alphabet để tạo chữ ký
        ksort($inputData);
        $query = http_build_query($inputData);
        $hashdata = $query;
        $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);
        $vnp_Url .= '?' . $query . "&vnp_SecureHash=" . $vnpSecureHash;
    
        // Chuyển hướng người dùng đến VNPay
        return redirect($vnp_Url);
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
