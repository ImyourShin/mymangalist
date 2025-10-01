<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\UserModel;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    // แสดง Users ทั้งหมด
    public function index()
    {
        Paginator::useBootstrap();
        $userList = UserModel::orderBy('user_id', 'desc')->paginate(5);
        return view('admin.users.list', compact('userList'));
    }

    // แสดงฟอร์ม Add
    public function adding()
    {
        return view('admin.users.create');
    }

    // Insert User ใหม่
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|unique:users,username',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,user',
            'status'   => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.adding')
                ->withErrors($validator)
                ->withInput();
        }

        $path = null;
        if ($request->hasFile('profile_img')) {
            $path = $request->file('profile_img')->store('users', 'public');
        }

        UserModel::create([
            'username'    => strip_tags($request->username),
            'password'    => bcrypt($request->password),
            'email'       => strip_tags($request->email),
            'name'        => strip_tags($request->name),
            'profile_img' => $path,
            'role'        => $request->role,
            'status'      => $request->status,
            'join_date'   => now()->toDateString(),
            'last_login'  => null,
        ]);

        Alert::success('เพิ่ม User สำเร็จ');
        return redirect()->route('admin.users.list');
    }

    // ฟอร์ม Edit
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    // Update User
    public function update(Request $request, $id)
    {
        $user = UserModel::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'username' => 'required|min:3|unique:users,username,' . $id . ',user_id',
            'email'    => 'required|email|unique:users,email,' . $id . ',user_id',
            'role'     => 'required|in:admin,user',
            'status'   => 'required|in:active,inactive'
        ]);

        if ($validator->fails()) {
            return redirect()->route('admin.users.edit', $id)
                ->withErrors($validator)
                ->withInput();
        }

        $data = [
            'username'    => strip_tags($request->username),
            'email'       => strip_tags($request->email),
            'name'        => strip_tags($request->name),
            'role'        => $request->role,
            'status'      => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('profile_img')) {
            // ลบไฟล์เก่าออกก่อน (ถ้ามี)
            if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
                Storage::disk('public')->delete($user->profile_img);
            }
            $data['profile_img'] = $request->file('profile_img')->store('users', 'public');
        }

        $user->update($data);

        Alert::success('อัปเดต User สำเร็จ');
        return redirect()->route('admin.users.list');
    }

    // Delete User
    public function remove($id)
    {
        $user = UserModel::findOrFail($id);

        if ($user->profile_img && Storage::disk('public')->exists($user->profile_img)) {
            Storage::disk('public')->delete($user->profile_img);
        }

        $user->delete();
        Alert::success('ลบ User สำเร็จ');
        return redirect()->route('admin.users.list');
    }
}
