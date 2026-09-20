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
            background-color: var(--bs-body-bg);
            color: var(--bs-body-color);
        }
        [data-bs-theme="dark"] body {
            background-color: #0a0e17;
            color: #e2e8f0;
        }
        h1, h2, h3, h4, h5, h6, .font-heading {
            font-family: 'Outfit', sans-serif;
        }
        .sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            border-right: 1px solid var(--bs-border-color);
            background-color: var(--bs-tertiary-bg);
        }
        [data-bs-theme="dark"] .sidebar {
            background-color: #111827;
            border-right: 1px solid rgba(255,255,255,0.1);
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            min-height: 100vh;
        }
        .nav-link {
            color: var(--bs-secondary-color);
            border-radius: 0.5rem;
            margin: 0.25rem 1rem;
            padding: 0.75rem 1rem;
            transition: all 0.2s;
        }
        .nav-link:hover, .nav-link.active {
            color: var(--bs-body-color);
            background-color: var(--bs-secondary-bg);
        }
        [data-bs-theme="dark"] .nav-link {
            color: #9ca3af;
        }
        [data-bs-theme="dark"] .nav-link:hover, [data-bs-theme="dark"] .nav-link.active {
            color: #fff;
            background-color: rgba(255, 255, 255, 0.05);
        }
        .nav-link.active {
            background-color: var(--bs-primary);
            color: #000;
        }
        .glass-card {
            background: var(--bs-tertiary-bg);
            backdrop-filter: blur(10px);
            border: 1px solid var(--bs-border-color);
            border-radius: 1rem;
        }
        [data-bs-theme="dark"] .glass-card {
            background: rgba(255, 255, 255, 0.03);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body>

    <!-- Sidebar -->
    <div class="sidebar d-flex flex-column py-4">
        <a href="{{ route('admin.dashboard') }}" class="text-decoration-none px-4 mb-5">
            <h3 class="font-heading text-body m-0">TURF<span class="text-primary">ADMIN</span></h3>
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
            <h2 class="font-heading mb-0 text-body">@yield('title')</h2>
            <div class="d-flex align-items-center gap-3">
                <button id="theme-toggle" class="btn btn-link text-body text-decoration-none p-0 border-0" title="Toggle Theme">
                  <svg id="theme-icon-moon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-moon-fill" viewBox="0 0 16 16">
                    <path d="M6 .278a.77.77 0 0 1 .08.858 7.2 7.2 0 0 0-.878 3.46c0 4.021 3.278 7.277 7.318 7.277q.792-.001 1.533-.16a.79.79 0 0 1 .81.316.73.73 0 0 1-.031.893A8.35 8.35 0 0 1 8.344 16C3.734 16 0 12.286 0 7.71 0 4.266 2.114 1.312 5.124.06A.75.75 0 0 1 6 .278"/>
                  </svg>
                  <svg id="theme-icon-sun" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-sun-fill d-none" viewBox="0 0 16 16">
                    <path d="M8 12a4 4 0 1 0 0-8 4 4 0 0 0 0 8M8 0a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 0m0 13a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-1 0v-2A.5.5 0 0 1 8 13m8-5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2a.5.5 0 0 1 .5.5M3 8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1 0-1h2A.5.5 0 0 1 3 8m10.657-5.657a.5.5 0 0 1 0 .707l-1.414 1.415a.5.5 0 1 1-.707-.708l1.414-1.414a.5.5 0 0 1 .707 0m-9.193 9.193a.5.5 0 0 1 0 .707L3.05 13.657a.5.5 0 0 1-.707-.707l1.414-1.414a.5.5 0 0 1 .707 0m9.193 2.121a.5.5 0 0 1-.707 0l-1.414-1.414a.5.5 0 0 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .707M4.464 4.465a.5.5 0 0 1-.707 0L2.343 3.05a.5.5 0 1 1 .707-.707l1.414 1.414a.5.5 0 0 1 0 .708"/>
                  </svg>
                </button>
                <span class="text-muted">Admin User: <strong class="text-body">{{ Auth::user()->name }}</strong></span>
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
