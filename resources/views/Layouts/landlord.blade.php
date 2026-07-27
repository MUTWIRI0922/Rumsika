<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-B4LL9WBL0R"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-B4LL9WBL0R');
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', config('app.name', 'Laravel'))</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet">
    <!-- Add this in your layouts/app.blade.php head section -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon (1).ico') }}"> @vite(['resources/sass/app.scss','resources/js/app.js'])
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "Rumsika",
            "url": "https://www.rumsika.twitech.co.ke"
        }
    </script>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background: #f5f7fb;
            color: #243240;
        }

        .landlord-layout {
            min-height: 100vh;
            display: flex;
            background: #f5f7fb;
        }

        .landlord-sidebar {
            width: 260px;
            flex: 0 0 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #198754 0%, #146c43 100%);
            position: sticky;
            top: 0;
            z-index: 1040;
        }

        .landlord-main-panel {
            flex: 1;
            min-width: 0;
            display: flex;
            flex-direction: column;
        }

        .landlord-topbar {
            position: sticky;
            top: 0;
            z-index: 1030;
            background: #ffffff;
            border-bottom: 1px solid #e7ecef;
            box-shadow: 0 2px 12px rgba(15, 23, 42, 0.06);
            padding: 0.9rem 1.25rem;
        }

        .landlord-content {
            padding: 1.25rem 1.25rem 2rem;
            flex: 1;
        }

        .landlord-page-card {
            background: #ffffff;
            border: 1px solid #e7ecef;
            border-radius: 16px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.05);
            padding: 1.5rem;
        }

        .landlord-page-card .table {
            margin-bottom: 0;
        }

        .landlord-page-card .form-control,
        .landlord-page-card .form-select {
            border-radius: 10px;
            border-color: #d6dde3;
        }

        .landlord-page-card .btn {
            border-radius: 999px;
            padding-inline: 1rem;
        }

        @media (max-width: 992px) {
            .landlord-sidebar {
                width: 220px;
                flex-basis: 220px;
            }
        }

        @media (max-width: 768px) {
            .landlord-layout {
                flex-direction: column;
            }

            .landlord-sidebar {
                width: 100%;
                flex-basis: auto;
                min-height: auto;
                position: sticky;
                top: 0;
                overflow-x: auto;
                padding: 0.75rem 1rem;
            }

            .landlord-sidebar .nav {
                flex-direction: row;
                flex-wrap: nowrap;
                overflow-x: auto;
                white-space: nowrap;
                gap: 0.5rem;
            }

            .landlord-sidebar .nav-link {
                border-radius: 999px !important;
                padding: 0.6rem 0.8rem;
                display: inline-flex;
                align-items: center;
                flex-shrink: 0;
            }

            .landlord-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div id="app" class="landlord-layout">
        @include('landlord.sidebar')

        <div class="landlord-main-panel">
            <nav class="navbar top-nav landlord-topbar navbar-expand-lg">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <h5 class="l_name mb-0 text-success"><i>Welcome back,</i></h5>

                    <div class="dropdown">
                        <button class="dropdown-toggle d-flex align-items-center btn btn-link landlord-navbar-btn" id="landlordDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            @if(!empty($landlord->profile_picture))
                            <img src="{{ asset('storage/' . $landlord->profile_picture) }}" alt="Profile Picture" class="rounded-circle me-2" width="32" height="32" style="object-fit:cover;">
                            @else
                            <img src="{{ asset('images/profile avator.jpg') }}" alt="Profile Picture" class="rounded-circle me-2" width="32" height="32" style="object-fit:cover;">
                            @endif
                            {{ session('landlord_name') }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="landlordDropdown">
                            <li>
                                <a class="dropdown-item bi bi-person-circle" href="{{ route('dashboard', ['section' => 'profile']) }}"> My Profile</a>
                            </li>
                            <li>
                                <a href="{{ route('landlord.logout') }}" class="dropdown-item bi bi-arrow-bar-right"> Logout</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="landlord-content">
                <div class="landlord-page-card">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <!-- Loader Overlay -->
    <div id="loader-overlay" style="position:fixed;top:0;left:0;width:100vw;height:100vh;z-index:2000;background:rgba(255,255,255,0.8);display:flex;align-items:center;justify-content:center;">
        <div class="spinner-border text-success" role="status" style="width: 3rem; height: 3rem;">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
    <button onclick="topFunction()" id="backToTopBtn" title="Go to top" style="display:none;position:fixed;bottom:20px;right:0px;z-index:9999;" class="btn btn-success w-10 h-10 rounded-circle shadow">
        <i class="bi bi-arrow-up"></i>
    </button>

    <script>
        // Hide the loader overlay when the page is fully loaded
        window.addEventListener('load', function() {
            document.getElementById('loader-overlay').style.display = 'none';
        });
        // Back to top button functionality
        window.onscroll = function() {
            const backToTopBtn = document.getElementById("backToTopBtn");
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }
        };

        function topFunction() {
            document.body.scrollTop = 0; // For Safari
            document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
        document.addEventListener('DOMContentLoaded', function() {
            // Fade out alerts after 3 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert-success, .alert-danger, .alert-warning').forEach(function(alert) {
                    alert.classList.add('fade');
                    alert.style.transition = 'opacity 0.5s';
                    alert.style.opacity = '0';
                    setTimeout(function() {
                        alert.remove();
                    }, 500); // Remove from DOM after fade
                });
            }, 3000);
        });
    </script>
</body>

</html>