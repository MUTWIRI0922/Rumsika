<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
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
        }

        .admin-layout {
            min-height: 100vh;
            position: relative;
        }

        .sidebar {
            width: 260px;
            min-width: 260px;
            max-width: 260px;
            transition: transform .3s ease, width .3s ease;
            position: sticky;
            top: 0;
            align-self: flex-start;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar .nav-link {
            color: #333;
            border-radius: .5rem;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: #fff;
            background-color: #198754;
        }

        .sidebar .nav-link i {
            font-size: 1.05rem;
        }

        .sidebar .sidebar-title {
            font-size: .85rem;
            letter-spacing: .08em;
            text-transform: uppercase;
        }

        .sidebar-backdrop {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.35);
            z-index: 1090;
        }

        .sidebar-backdrop.show {
            display: block;
        }

        .top-nav {
            position: sticky;
            top: 0;
            z-index: 1080;
        }

        @media (max-width: 991px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100vh;
                transform: translateX(-100%);
                z-index: 1100;
                overflow: hidden;
            }

            .sidebar.open {
                transform: translateX(0);
            }

            main {
                min-height: 100vh;
                margin-left: 0;
            }
        }
    </style>
</head>

<body>
    <div id="app" class="d-flex admin-layout bg-light">
        @include('Admin.adminnav')
        <div id="sidebarBackdrop" class="sidebar-backdrop"></div>
        <main class="flex-fill">
            <div class="top-nav d-flex d-lg-none align-items-center justify-content-between p-3 bg-white border-bottom">
                <div class="d-flex align-items-center gap-2">
                    <button id="sidebarToggleMobile" class="btn btn-success btn-sm">
                        <i class="bi bi-list"></i>
                    </button>
                    <span class="fw-semibold">Admin panel</span>
                </div>
            </div>
            @yield('content')
        </main>
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

            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const adminSidebar = document.getElementById('adminSidebar');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            const sidebarCollapseBtn = document.getElementById('sidebarCollapseBtn');

            if (sidebarToggleMobile) {
                sidebarToggleMobile.addEventListener('click', function() {
                    adminSidebar.classList.toggle('open');
                    sidebarBackdrop.classList.toggle('show');
                });
            }

            if (sidebarBackdrop) {
                sidebarBackdrop.addEventListener('click', function() {
                    adminSidebar.classList.remove('open');
                    sidebarBackdrop.classList.remove('show');
                });
            }

            if (sidebarCollapseBtn) {
                sidebarCollapseBtn.addEventListener('click', function() {
                    adminSidebar.classList.toggle('open');
                });
            }

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
        </script>
        @stack('scripts')
</body>

</html>