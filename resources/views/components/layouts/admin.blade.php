<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin Dashboard' }}</title>
    <style>
        body { font-family: system-ui, sans-serif; background-color: #f4f7f6; margin: 0; }
        .admin-layout { display: flex; }
        .main-content { flex-grow: 1; display: flex; flex-direction: column; width: 100%; }
        .content-wrapper { padding: 1.5rem; background-color: #f4f7f6; }
        
        /* Overlay for mobile sidebar */
        .sidebar-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 999;
        }
        .sidebar-overlay.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="admin-layout">

        @include('layouts.partials.sidebar')

        <div class="main-content">
            @include('layouts.partials.navbar')

            <main class="content-wrapper">
                {{ $slot }}
            </main>
        </div>

    </div>
    
    <!-- Overlay for mobile sidebar -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const sidebarTogglers = document.querySelectorAll('.sidebar-toggle');
            const sidebarOverlay = document.getElementById('sidebarOverlay');

            function toggleSidebar() {
                sidebar.classList.toggle('open');
                sidebarOverlay.classList.toggle('active');
            }

            sidebarTogglers.forEach(toggler => {
                toggler.addEventListener('click', toggleSidebar);
            });

            sidebarOverlay.addEventListener('click', toggleSidebar);
        });
    </script>
</body>
</html>
