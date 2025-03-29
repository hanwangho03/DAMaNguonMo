<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class AdminCommentController extends Controller
{
    /**
     * Hiển thị danh sách tất cả các comment
     */
    public function index()
    {
        $reviews = Review::paginate(10); // Hoặc số bản ghi tuỳ ý
        return view('admin.comments', compact('reviews'));
    }

    /**
     * Ẩn hoặc hiển thị comment
     */
    public function toggle($id)
    {
        $review = Review::findOrFail($id);

        // Đảo trạng thái ẩn/hiện
        $review->hidden = $review->hidden == 1 ? 0 : 1;
        $review->save();

        return redirect()->route('admin.comments.index')->with('success', 'Cập nhật trạng thái thành công!');
    }

    /**
     * Xóa comment
     */
    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Xóa bình luận thành công!');
    }
}
