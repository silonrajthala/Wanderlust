<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal - Wanderlust Travel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary: #2A6B84;
            --primary-dark: #1E556B;
            --secondary: #F8B400;
            --light: #F8F9FA;
            --dark: #343A40;
            --border: #E9ECEF;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            padding: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .logo-section {
            text-align: center;
            margin-bottom: 40px;
        }

        .logo {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border-radius: 50%;
            margin-bottom: 20px;
            box-shadow: 0 10px 20px rgba(42, 107, 132, 0.3);
        }

        .logo i {
            font-size: 24px;
            color: white;
        }

        .logo-text {
            font-size: 24px;
            font-weight: 700;
            color: var(--dark);
            margin-bottom: 8px;
        }

        .logo-subtitle {
            font-size: 14px;
            color: #6C757D;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: var(--dark);
            font-size: 14px;
        }

        .input-group {
            position: relative;
        }

        .form-control {
            width: 100%;
            padding: 14px 16px 14px 48px;
            border: 2px solid var(--border);
            border-radius: 12px;
            font-size: 15px;
            font-weight: 400;
            transition: all 0.3s ease;
            background: white;
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(42, 107, 132, 0.1);
            outline: none;
        }

        .input-icon {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #6C757D;
            font-size: 16px;
            z-index: 2;
        }

        .btn-login {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            border: none;
            border-radius: 12px;
            color: white;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(42, 107, 132, 0.3);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(42, 107, 132, 0.4);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .form-check {
            display: flex;
            align-items: center;
        }

        .form-check-input {
            margin-right: 8px;
            margin-top: 0;
        }

        .form-check-label {
            color: #6C757D;
        }

        .forgot-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-link:hover {
            color: var(--primary-dark);
        }

        .alert {
            border-radius: 12px;
            border: none;
            padding: 16px;
            margin-bottom: 24px;
            font-size: 14px;
        }

        .alert-danger {
            background: rgba(220, 53, 69, 0.1);
            color: #DC3545;
            border-left: 4px solid #DC3545;
        }

        .security-notice {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
        }

        .security-text {
            font-size: 12px;
            color: #6C757D;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .security-text i {
            color: #28A745;
        }

        /* Loading animation */
        .btn-loading {
            position: relative;
            color: transparent;
        }

        .btn-loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid transparent;
            border-top-color: white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-card {
                padding: 30px 25px;
            }

            .logo {
                width: 50px;
                height: 50px;
            }

            .logo i {
                font-size: 20px;
            }

            .logo-text {
                font-size: 20px;
            }
        }

        /* Floating animation */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .floating {
            animation: float 6s ease-in-out infinite;
        }
    </style>
</head>
<body>
    <div class="login-container floating">
        <div class="login-card">
            <!-- Logo Section -->
            <div class="logo-section">
                <div class="logo">
                    <i class="fas fa-lock"></i>
                </div>
                <h1 class="logo-text">Admin Portal</h1>
                <p class="logo-subtitle">Wanderlust Travel Management</p>
            </div>
                <!-- Development Notice - Remove in production -->
<div class="alert alert-info mt-3" style="background: rgba(13, 110, 253, 0.1); color: #0D6EFD; border-left: 4px solid #0D6EFD;">
    <i class="fas fa-info-circle me-2"></i>
    <strong>Development Access</strong>
    <div class="mt-1 small">
        Email: <code>admin@wanderlust.com</code><br>
        Password: <code>password123</code>
    </div>
</div>

            <!-- Error Messages -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Authentication Failed</strong>
                    @foreach ($errors->all() as $error)
                        <div class="mt-1">{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-success">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login.submit') }}" id="loginForm">
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <div class="input-group">
                        <i class="fas fa-envelope input-icon"></i>
                        <input type="email"
                               class="form-control"
                               id="email"
                               name="email"
                               value="{{ old('email') }}"
                               placeholder="Enter your email address"
                               required
                               autofocus
                               autocomplete="email">
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-group">
                        <i class="fas fa-lock input-icon"></i>
                        <input type="password"
                               class="form-control"
                               id="password"
                               name="password"
                               placeholder="Enter your password"
                               required
                               autocomplete="current-password">
                    </div>
                </div>

                <!-- Remember Me & Forgot Password -->
                <div class="remember-forgot">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="remember" name="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn-login" id="loginButton">
                    <span id="buttonText">Sign In</span>
                </button>
            </form>

            <!-- Security Notice -->
            <div class="security-notice">
                <p class="security-text">
                    <i class="fas fa-shield-alt"></i>
                    Secure admin access. Activity is monitored and logged.
                </p>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            const loginButton = document.getElementById('loginButton');
            const buttonText = document.getElementById('buttonText');

            loginForm.addEventListener('submit', function() {
                // Show loading state
                loginButton.classList.add('btn-loading');
                loginButton.disabled = true;
                buttonText.textContent = 'Authenticating...';
            });

            // Add input focus effects
            const inputs = document.querySelectorAll('.form-control');
            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.querySelector('.input-icon').style.color = 'var(--primary)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.querySelector('.input-icon').style.color = '#6C757D';
                });
            });

            // Prevent form resubmission
            if (window.history.replaceState) {
                window.history.replaceState(null, null, window.location.href);
            }
        });
    </script>
</body>
</html>
