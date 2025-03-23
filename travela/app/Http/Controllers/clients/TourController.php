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
