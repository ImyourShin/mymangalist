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

    <div class="register-container">
        <!-- Form Section -->
        <div class="register-left">
            <a href="{{ route('frontend.home') }}" class="home-link">
                <i class="fas fa-home"></i>
            </a>

            <div class="form-wrapper">
                <h1 class="register-title">SIGN UP</h1>
                <p class="register-subtitle">Create your account to join our manga community</p>

                @if ($errors->any())
                    <div class="alert alert-custom">
                        @foreach ($errors->all() as $error)
                            <div><i class="fas fa-exclamation-triangle me-2"></i>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success-custom">
                        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('register') }}" method="POST">
                    @csrf

                    <div class="form-group">
                        <i class="fas fa-user input-icon"></i>
                        <input type="text" class="form-control form-control-custom" name="username"
                            placeholder="Username" value="{{ old('username') }}" required>
                    </div>

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

                    <div class="form-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password" class="form-control form-control-custom" name="password_confirmation"
                            placeholder="Confirm Password" required>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="terms" required>
                            <span class="checkmark"></span>
                            <span class="checkbox-text">I agree to the <a href="#" class="terms-link">Terms of
                                    Service</a> and <a href="#" class="terms-link">Privacy Policy</a></span>
                        </label>
                    </div>

                    <button type="submit" class="register-btn">
                        <i class="fas fa-user-plus me-2"></i>CREATE ACCOUNT
                    </button>
                </form>

                <div class="login-link">
                    Already have an account? <a href="{{ route('login') }}">Sign In</a>
                </div>
            </div>
        </div>
    </div>

    <style>
        .form-wrapper {
            max-width: 420px;
            width: 100%;
        }

        .form-control-custom {
            background: rgba(255, 255, 255, 0.1);
            border: 1.5px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            color: #ffffff;
            padding: 16px 18px 16px 45px;
            /* Adjusted padding - moved cursor to the left */
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
            left: 15px;
            /* Reduced from 17px to better align with cursor */
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

        .register-container {
            display: flex;
            min-height: 100vh;
            justify-content: center;
            align-items: center;
            padding: 20px 0;
        }

        .register-left {
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

        .register-title {
            color: #ffffff;
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
            text-align: center;
            letter-spacing: 2px;
        }

        .register-subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 14px;
            text-align: center;
            margin-bottom: 35px;
            line-height: 1.4;
        }

        .form-group {
            position: relative;
            margin-bottom: 20px;
        }

        .checkbox-group {
            margin-bottom: 25px;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.8);
            font-size: 13px;
            line-height: 1.4;
        }

        .checkbox-wrapper input[type="checkbox"] {
            display: none;
        }

        .checkmark {
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 4px;
            position: relative;
            transition: all 0.3s ease;
            flex-shrink: 0;
            margin-top: 2px;
        }

        .checkbox-wrapper input[type="checkbox"]:checked+.checkmark {
            background: linear-gradient(45deg, #ff6b47, #ff8e53);
            border-color: #ff6b47;
        }

        .checkbox-wrapper input[type="checkbox"]:checked+.checkmark:after {
            content: "✓";
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: white;
            font-size: 12px;
            font-weight: bold;
        }

        .checkbox-text {
            flex: 1;
        }

        .terms-link {
            color: #ff6b47;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .terms-link:hover {
            color: #ff8e53;
            text-shadow: 0 0 8px rgba(255, 107, 71, 0.4);
        }

        .register-btn {
            background: linear-gradient(45deg, #ff6b47, #ff8e53);
            border: none;
            border-radius: 12px;
            color: white;
            padding: 16px 30px;
            font-size: 16px;
            font-weight: 600;
            width: 100%;
            margin-top: 15px;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            height: 54px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        .register-btn:hover {
            background: linear-gradient(45deg, #ff8e53, #ff6b47);
            transform: translateY(-1px);
            box-shadow: 0 8px 25px rgba(255, 107, 71, 0.3);
        }

        .register-btn:active {
            transform: translateY(0);
        }

        .login-link {
            margin-top: 30px;
            color: rgba(255, 255, 255, 0.7);
            text-align: center;
            font-size: 14px;
        }

        .login-link a {
            color: #ff6b47;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-link a:hover {
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

        .alert-success-custom {
            background: rgba(40, 167, 69, 0.15);
            border: 1px solid rgba(40, 167, 69, 0.3);
            color: #ffffff;
            border-radius: 8px;
            margin-bottom: 25px;
            backdrop-filter: blur(10px);
            padding: 12px 15px;
            font-size: 14px;
        }

        .alert-success-custom i {
            color: #28a745;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .register-left {
                padding: 35px 25px;
                border-radius: 12px;
                box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
                background: rgba(30, 30, 30, 0.4);
                width: 90%;
                max-width: 420px;
                margin: 0 auto;
                min-height: auto;
            }

            .register-title {
                font-size: 2rem;
                margin-bottom: 8px;
            }

            .register-subtitle {
                margin-bottom: 30px;
            }

            .form-wrapper {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .register-left {
                padding: 30px 20px;
            }

            .register-title {
                font-size: 1.8rem;
            }

            .form-control-custom {
                height: 48px;
                padding: 14px 16px 14px 42px;
            }

            .input-icon {
                left: 13px;
            }

            .register-btn {
                height: 50px;
                font-size: 15px;
            }

            .checkbox-text {
                font-size: 12px;
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

        .form-group:nth-child(3) {
            animation-delay: 0.3s;
        }

        .form-group:nth-child(4) {
            animation-delay: 0.4s;
        }

        .form-group:nth-child(5) {
            animation-delay: 0.5s;
        }

        .register-btn {
            opacity: 0;
            transform: translateY(20px);
            animation: slideUp 0.6s ease 0.6s forwards;
        }

        .login-link {
            opacity: 0;
            animation: fadeIn 0.6s ease 0.7s forwards;
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

        /* Loading state for button */
        .register-btn:disabled {
            opacity: 0.7;
            cursor: not-allowed;
            transform: none;
        }

        .register-btn.loading::after {
            content: "";
            width: 16px;
            height: 16px;
            margin-left: 10px;
            border: 2px solid transparent;
            border-top: 2px solid #ffffff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Add some interactivity
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            const submitBtn = document.querySelector('.register-btn');

            // Add form validation feedback
            const inputs = document.querySelectorAll('.form-control-custom');
            inputs.forEach(input => {
                input.addEventListener('blur', function() {
                    if (this.value.trim() !== '') {
                        this.style.borderColor = 'rgba(40, 167, 69, 0.5)';
                    } else {
                        this.style.borderColor = 'rgba(220, 53, 69, 0.5)';
                    }
                });

                input.addEventListener('focus', function() {
                    this.style.borderColor = '#ff6b47';
                });
            });

            // Password confirmation validation
            const password = document.querySelector('input[name="password"]');
            const confirmPassword = document.querySelector('input[name="password_confirmation"]');

            confirmPassword.addEventListener('input', function() {
                if (password.value !== confirmPassword.value) {
                    confirmPassword.style.borderColor = 'rgba(220, 53, 69, 0.5)';
                } else {
                    confirmPassword.style.borderColor = 'rgba(40, 167, 69, 0.5)';
                }
            });

            // Form submission loading state
            form.addEventListener('submit', function() {
                submitBtn.classList.add('loading');
                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>CREATING ACCOUNT...';
            });
        });
    </script>
@endsection
