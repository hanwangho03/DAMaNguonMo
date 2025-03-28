<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log; // Thêm dòng này vào đầu file nếu chưa có

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tourModel = new Tour();
        $destination = $request->query('destination');

        if ($destination) {
            $tours = $tourModel->searchToursByDestination($destination);
        } else {
            $tours = $tourModel->getAllTours();
        }

        return view('clients.tours', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create_tour');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        Log::info('Received request:', $request->all());

        if ($request->isMethod('get')) {
            Log::error('Request bị gửi dưới dạng GET thay vì POST');
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        if (!$request->has('_token')) {
            Log::error('CSRF Token không tồn tại!');
            return response()->json(['error' => 'CSRF token missing'], 419);
        }

        // Sử dụng Validator::make() thay vì $request->validate()
        $request->validate([
            'titlle'        => 'required|string|max:255',
            'description'   => 'required|string',
            'images'        => 'required|array|min:1',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity'      => 'required|integer|min:1',
            'priceAdult'    => 'required|numeric|min:0',
            'priceChild'    => 'required|numeric|min:0',
            'destination'   => 'required|string|max:255',
            'availability'  => 'required|in:on,off',
            'itinerary'     => 'required|string|max:255',
            'reviews'       => 'nullable|string|max:255',
            'startDate'     => 'required|date|after_or_equal:today',
            'endDate'       => 'required|date|after:startDate'
        ], [
            'titlle.required'       => 'Tiêu đề không được để trống!',
            'titlle.string'         => 'Tiêu đề phải là chuỗi!',
            'titlle.max'            => 'Tiêu đề không được vượt quá 255 ký tự!',
            'description.required'  => 'Mô tả không được để trống!',
            'description.string'    => 'Mô tả phải là chuỗi!',
            'images.required'       => 'Bạn cần tải lên ít nhất một ảnh!',
            'images.array'          => 'Dữ liệu ảnh không hợp lệ!',
            'images.min'            => 'Bạn cần tải lên ít nhất một ảnh!',
            'images.*.image'        => 'Tệp tải lên phải là hình ảnh!',
            'images.*.mimes'        => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg!',
            'images.*.max'          => 'Kích thước ảnh không được vượt quá 2MB!',
            'quantity.required'     => 'Số lượng không được để trống!',
            'quantity.integer'      => 'Số lượng phải là số nguyên!',
            'quantity.min'          => 'Số lượng ít nhất phải là 1!',
            'priceAdult.required'   => 'Giá vé người lớn không được để trống!',
            'priceAdult.numeric'    => 'Giá vé người lớn phải là số!',
            'priceAdult.min'        => 'Giá vé người lớn không thể âm!',
            'priceChild.required'   => 'Giá vé trẻ em không được để trống!',
            'priceChild.numeric'    => 'Giá vé trẻ em phải là số!',
            'priceChild.min'        => 'Giá vé trẻ em không thể âm!',
            'destination.required'  => 'Điểm đến không được để trống!',
            'destination.string'    => 'Điểm đến phải là chuỗi!',
            'destination.max'       => 'Điểm đến không được vượt quá 255 ký tự!',
            'availability.required' => 'Trạng thái còn chỗ là bắt buộc!',
            'availability.in'       => 'Trạng thái chỉ có thể là "on" hoặc "off"!',
            'itinerary.required'    => 'Lịch trình không được để trống!',
            'itinerary.string'      => 'Lịch trình phải là chuỗi!',
            'itinerary.max'         => 'Lịch trình không được vượt quá 255 ký tự!',
            'reviews.string'        => 'Đánh giá phải là chuỗi!',
            'reviews.max'           => 'Đánh giá không được vượt quá 255 ký tự!',
            'startDate.required'    => 'Ngày bắt đầu không được để trống!',
            'startDate.date'        => 'Ngày bắt đầu không hợp lệ!',
            'startDate.after_or_equal' => 'Ngày bắt đầu phải từ hôm nay trở đi!',
            'endDate.required'      => 'Ngày kết thúc không được để trống!',
            'endDate.date'          => 'Ngày kết thúc không hợp lệ!',
            'endDate.after'         => 'Ngày kết thúc phải sau ngày bắt đầu!'
        ]);
        

        // if ($validator->fails()) {
        //     Log::error('Lỗi validate:', $validator->errors()->toArray());
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        Log::info('Dữ liệu hợp lệ, tiếp tục xử lý ảnh');

        // Xử lý upload ảnh
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $destinationPath = public_path('clients/assets/images/gallery-tours');
            Log::info('Đường dẫn thư mục: ' . $destinationPath);

            // Kiểm tra hoặc tạo thư mục
            if (!file_exists($destinationPath) && !mkdir($destinationPath, 0777, true) && !is_dir($destinationPath)) {
                Log::error('Không thể tạo thư mục: ' . $destinationPath);
                return response()->json(['error' => 'Không thể tạo thư mục'], 500);
            }

            Log::info('Danh sách ảnh nhận được:', [$request->file('images')]);

            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $destinationPath . '/' . $fileName;

                if ($image->move($destinationPath, $fileName)) {
                    $imagePaths[] = 'clients/assets/images/gallery-tours/'.$fileName;
                    Log::info('Lưu thành công: ' . $filePath);
                } else {
                    Log::error('Lỗi khi lưu file: ' . $filePath);
                }
            }
        } else {
            Log::error('Không nhận được file upload');
        }

        Log::info('Danh sách ảnh đã lưu:', $imagePaths);

        // Lưu dữ liệu vào database
        $dataInsert = [
            'titlle'        => $request->titlle,
            'description'   => $request->description,
            'images'        => !empty($imagePaths) ? implode(',', $imagePaths) : null,
            'quantity'      => (int) $request->quantity,
            'priceAdult'    => (float) $request->priceAdult,
            'priceChild'    => (float) $request->priceChild,
            'destination'   => $request->destination,
            'availability'  => $request->availability === 'on' ? 1 : 0,
            'itinerary'     => $request->itinerary,
            'reviews'       => $request->reviews ?? null,
            'startDate'     => $request->startDate,
            'endDate'       => $request->endDate,
            'images'        => !empty($imagePaths) ? json_encode($imagePaths) : json_encode([])
        ];

        $tourModel = new Tour();
        $tourModel->createTour($dataInsert);

        Log::info('Tour đã được thêm thành công:', $dataInsert);

        return redirect()->route('admin.tours')->with('success', 'Tour đã được thêm thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tourModel = new Tour();
        $tour = $tourModel->getTourById($id);
        return view('admin.edit_tour', compact('tour'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Log::info('Nhận request cập nhật tour:', $request->all());

        if ($request->isMethod('get')) {
            Log::error('Request bị gửi dưới dạng GET thay vì PUT');
            return response()->json(['error' => 'Method not allowed'], 405);
        }

        $request->validate([
            'titlle'        => 'required|string|max:255',
            'description'   => 'required|string',
            'images.*'      => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'quantity'      => 'required|integer|min:1',
            'priceAdult'    => 'required|numeric|min:0',
            'priceChild'    => 'required|numeric|min:0',
            'destination'   => 'required|string|max:255',
            'availability'  => 'required|in:on,off',
            'itinerary'     => 'required|string|max:255',
            'reviews'       => 'nullable|string|max:255',
            'startDate'     => 'required|date|after_or_equal:today',
            'endDate'       => 'required|date|after:startDate'
        ], [
            'titlle.required'       => 'Tiêu đề không được để trống!',
            'titlle.string'         => 'Tiêu đề phải là chuỗi!',
            'titlle.max'            => 'Tiêu đề không được vượt quá 255 ký tự!',
            'description.required'  => 'Mô tả không được để trống!',
            'description.string'    => 'Mô tả phải là chuỗi!',
            'images.*.image'        => 'Tệp tải lên phải là hình ảnh!',
            'images.*.mimes'        => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif hoặc svg!',
            'images.*.max'          => 'Kích thước ảnh không được vượt quá 2MB!',
            'quantity.required'     => 'Số lượng không được để trống!',
            'quantity.integer'      => 'Số lượng phải là số nguyên!',
            'quantity.min'          => 'Số lượng ít nhất phải là 1!',
            'priceAdult.required'   => 'Giá vé người lớn không được để trống!',
            'priceAdult.numeric'    => 'Giá vé người lớn phải là số!',
            'priceAdult.min'        => 'Giá vé người lớn không thể âm!',
            'priceChild.required'   => 'Giá vé trẻ em không được để trống!',
            'priceChild.numeric'    => 'Giá vé trẻ em phải là số!',
            'priceChild.min'        => 'Giá vé trẻ em không thể âm!',
            'destination.required'  => 'Điểm đến không được để trống!',
            'destination.string'    => 'Điểm đến phải là chuỗi!',
            'destination.max'       => 'Điểm đến không được vượt quá 255 ký tự!',
            'availability.required' => 'Trạng thái còn chỗ là bắt buộc!',
            'availability.in'       => 'Trạng thái chỉ có thể là "on" hoặc "off"!',
            'itinerary.required'    => 'Lịch trình không được để trống!',
            'itinerary.string'      => 'Lịch trình phải là chuỗi!',
            'itinerary.max'         => 'Lịch trình không được vượt quá 255 ký tự!',
            'reviews.string'        => 'Đánh giá phải là chuỗi!',
            'reviews.max'           => 'Đánh giá không được vượt quá 255 ký tự!',
            'startDate.required'    => 'Ngày bắt đầu không được để trống!',
            'startDate.date'        => 'Ngày bắt đầu không hợp lệ!',
            'startDate.after_or_equal' => 'Ngày bắt đầu phải từ hôm nay trở đi!',
            'endDate.required'      => 'Ngày kết thúc không được để trống!',
            'endDate.date'          => 'Ngày kết thúc không hợp lệ!',
            'endDate.after'         => 'Ngày kết thúc phải sau ngày bắt đầu!'
        ]);
        

        // if ($validator->fails()) {
        //     Log::error('Lỗi validate:', $validator->errors()->toArray());
        //     return response()->json(['errors' => $validator->errors()], 422);
        // }

        Log::info('Dữ liệu hợp lệ, bắt đầu cập nhật tour');

        $tourModel = new Tour();
        $tour = $tourModel->getTourById($id);
        if (!$tour) {
            Log::error('Không tìm thấy tour với ID: ' . $id);
            return response()->json(['error' => 'Tour không tồn tại'], 404);
        }

        // Xử lý upload ảnh mới nếu có
        $imagePaths = [];
        if ($request->hasFile('images')) {
            $destinationPath = public_path('clients/assets/images/gallery-tours');
            Log::info('Đường dẫn thư mục: ' . $destinationPath);

            // Kiểm tra hoặc tạo thư mục
            if (!file_exists($destinationPath) && !mkdir($destinationPath, 0777, true) && !is_dir($destinationPath)) {
                Log::error('Không thể tạo thư mục: ' . $destinationPath);
                return response()->json(['error' => 'Không thể tạo thư mục'], 500);
            }

            Log::info('Danh sách ảnh nhận được:', [$request->file('images')]);

            foreach ($request->file('images') as $image) {
                $fileName = time().'_'.$image->getClientOriginalName();
                $filePath = $destinationPath . '/' . $fileName;

                if ($image->move($destinationPath, $fileName)) {
                    $imagePaths[] = 'clients/assets/images/gallery-tours/'.$fileName;
                    Log::info('Lưu thành công: ' . $filePath);
                } else {
                    Log::error('Lỗi khi lưu file: ' . $filePath);
                }
            }
        }

        Log::info('Danh sách ảnh sau cập nhật:', $imagePaths);
        Log::info('Danh sách ảnh kiểm tra json:', ['images' => !empty($imagePaths) ? $imagePaths : []]);

        // Cập nhật dữ liệu
        $dataUpdate = [
            'titlle'        => $request->titlle,
            'description'   => $request->description,
            'quantity'      => (int) $request->quantity,
            'priceAdult'    => (float) $request->priceAdult,
            'priceChild'    => (float) $request->priceChild,
            'destination'   => $request->destination,
            'availability'  => $request->availability === 'on' ? 1 : 0,
            'itinerary'     => $request->itinerary,
            'reviews'       => $request->reviews ?? null,
            'startDate'     => $request->startDate,
            'endDate'       => $request->endDate,
            'images'        => !empty($imagePaths) ? json_encode($imagePaths) : json_encode([])
        ];

        $tourModel->editTour($dataUpdate, $id);

        Log::info('Tour đã được cập nhật thành công:', $dataUpdate);

        return redirect()->route('admin.tours')->with('success', 'Tour đã được cập nhật thành công!');
    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tourModel = new Tour();
        $tours = $tourModel->getTourById($id);
        if($tours)
            $tours = $tourModel->deleteTour($id);
        return redirect()->route('admin.tours')->with('success', 'Tour đã được xóa thành công!');
    }
}
