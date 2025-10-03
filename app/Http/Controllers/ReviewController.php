<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\ReviewModel;
use App\Models\UserModel;
use App\Models\MangaModel;
use Illuminate\Pagination\Paginator;

class ReviewController extends Controller
{
    public function index()
    {
        Paginator::useBootstrap();
        $reviewList = ReviewModel::with(['user', 'manga'])
            ->orderBy('review_id', 'desc')
            ->paginate(8);

        return view('admin.reviews.list', compact('reviewList'));
    }

    public function adding()
    {
        $users = UserModel::all();
        $manga = MangaModel::all();
        return view('admin.reviews.create', compact('users', 'manga'));
    }



    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id'  => 'required|exists:users,user_id',
            'manga_id' => 'required|exists:manga,manga_id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('reviews.create')
                ->withErrors($validator)
                ->withInput();
        }

        ReviewModel::create($request->only(['user_id', 'manga_id', 'rating', 'comment']));

        Alert::success('เพิ่ม Review สำเร็จ');
        return redirect()->route('admin.reviews.list');
    }

    public function edit($id)
    {
        $review = ReviewModel::findOrFail($id);
        $users = UserModel::all();
        $manga = MangaModel::all();
        return view('admin.reviews.edit', compact('review', 'users', 'manga'));
    }

    public function update(Request $request, $id)
    {
        $review = ReviewModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'user_id'  => 'required|exists:users,user_id',
            'manga_id' => 'required|exists:manga,manga_id',
            'rating'   => 'required|integer|min:1|max:5',
            'comment'  => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.reviews.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $review->update($request->only(['user_id', 'manga_id', 'rating', 'comment']));

        Alert::success('อัปเดต Review สำเร็จ');
        return redirect()->route('admin.reviews.list');
    }

    public function remove($id)
    {
        $review = ReviewModel::findOrFail($id);
        $this->authorize('delete', $review); // ใช้ Policy เช็คสิทธิ์

        $review->delete();
        Alert::success('ลบ Review สำเร็จ');
        return redirect()->route('admin.reviews.list');
    }

    public function store(Request $request, $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,user_id',
            'rating'  => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500',
        ], [
            'rating.required' => 'กรุณาให้คะแนน',
            'rating.min'      => 'คะแนนต้องไม่น้อยกว่า 1',
            'rating.max'      => 'คะแนนต้องไม่เกิน 5',
        ]);

        $manga = MangaModel::findOrFail($id);

        ReviewModel::create([
            'user_id'  => $request->user_id,
            'manga_id' => $manga->manga_id,
            'rating'   => $request->rating,
            'comment'  => strip_tags($request->comment),
        ]);

        Alert::success('เพิ่มรีวิวสำเร็จ');
        return redirect()->route('manga.detail', $manga->manga_id);
    }
}