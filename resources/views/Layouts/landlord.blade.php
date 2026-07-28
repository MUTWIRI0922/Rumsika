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

        .landlord-sidebar-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.45);
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.25s ease, visibility 0.25s ease;
            z-index: 1050;
        }

        .landlord-sidebar-backdrop.show {
            opacity: 1;
            visibility: visible;
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

        .landlord-page {
            background: #ffffff;
            border: 1px solid #e7ecef;
            border-radius: 16px;

            padding: 1.5rem;
        }

        .landlord-page .table {
            margin-bottom: 0;
        }

        .landlord-page .form-control,
        .landlord-page .form-select {
            border-radius: 10px;
            border-color: #d6dde3;
        }

        .landlord-page .btn {
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
                width: 85%;
                max-width: 280px;
                flex-basis: auto;
                min-height: 100vh;
                height: 100vh;
                position: fixed;
                top: 0;
                left: 0;
                transform: translateX(-100%);
                transition: transform 0.25s ease-in-out;
                overflow-y: auto;
                padding: 1rem;
                z-index: 1060;
            }

            .landlord-sidebar.open {
                transform: translateX(0);
            }

            .landlord-sidebar .nav {
                flex-direction: column;
                gap: 0.5rem;
            }

            .landlord-sidebar .nav-link {
                border-radius: 999px !important;
                padding: 0.7rem 0.9rem;
                display: flex;
                align-items: center;
            }

            .landlord-content {
                padding: 1rem;
            }
        }
    </style>
</head>

<body>
    <div id="app" class="landlord-layout">
        <div id="sidebarBackdrop" class="landlord-sidebar-backdrop"></div>
        @include('landlord.sidebar')

        <div class="landlord-main-panel">
            <nav class="navbar top-nav landlord-topbar navbar-expand-lg">
                <div class="container-fluid d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center d-md-none">
                        <button class="btn btn-outline-success d-sm-none me-2" type="button" id="sidebarToggleMobile" aria-label="Toggle menu">
                            <i class="bi bi-list"></i>
                        </button>
                    </div>

                    <div class="ms-auto">

                    @php
                        $profilePicture = session('profile_picture');
                        $profileImageUrl = asset('images/profile avator.jpg');

                        if (!empty($profilePicture)) {
                            $profileImagePath = public_path('storage/' . $profilePicture);
                            if (file_exists($profileImagePath)) {
                                $profileImageUrl = asset('storage/' . $profilePicture);
                            }
                        }
                    @endphp

                    <div class="dropdown ms-auto">
                        <a class="d-flex align-items-center btn btn-link landlord-navbar-btn" href="{{ route('landlord.profile') }}">
                            <img src="{{ $profileImageUrl }}" alt="Profile Picture" class="rounded-circle me-2" width="32" height="32" style="object-fit:cover;">
                            {{ Str::title(session('landlord_name')) }}
                        </a>
                    </div>
                </div>
            </nav>

            <main class="landlord-content">
                <div class="landlord-page">
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
    <script src="../js/selfie.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            const sidebarToggleMobile = document.getElementById('sidebarToggleMobile');
            const landlordSidebar = document.getElementById('landlordSidebar');
            const sidebarBackdrop = document.getElementById('sidebarBackdrop');
            const closeSidebarMobile = document.getElementById('closeSidebarMobile');

            const toggleSidebar = function() {
                landlordSidebar?.classList.toggle('open');
                sidebarBackdrop?.classList.toggle('show');
            };

            sidebarToggleMobile?.addEventListener('click', toggleSidebar);
            closeSidebarMobile?.addEventListener('click', toggleSidebar);
            sidebarBackdrop?.addEventListener('click', toggleSidebar);

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    landlordSidebar?.classList.remove('open');
                    sidebarBackdrop?.classList.remove('show');
                }
            });

            const editBtn = document.getElementById('editBtn');
            if (editBtn) {
                editBtn.onclick = function() {
                    let form = document.getElementById('profileForm');
                    form?.querySelectorAll('input').forEach(input => input.removeAttribute('readonly'));
                    const saveBtn = document.getElementById('saveBtn');
                    saveBtn?.classList.remove('d-none');
                    this.classList.add('d-none');
                };
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
        });
    </script>
</body>

</html>