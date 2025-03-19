<?php

namespace App\Http\Controllers\clients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;
use Illuminate\Support\Facades\Session;
class TourDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $tourModel = new Tour();
        $tourDetail = $tourModel->getTourDetail($id);

        if (!$tourDetail) {
            return abort(404);
        }

        // Lấy danh sách đánh giá của tour
        $reviews = $this->getReviews($id);

        // Debug để kiểm tra dữ liệu (nếu cần)
        // dd($tourDetail, $reviews);

        // Trả về view với cả tourDetail và reviews
        return view("clients.tour-details", compact("tourDetail", "reviews"));
    }
public function getReviews($id)
    {
        $tour = new Tour();
        return $tour->getReviewsForTour($id); // Gọi hàm từ model
    }
public function addReview(Request $request, $id)
    {
        $userId = session('userId');
        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Bạn cần đăng nhập để đánh giá.'
            ], 401);
        }

        $tour = new Tour();
        $tour->addReview($id, $userId, $request->comment);

        return response()->json([
            'success' => true,
            'message' => 'Đánh giá của bạn đã được gửi!'
        ]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
