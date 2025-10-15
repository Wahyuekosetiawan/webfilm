<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MoVision</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('storage/MV-removebg-preview.png') }}">

    <style>
        body {
            background: linear-gradient(to right, #2b2a2a, #3b3a2e, #2b2b28);
            color: white;
            min-height: 100vh;
            margin: 0;
            display: flex;
            flex-direction: column;
            font-family: 'Poppins', sans-serif;
        }

        /* === NAVBAR === */
        .navbar-custom {
            background: #FFD700;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.4);
        }

        .navbar-custom .navbar-brand {
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 1px;
        }

        .navbar-custom .nav-link {
            color: #fff !important;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .navbar-custom .nav-link:hover {
            color: #000 !important;
            text-shadow: 0 0 5px #FFD700;
        }

        .navbar-custom .btn-outline-light {
            border-color: #000000;
            color: #f99500;
        }

        .navbar-custom .btn-outline-light:hover {
            background-color: #000;
            color: #FFD700;
        }

        /* === CONTENT === */
        .container {
            flex: 1;
        }

        /* === FOOTER === */
        footer {
            background: linear-gradient(to right, #1a1a1a, #2a2500);
            color: #fff;
            padding: 50px 0 25px;
            margin-top: auto;
            border-top: 2px solid #FFD70044;
        }

        footer h5 {
            color: #FFD700;
            font-weight: 600;
            margin-bottom: 15px;
        }

        footer p {
            font-size: 0.95rem;
            line-height: 1.6;
            color: #ddd;
        }

        footer a {
            color: #fff;
            text-decoration: none;
            transition: 0.3s;
        }

        footer a:hover {
            color: #FFD700;
            text-shadow: 0 0 5px #FFD700;
        }

        .footer-bottom {
            text-align: center;
            margin-top: 25px;
            font-size: 0.85em;
            color: #bbb;
        }

        .social-icons a {
            margin: 0 10px;
            color: #FFD700;
            font-size: 1.5rem;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .social-icons a:hover {
            color: #fff;
            transform: scale(1.2);
            text-shadow: 0 0 8px #FFD700;
        }

        /* ALERT */
        .alert-custom {
            background-color: rgba(255, 215, 0, 0.1);
            color: #FFD700;
            border: 1px solid #FFD70055;
            border-radius: 10px;
            padding: 10px 15px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <!-- === NAVBAR === -->
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="/">
                <img src="{{ asset('storage/movision-preview.png') }}" alt="MoVision Logo" style="height: 30px; margin-right: 10px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
              aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    @if(auth()->check())
                    <li class="nav-item mx-2"><a class="nav-link" href="/">Home</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="/kategori">Kategori</a></li>
                    <li class="nav-item mx-2"><a class="nav-link" href="/about">About</a></li>
                    <li class="nav-item mx-2">
                        <span class="nav-link text-warning fw-semibold">Hi, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
                    </li>
                    <li class="nav-item mx-2">
                        <form action="{{ route('logout') }}" method="POST" style="display:inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm px-3">Logout</button>
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- === CONTENT AREA === -->
    <div class="container mt-4 mb-5">
        {{-- FUNGSI ALERT --}}
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

        @yield('content')
    </div>

    <!-- === FOOTER === -->
    <footer class="text-center text-md-start">
        <div class="container">
            <div class="row">
                <!-- Logo & About -->
                <div class="col-md-4 mb-4">
                    <h5>MoVision</h5>
                    <p>
                        Platform film digital yang menghadirkan pengalaman menonton terbaik.
                        Temukan, tonton, dan nikmati berbagai film kesukaanmu hanya di MoVision.
                    </p>
                </div>

                <!-- Quick Links -->
                <div class="col-md-4 mb-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="/">Home</a></li>
                        <li><a href="/kategori">Kategori</a></li>
                        <li><a href="/about">About</a></li>
                    </ul>
                </div>

                <!-- Social Media -->
                <div class="col-md-4 mb-4 text-center text-md-start">
                    <h5>Follow Us</h5>
                    <div class="social-icons mt-2">
                        <a href="#"><i class="bi bi-facebook"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                &copy; {{ date('Y') }} <span class="text-warning">MoVision</span>. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- === BOOTSTRAP JS === -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
