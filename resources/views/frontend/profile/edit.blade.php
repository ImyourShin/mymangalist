@extends('layouts.frontend')

@section('title', 'Edit Profile')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
<style>
/* ===== Tokens ===== */
:root{
  --primary-orange:#ff6b47;
  --primary-orange-light:#ff8e53;
  --dark-bg:#0f0f0f;
  --dark-bg-secondary:#1a1a1a;
  --dark-bg-tertiary:#242424;
  --text-primary:#ffffff;
  --text-muted:rgba(255,255,255,.6);
  --border-color:rgba(255,255,255,.1);
  --radius:20px;
  --shadow:0 10px 30px rgba(0,0,0,.4);
}

body{
  background:var(--dark-bg);
  font-family:'Poppins','Inter',sans-serif;
  color:var(--text-primary);
}

/* ===== Page Container ===== */
.profile-edit-wrapper {
  max-width:700px;
  margin:auto;
  padding:32px 20px;
  animation:fadeInUp .5s ease forwards;
  opacity:0; transform:translateY(20px);
}

/* ===== Card ===== */
.profile-card {
  background:var(--dark-bg-secondary);
  border:1px solid var(--border-color);
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  padding:28px;
  transition:.3s ease;
}
.profile-card:hover {
  transform:translateY(-2px);
  box-shadow:0 0 20px rgba(255,107,71,.35);
}
.profile-card h4 {
  font-size:1.5rem;
  font-weight:700;
  margin-bottom:1.5rem;
  position:relative;
  padding-left:16px;
}
.profile-card h4::before {
  content:'';
  position:absolute;
  left:0; top:50%;
  transform:translateY(-50%);
  width:6px; height:70%;
  border-radius:3px;
  background:linear-gradient(180deg,var(--primary-orange),var(--primary-orange-light));
}

/* ===== Avatar Section ===== */
.avatar-preview {
  text-align:center;
  margin-bottom:32px;
}
.avatar-preview img {
  width:120px; height:120px;
  border-radius:50%;
  border:3px solid transparent;
  background:linear-gradient(90deg,var(--primary-orange),var(--primary-orange-light)) border-box;
  padding:2px;
  animation:glowPulse 3s infinite ease-in-out;
  transition:.3s ease;
}
.avatar-preview img:hover {
  transform:scale(1.05);
  box-shadow:0 0 20px rgba(255,107,71,.45);
}
.avatar-preview .change-label {
  display:block;
  margin-top:8px;
  font-size:.85rem;
  color:var(--text-muted);
}

/* ===== Form ===== */
.form-label {
  color:var(--text-muted);
  font-size: 0.88rem;
  font-weight:500;
  letter-spacing: .2px;
  margin-bottom: 0.4rem;
}
.form-control {
  background:var(--dark-bg-tertiary);
  border:1px solid var(--border-color);
  border-radius:var(--radius);
  color:var(--text-primary);
  padding: .6rem 1rem;
  font-size: 0.95rem;

  height: 48px;
  transition:border .25s ease, box-shadow .25s ease;
}
.form-control::placeholder{color:var(--text-muted);}
.form-control:focus {
  border-color:var(--primary-orange);
  box-shadow:0 0 0 2px rgba(255,107,71,.5);
  outline:none;
}
.text-danger {
  color:#ff4d4d;
  font-size:.85rem;
  margin-top:4px;
  animation:slideDown .2s ease;
}

.mb-3 {
  margin-bottom: 1.4rem !important; /* ช่องไฟระหว่าง fields */
}

