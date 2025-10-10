<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | MoVision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #2b2a2a, #3b3a2e, #2b2b28);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background: rgba(255, 255, 255, 0.08);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 15px;
            color: #fff;
            box-shadow: 0 4px 25px rgba(0,0,0,0.4);
            transition: all 0.3s ease;
        }

        .login-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0,0,0,0.6);
        }

        .login-card .card-header {
            background: transparent;
            border-bottom: none;
            text-align: center;
        }

        .login-card h4 {
            font-weight: 600;
            color: #FFD700;
        }

        .form-control {
            background: rgba(255,255,255,0.15);
            border: none;
            color: #fff;
        }

        .form-control::placeholder {
            color: rgba(255,255,255,0.7);
        }

        .form-control:focus {
            background: rgba(255,255,255,0.25);
            box-shadow: none;
            color: #fff;
        }

        .btn-custom {
            background: linear-gradient(to right, #FFD700, #E6B800);
            border: none;
            font-weight: 600;
            color: #1c1c1c;
            transition: 0.3s;
        }

        .btn-custom:hover {
            background: linear-gradient(to right, #E6B800, #FFD700);
            transform: scale(1.03);
        }

        .logo {
            height: 70px;
            margin-bottom: 10px;
        }

        .footer-text {
            text-align: center;
            margin-top: 20px;
            color: rgba(255,255,255,0.7);
            font-size: 0.9em;
        }

        .footer-text a {
            color: #FFD700;
            text-decoration: none;
        }

        .footer-text a:hover {
            text-decoration: underline;
        }

        .input-group-text {
            background: transparent;
            border: none;
            color: #FFD700;
        }

        /* Animasi halus muncul */
        .fade-in {
            animation: fadeIn 1.2s ease forwards;
            opacity: 0;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>

    <div class="container fade-in">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card p-4 shadow-lg">
                    <div class="card-header">
                        <img src="{{ asset('storage/MV-removebg-preview.png') }}" alt="MoVision" class="logo">
                        <h4>Welcome</h4>
                        <p class="text-light opacity-75">Login to continue to <strong>MoVision</strong></p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-custom w-100 py-2 mt-2">Login</button>
                        </form>
                    </div>
                </div>
                <div class="footer-text">
                    &copy; {{ date('Y') }} MoVision. All rights reserved.
                </div>
                @if(session('success'))
                <script>
                    alert("{{ session('success') }}");
                </script>
                @endif

                @if(session('error'))
                <script>
                    alert("{{ session('error') }}");
                </script>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
