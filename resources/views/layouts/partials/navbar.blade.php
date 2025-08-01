<header class="navbar">
    <style>
        :root {
            --danger-red: #dc3545;
            --text-dark: #1a202c;
            --text-light: #4a5568;
        }
        .navbar {
            background: white;
            padding: 1rem 1.5rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar-left {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .sidebar-toggle {
            display: none;
            background: none; border: none; cursor: pointer; padding: 0.5rem;
        }
        .sidebar-toggle svg { width: 24px; height: 24px; }

        .datetime-container {
            display: flex; align-items: center; gap: 0.5rem;
            font-size: 0.9rem; font-weight: 500; color: var(--text-light);
        }
        #time-display { font-weight: 700; color: var(--text-dark); }

        .user-profile { display: flex; align-items: center; gap: 1rem; }
        .user-info .welcome-text { font-size: 0.875rem; color: var(--text-light); margin: 0; }
        .user-info .user-name { font-size: 1rem; font-weight: 700; color: var(--text-dark); margin: 0; }
        .logout-button {
            background-color: var(--danger-red); color: white; padding: 0.6rem 1rem;
            border: none; border-radius: 8px; cursor: pointer; font-weight: 500;
            transition: background-color 0.2s, transform 0.1s;
        }
        .logout-button:hover { background-color: #c82333; }
        .logout-button:active { transform: scale(0.97); }
        
        @media (max-width: 768px) {
            .sidebar-toggle { display: block; }
            .datetime-container { display: none; }
        }
        @media (max-width: 640px) {
            .user-info { display: none; }
        }
    </style>

    <div class="navbar-left">
        <!-- Tombol Hamburger untuk Mobile -->
        <button class="sidebar-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 6h18v2H3V6zm0 5h18v2H3v-2zm0 5h18v2H3v-2z"/></svg>
        </button>
        
        <div class="datetime-container">
            <span id="date-display"></span>
            <span id="time-display"></span>
        </div>
    </div>

    <div class="user-profile">
        <div class="user-info" style="text-align: right;">
            <p class="welcome-text">Selamat Datang,</p>
            <p class="user-name">{{ Auth::user()->name }}</p>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-button">
                Logout
            </button>
        </form>
    </div>
</header>

<script>
    function updateDateTime() {
        const dateDisplay = document.getElementById('date-display');
        const timeDisplay = document.getElementById('time-display');
        if (!dateDisplay || !timeDisplay) return;

        const now = new Date();
        const dateOptions = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', timeZone: 'Asia/Jakarta' };
        const formattedDate = new Intl.DateTimeFormat('id-ID', dateOptions).format(now);
        const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false, timeZone: 'Asia/Jakarta' };
        const formattedTime = new Intl.DateTimeFormat('id-ID', timeOptions).format(now).replace(/\./g, ':');

        dateDisplay.textContent = formattedDate + ' |';
        timeDisplay.textContent = formattedTime;
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
