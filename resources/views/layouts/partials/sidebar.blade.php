<aside class="sidebar">
    <style>
        :root {
            --sidebar-bg: #1a222f;
            --sidebar-link-color: #aeb2b7;
            --sidebar-link-hover: #2f3a4c;
            --sidebar-link-active: #0A70F1;
            --sidebar-text-active: #ffffff;
        }

        .sidebar {
            width: 260px;
            background-color: var(--sidebar-bg);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease-in-out;
            flex-shrink: 0;
        }

        .sidebar-header {
            padding: 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.25rem;
            font-weight: 800;
            border-bottom: 1px solid #2f3a4c;
        }
        .sidebar-header h4 { margin: 0; }

        .sidebar-nav { flex-grow: 1; padding: 1rem 0; }
        .sidebar-nav ul { list-style: none; padding: 0; margin: 0; }
        .sidebar-nav li { padding: 0 1rem; margin-bottom: 0.5rem; }

        .sidebar-link {
            color: var(--sidebar-link-color);
            text-decoration: none;
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            font-weight: 500;
        }
        .sidebar-link:hover { background-color: var(--sidebar-link-hover); color: white; }
        .sidebar-link.active { background-color: var(--sidebar-link-active); color: var(--sidebar-text-active); font-weight: 700; }
        .sidebar-link .icon { margin-right: 1rem; width: 20px; height: 20px; }

        .submenu {
            list-style: none; padding-left: 1rem; max-height: 0;
            overflow: hidden; transition: max-height 0.3s ease-in-out;
        }
        .submenu.open { max-height: 200px; margin-top: 0.5rem; }
        .submenu-link {
            display: block; color: var(--sidebar-link-color); text-decoration: none;
            padding: 0.6rem 1.5rem; border-radius: 8px; position: relative;
        }
        .submenu-link::before {
            content: ''; position: absolute; left: 0.75rem; top: 50%;
            transform: translateY(-50%); width: 4px; height: 4px;
            background-color: var(--sidebar-link-color); border-radius: 50%;
        }
        .submenu-link:hover { color: white; background-color: var(--sidebar-link-hover); }

        .sidebar-close-btn {
            display: none; background: none; border: none;
            color: white; cursor: pointer;
        }
        .sidebar-close-btn svg { width: 24px; height: 24px; }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed; left: 0; top: 0; height: 100%;
                z-index: 1000; transform: translateX(-100%);
            }
            .sidebar.open {
                transform: translateX(0);
            }
            .sidebar-close-btn {
                display: block;
            }
        }
    </style>

    <div class="sidebar-header">
        <h4>JIVA ABISATYA</h4>
        <button class="sidebar-toggle sidebar-close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/></svg>
        </button>
    </div>

    <nav class="sidebar-nav">
        <ul>
            <li>
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z"/></svg></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.penerima.index') }}" class="sidebar-link {{ request()->routeIs('admin.penerima.*') ? 'active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z"/></svg></span>
                    <span class="text">Kelola Penerima</span>
                </a>
            </li>
            <li>
                <a href="{{ route('admin.kode-akses.index') }}" class="sidebar-link {{ request()->routeIs('admin.kode-akses.*') ? 'active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM18 14H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg></span>
                    <span class="text">Kode Akses</span>
                </a>
            </li>
            <li>
                <a href="#" id="akunSiswaMenu" class="sidebar-link {{ request()->routeIs('admin.akun-siswa.*') ? 'active' : '' }}">
                    <span class="icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg></span>
                    <span class="text">Akun Siswa</span>
                </a>
                <ul class="submenu" id="akunSiswaSubmenu">
                    <li><a href="{{ route('admin.akun-siswa.index') }}" class="submenu-link">Generate Akun</a></li>
                    <li><a href="{{ route('admin.akun-siswa.daftar') }}" class="submenu-link">Daftar Akun</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const akunSiswaMenu = document.getElementById('akunSiswaMenu');
        const submenu = document.getElementById('akunSiswaSubmenu');

        akunSiswaMenu.addEventListener('click', function(e) {
            e.preventDefault();
            submenu.classList.toggle('open');
        });

        if (akunSiswaMenu.classList.contains('active')) {
            submenu.classList.add('open');
        }
    });
</script>