/* ===== Button ===== */
.btn-update {
  background:linear-gradient(90deg,var(--primary-orange),var(--primary-orange-light));
  border:none;
  border-radius:999px;
  font-weight:600;
  padding: .8rem 2rem;
  font-size: 1rem;
  color:#fff;
  min-width: 180px;
  position:relative;
  overflow:hidden;
  transition:.25s ease;
}
.btn-update:hover {
  box-shadow:0 0 16px rgba(255,107,71,.45);
  transform:translateY(-1px);
}
.btn-update:focus {
  outline:2px solid var(--primary-orange);
  outline-offset:2px;
}
.btn-update:active::after {
  content:'';
  position:absolute; left:50%; top:50%;
  width:10px; height:10px;
  background:rgba(255,255,255,.5);
  border-radius:50%;
  transform:translate(-50%,-50%) scale(0);
  animation:ripple .6s ease-out;
}
.d-flex.justify-content-end {
  justify-content: center !important; /* ปุ่มตรงกลาง */
}

/* File Input */
input[type="file"] {
  background: var(--dark-bg-tertiary);
  border: 1px solid var(--border-color);
  border-radius: var(--radius);
  color: var(--text-muted);
  padding: 3;
  font-size: .9rem;
}

input[type="file"]::file-selector-button {
  background: linear-gradient(90deg,var(--primary-orange),var(--primary-orange-light));
  border: none;
  border-radius: 999px;
  color: #fff;
  font-weight: 600;
  padding: .4rem 1rem;
  margin-right: 12px;
  cursor: pointer;
  transition: all .25s ease;
}

input[type="file"]::file-selector-button:hover {
  box-shadow: 0 0 10px rgba(255,107,71,.4);
  transform: translateY(-1px);
}

/* ===== Cancel Button ===== */
.btn-cancel {
  background: var(--dark-bg-tertiary);
  border: 1px solid var(--border-color);
  border-radius: 999px;
  font-weight: 600;
  padding: .8rem 2rem;
  font-size: 1rem;
  color: var(--text-muted);
  transition: all .25s ease;
}

.btn-cancel:hover {
  background: rgba(255,255,255,0.08);
  color: #fff;
  box-shadow: 0 0 10px rgba(255,107,71,.35);
  transform: translateY(-1px);
}

/* Animations */
@keyframes fadeInUp{to{opacity:1;transform:translateY(0);}}
@keyframes glowPulse{
  0%,100%{box-shadow:0 0 0 rgba(255,107,71,0);}
  50%{box-shadow:0 0 12px rgba(255,107,71,.6);}
}
@keyframes ripple{to{transform:translate(-50%,-50%) scale(2.5);opacity:0;}}
@keyframes slideDown{from{opacity:0;transform:translateY(-6px);}to{opacity:1;transform:translateY(0);}}

@media(max-width:768px){
  .profile-card{padding:20px;}
  .btn-update{width:100%;}
}
</style>
@endpush

@section('content')
<div class="profile-edit-wrapper">
  <div class="profile-card">
    <h4>Edit Profile</h4>

    <div class="avatar-preview">
      @if ($user->profile_img)
        <img src="{{ asset('storage/' . $user->profile_img) }}" alt="Profile Image">
      @else
        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->username) }}&background=ff6b47&color=fff" alt="Profile Avatar">
      @endif
      <span class="change-label"></span>
    </div>

    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Username</label>
        <input type="text" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
        @error('username') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        @error('name') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">New Password <span class="rgba(255,255,255,.6)">(leave blank to keep current)</span></label>
        <input type="password" name="password" class="form-control" placeholder="Enter new password">
        <input type="password" name="password_confirmation" class="form-control mt-2" placeholder="Confirm Password">
        @error('password') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Profile Image</label>
        <input type="file" name="profile_img" class="form-control">
        @error('profile_img') <div class="text-danger">{{ $message }}</div> @enderror
      </div>

      <div class="d-flex justify-content-center mt-4 gap-3">
        <button type="submit" class="btn btn-update">Update Profile</button>
        
        <a href="{{ route('profile.show') }}" class="btn btn-cancel">
            <i class="bi bi-x-circle"></i> Cancel
        </a>
    </div>         
  </div>
</div>
@endsection
