<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Galaxy Bakery</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @include('lib.ext_css')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Animated background elements */
        .bg-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-element {
            position: absolute;
            opacity: 0.1;
            animation: float 6s ease-in-out infinite;
        }

        .floating-element:nth-child(1) {
            top: 10%;
            left: 10%;
            animation-delay: 0s;
        }

        .floating-element:nth-child(2) {
            top: 20%;
            right: 10%;
            animation-delay: 2s;
        }

        .floating-element:nth-child(3) {
            bottom: 20%;
            left: 15%;
            animation-delay: 4s;
        }

        .floating-element:nth-child(4) {
            bottom: 10%;
            right: 20%;
            animation-delay: 1s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(180deg);
            }
        }

        /* Main container */
        .login-container {
            position: relative;
            z-index: 10;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            animation: slideIn 0.8s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .logo {
            font-size: 2.5rem;
            font-weight: bold;
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 10px;
            animation: glow 2s ease-in-out infinite alternate;
        }

        @keyframes glow {
            from {
                filter: drop-shadow(0 0 5px rgba(102, 126, 234, 0.5));
            }

            to {
                filter: drop-shadow(0 0 20px rgba(102, 126, 234, 0.8));
            }
        }

        .subtitle {
            color: #666;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        /* Animated chef character */
        .chef-container {
            display: flex;
            justify-content: center;
            margin-bottom: 30px;
        }

        .chef {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #ffd89b 0%, #19547b 100%);
            border-radius: 50%;
            position: relative;
            animation: bounce 2s infinite;
        }

        .chef::before {
            content: '👨‍🍳';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 2rem;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0);
            }

            40% {
                transform: translateY(-10px);
            }

            60% {
                transform: translateY(-5px);
            }
        }

        /* Form styles */
        .form-group {
            position: relative;
            margin-bottom: 25px;
        }

        .form-input {
            width: 100%;
            padding: 15px 50px 15px 20px;
            border: 2px solid #e1e5e9;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.9);
        }

        .form-input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 20px rgba(102, 126, 234, 0.2);
            transform: translateY(-2px);
        }

        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: #667eea;
            transition: all 0.3s ease;
        }

        .form-input:focus+.input-icon {
            color: #764ba2;
            transform: translateY(-50%) scale(1.1);
        }

        /* Checkbox styles */
        .checkbox-container {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
        }

        .custom-checkbox {
            position: relative;
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 10px;
        }

        .custom-checkbox input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background: #e1e5e9;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .custom-checkbox:hover input~.checkmark {
            background: #667eea;
        }

        .custom-checkbox input:checked~.checkmark {
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        .checkmark:after {
            content: "";
            position: absolute;
            display: none;
        }

        .custom-checkbox input:checked~.checkmark:after {
            display: block;
        }

        .custom-checkbox .checkmark:after {
            left: 7px;
            top: 3px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        /* Button styles */
        .login-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-size: 1.1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(102, 126, 234, 0.4);
        }

        .login-btn:active {
            transform: translateY(0);
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        /* Responsive design */
        @media (max-width: 480px) {
            .login-container {
                margin: 20px;
                padding: 30px 20px;
            }

            .logo {
                font-size: 2rem;
            }
        }

        /* Sparkle animation */
        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: white;
            border-radius: 50%;
            animation: sparkle 1.5s infinite;
        }

        .sparkle:nth-child(1) {
            top: 20%;
            left: 80%;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            top: 80%;
            left: 20%;
            animation-delay: 0.5s;
        }

        .sparkle:nth-child(3) {
            top: 40%;
            left: 90%;
            animation-delay: 1s;
        }

        @keyframes sparkle {

            0%,
            100% {
                opacity: 0;
                transform: scale(0);
            }

            50% {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body>



    <!-- Animated background -->
    <div class="bg-animation">
        <div class="floating-element">🍰</div>
        <div class="floating-element">🧁</div>
        <div class="floating-element">🍞</div>
        <div class="floating-element">🥐</div>
        <div class="sparkle"></div>
        <div class="sparkle"></div>
        <div class="sparkle"></div>
    </div>

    <div class="login-container">
        <div class="login-header">
            <div class="logo">Galaxy Bakery</div>
            <div class="subtitle">Silahkan Login Untuk Masuk</div>
        </div>

        <div class="chef-container">
            <div class="chef"></div>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group">
                <input type="email" name="email" class="form-input" placeholder="Email Address" required autofocus>
                <i class="fas fa-envelope input-icon"></i>
            </div>

            <div class="form-group">
                <input type="password" name="password" class="form-input" placeholder="Password" required>
                <i class="fas fa-lock input-icon"></i>
            </div>

            <div class="checkbox-container">
                <label class="custom-checkbox">
                    <input type="checkbox" name="remember" id="remember">
                    <span class="checkmark"></span>
                </label>
                <label for="remember">Remember Me</label>
            </div>

            <button type="submit" class="login-btn">
                <i class="fas fa-sign-in-alt" style="margin-right: 10px;"></i>
                Sign In
            </button>
        </form>
    </div>

    <script>
        // Add some interactive effects
        document.addEventListener('DOMContentLoaded', function() {
            const inputs = document.querySelectorAll('.form-input');

            inputs.forEach(input => {
                input.addEventListener('focus', function() {
                    this.parentElement.style.transform = 'scale(1.02)';
                });

                input.addEventListener('blur', function() {
                    this.parentElement.style.transform = 'scale(1)';
                });
            });

            // Add click effect to chef
            const chef = document.querySelector('.chef');
            chef.addEventListener('click', function() {
                this.style.animation = 'bounce 0.5s ease';
                setTimeout(() => {
                    this.style.animation = 'bounce 2s infinite';
                }, 500);
            });
        });
    </script>
</body>

</html>