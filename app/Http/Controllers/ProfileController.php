<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('frontend.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'username'    => 'required|min:3|unique:users,username,' . $user->user_id . ',user_id',
            'email'       => 'required|email|unique:users,email,' . $user->user_id . ',user_id',
            'name'        => 'nullable|string|max:100',
            'password'    => 'nullable|min:6|confirmed',
            'profile_img' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->route('profile.edit')
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'username' => strip_tags($request->username),
            'email'    => strip_tags($request->email),
            'name'     => strip_tags($request->name),
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_img')) {
            $path = $request->file('profile_img')->store('profiles', 'public');
            $data['profile_img'] = $path;
        }

        $user->update($data);

        Alert::success('อัปเดตโปรไฟล์สำเร็จ');
        return redirect()->route('profile.edit');
    }

    public function show()
    {
        // ✅ ต้องดึง user ก่อน
        $user = Auth::user()->loadCount(['favorites', 'reviews']);

        // ✅ ดึง favorites ของ user
        $favorites = \App\Models\FavoriteModel::with('manga')
            ->where('user_id', $user->user_id)
            ->latest('favorite_id')
            ->paginate(12);

        return view('frontend.profile.show', compact('user', 'favorites'));
    }
}
