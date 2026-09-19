<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - TurfBooking</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0a0e17;
            color: #e2e8f0;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        .sidebar {
            width: 250px;
            background-color: #111827;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
        .nav-link {
            color: #9ca3af;
            border-radius: 0.5rem;
            margin: 0.25rem 1rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.05);
        }
        .nav-link.active {
            background-color: var(--bs-primary);
            color: #000;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.05);
            border-radius: 1rem;
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column py-4">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none px-4 mb-5">
            <h3 class="font-heading text-white m-0">TURF<span class="text-primary">ADMIN</span></h3>
        </a>
        
        <ul class="nav flex-column mb-auto">
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.bookings') }}" class="nav-link {{ request()->routeIs('admin.bookings') ? 'active' : '' }}">
                    Bookings
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.turfs') }}" class="nav-link {{ request()->routeIs('admin.turfs*') ? 'active' : '' }}">
                    Turfs
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.tournaments.index') }}" class="nav-link {{ request()->routeIs('admin.tournaments*') ? 'active' : '' }}">
                    Tournaments
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.offers.index') }}" class="nav-link {{ request()->routeIs('admin.offers*') ? 'active' : '' }}">
                    Offers
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.memberships.index') }}" class="nav-link {{ request()->routeIs('admin.memberships*') ? 'active' : '' }}">
                    Memberships
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    Users
                </a>
            </li>
        </ul>

        <div class="mt-auto px-3">
            <a href="{{ url('/') }}" class="btn btn-outline-secondary w-100 mb-2">View Site</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn btn-danger w-100">Logout</button>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="d-flex justify-content-between align-items-center mb-4 pb-3 border-bottom border-secondary">
            <h2 class="font-heading mb-0">@yield('title')</h2>
            <div class="d-flex align-items-center gap-3">
                <span class="text-muted">Admin User: <strong class="text-white">{{ Auth::user()->name }}</strong></span>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
