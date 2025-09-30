@extends('layouts.frontend')

@section('content')
    <!-- Video Background -->
    <div class="video-background">
        <video autoplay muted loop>
            <source src="/videos/bg_video.mp4" type="video/mp4">
            <!-- Fallback for browsers that don't support video -->
            Your browser does not support the video tag.
        </video>
        <div class="video-overlay"></div>
    </div>

    <div class="login-container">
        <!-- Form Section -->
        <div class="login-left">
            <a href="{{ route('frontend.home') }}" class="home-link">
                <i class="fas fa-home"></i>
            </a>

            <div class="form-wrapper">
                <h1 class="login-title">SIGN IN</h1>

                @if ($errors->any())
                    <div class="alert alert-custom">
                        @foreach ($errors->all() as $error)
                            <div><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form action="{{ route('login.attempt') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email" class="form-control form-control-custom" name="email" placeholder="Email"
                            value="{{ old('email') }}" required>
                    </div>

                    <div class="form-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control form-control-custom" name="password"
                            placeholder="Password" required>
                    </div>

                    <button type="submit" class="login-btn">
                        <i class="fas fa-sign-in-alt me-2"></i>SIGN IN
                    </button>
                </form>

                <div class="signup-link">
                    Don't have an account? <a href="{{ route('register') }}">Sign Up</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-wrapper {
            max-width: 400px;
            width: 100%;
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.1);
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #ffffff;
            padding: 16px 18px 16px 50px;
            font-size: 15px;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            width: 100%;
            height: 52px;
        }

        .form-control-custom:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #ff6b47;
            box-shadow: 0 0 15px rgba(255, 107, 71, 0.3);
            color: #ffffff;
            outline: none;
        }

        .form-control-custom::placeholder {
            color: rgba(255, 255, 255, 0.6);
            font-size: 14px;
        }

        .input-icon {
            position: absolute;
            left: 17px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.6);
            font-size: 16px;
            z-index: 1;
        }

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
            position: relative;
        }

        .video-background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -2;
            overflow: hidden;
        }

        .video-background video {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .video-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
            z-index: -1;
        }

        .login-container {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
        }

        .login-left {
            padding: 40px 60px;
            background: rgba(30, 30, 30, 0.3);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            position: relative;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .login-title {
            color: #ffffff;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 40px;
            text-align: center;
            letter-spacing: 2px;
        }

        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .login-btn {
            background: linear-gradient(45deg, #ff6b47, #ff8e53);
            border: none;
            border-radius: 12px;
            color: white;
            padding: 16px 30px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            margin-top: 25px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-btn:hover {
            background: linear-gradient(45deg, #ff8e53, #ff6b47);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(255, 107, 71, 0.3);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .signup-link {
            margin-top: 35px;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            font-size: 14px;
        }

        .signup-link a {
            color: #ff6b47;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .signup-link a:hover {
            color: #ff8e53;
            text-shadow: 0 0 8px rgba(255, 107, 71, 0.4);
        }

        .home-link {
            position: absolute;
            top: 25px;
            left: 25px;
            color: rgba(255, 255, 255, 0.7);
            font-size: 20px;
            transition: all 0.3s ease;
            z-index: 10;
            text-decoration: none;
        }

        .home-link:hover {
            color: #ff6b47;
            transform: scale(1.1);
        }

        .alert-custom {
            background: rgba(220, 53, 69, 0.15);
            border: 1px solid rgba(220, 53, 69, 0.3);
            color: #ffffff;
            border-radius: 8px;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
            padding: 12px 15px;
            font-size: 14px;
        }

        .alert-custom i {
            color: #ff6b6b;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .login-left {
                padding: 35px 25px;
                border-radius: 12px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
                background: rgba(30, 30, 30, 0.4);
                width: 90%;
                max-width: 400px;
                margin: 0 auto;
                min-height: auto;
            }

            .login-title {
                font-size: 2rem;
                margin-bottom: 35px;
            }

            .form-wrapper {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .login-left {
                padding: 30px 20px;
            }

            .login-title {
                font-size: 1.8rem;
            }

            .form-control-custom {
                height: 48px;
                padding: 14px 16px 14px 45px;
            }

            .login-btn {
                height: 50px;
                font-size: 15px;
            }
        }

        /* Animation for form elements */
        .form-group {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease forwards;
        }

        .form-group:nth-child(1) {
            animation-delay: 0.1s;
        }

        .form-group:nth-child(2) {
            animation-delay: 0.2s;
        }

        .login-btn {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease 0.3s forwards;
        }

        .signup-link {
            opacity: 0;
            animation: fadeIn 0.6s ease 0.4s forwards;
        }

        @keyframes slideUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
