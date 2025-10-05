<!DOCTYPE html>
<html>
<head>
    <title>Website Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #2d2d2e, #3b3939, #393630, #2b2828);
            color: white;
            min-height: 100vh; /* biar full tinggi layar */
            margin: 0;
        }

        /* Ganti background navbar */
    .navbar-custom {
        background: linear-gradient(to right, #03346E, #021526); /* contoh gradient */
    }

    /* Biar link kelihatan jelas */
    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
        color: #fff !important;
    }

    /* Hover effect */
    .navbar-custom .nav-link:hover {
        color: #0714a7 !important; /* kuning pas hover */
    }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom shadow-sm">
      <div class="container">
        <!-- Brand -->
        <a class="navbar-brand fw-bold" href="/">🎬 MoVision</a>

        <!-- Button toggle (mobile) -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" 
          aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            @if(auth()->check())
            <li class="nav-item mx-2">
              <a class="nav-link" aria-current="page" href="/">Home</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="/kategori">Kategori</a>
            </li>
            <li class="nav-item mx-2">
              <a class="nav-link" href="/about">About</a>
            </li>
            <li class="nav-item mx-2">
              <span class="nav-link">Welcome, {{ auth()->user()->name }} ({{ auth()->user()->role }})</span>
            </li>
            <li class="nav-item mx-2">
              <form action="{{ route('logout') }}" method="POST" style="display:inline">
                @csrf
                <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
              </form>
            </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
