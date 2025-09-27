<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReviewModel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;

class FrontendReviewController extends Controller
{
    public function store(Request $request, $manga_id)
    {
        $validator = Validator::make($request->all(), [
            'rating'  => 'required|integer|min:1|max:10',
            'comment' => 'nullable|string|max:1000',
        ]);

        if ($validator->fails()) {
            return redirect()->route('manga.detail', $manga_id)
                ->withErrors($validator)
                ->withInput();
        }

        ReviewModel::create([
            'user_id'  => Auth::id(),
            'manga_id' => $manga_id,
            'rating'   => $request->rating,
            'comment'  => $request->comment,
        ]);

        Alert::success('Review added successfully');
        return redirect()->route('manga.detail', $manga_id);
    }
    public function edit($id)
    {
        $review = ReviewModel::findOrFail($id);

        // ใช้ Policy เช็คสิทธิ์ (admin = แก้ได้ทุกอัน, user = แก้ได้ของตัวเอง)
        $this->authorize('update', $review);

        return view('frontend.reviews.edit', compact('review'));
    }

    public function update(Request $request, $id)
    {
        $review = ReviewModel::findOrFail($id);

        $this->authorize('update', $review);

        $request->validate([
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $review->update([
            'rating'  => $request->rating,
            'comment' => strip_tags($request->comment),
        ]);

        return redirect()->route('manga.detail', $review->manga_id)
            ->with('success', 'รีวิวถูกอัปเดตเรียบร้อยแล้ว');
    }


    public function remove($id)
    {
        $review = ReviewModel::findOrFail($id);

        // ใช้ Policy ตรวจสิทธิ์ (admin = ลบได้ทุกอัน, user = ลบได้เฉพาะของตัวเอง)
        $this->authorize('delete', $review);

        $review->delete();

        return back()->with('success', 'ลบรีวิวสำเร็จ');
    }
}
