<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Situs Sedang Dibangun</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* === CSS Internal === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #ffffff;
            color: #333;
            line-height: 1.6;
            overflow: hidden;
        }

        /* NAVBAR */
        header {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 25px 40px;
            z-index: 20;
        }

        nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
        }

        .brand-logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1d3557;
            text-decoration: none;
        }

        .contact-btn {
            background-color: #e63946;
            color: #ffffff;
            padding: 10px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        .contact-btn:hover {
            background-color: #d62828;
            transform: translateY(-2px);
        }
        /* AKHIR NAVBAR */


        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
            padding: 40px;
            position: relative;
            text-align: center;
        }
        
        .container::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 35%;
            background-color: #eaf4ff;
            border-top-left-radius: 100%;
            border-top-right-radius: 100%;
            z-index: 0;
        }

        .text-content {
            max-width: 700px;
            z-index: 1;
        }

        .text-content h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #1d3557;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .text-content p {
            font-size: 1.1rem;
            color: #666;
            margin-bottom: 40px;
        }

        #countdown {
            display: flex;
            justify-content: center;
            gap: 30px;
        }

        .time-block .number {
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(90deg, #d62828, #f77f00, #fcbf49, #d62828);
            background-size: 200% auto;
            background-clip: text;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: moveGradient 4s linear infinite;
        }

        @keyframes moveGradient {
            to {
                background-position: 200% center;
            }
        }

        .time-block .label {
            font-size: 0.9rem;
            color: #666;
            text-transform: uppercase;
        }

        /* Desain Responsif */
        @media (max-width: 768px) {
            header { padding: 20px; }
            .brand-logo { font-size: 1.2rem; }
            .contact-btn { padding: 8px 20px; font-size: 0.9rem; }
            .text-content h1 { font-size: 2.5rem; }
            .text-content p { font-size: 1rem; }
            #countdown { gap: 20px; }
            .time-block .number { font-size: 2.8rem; }
        }

        @media (max-width: 480px) {
            .text-content h1 { font-size: 2rem; }
            #countdown { flex-direction: column; gap: 20px; }
        }

    </style>
</head>
<body>
    
    <header>
        <nav>
            <a href="#" class="brand-logo">Jiva Abisatya</a>
            <a href="https://wa.me/6287221383" target="_blank" class="contact-btn">Hubungi Kami</a>
        </nav>
    </header>

    <div class="container">
        <div class="text-content">
            <h1>Situs Sedang Dalam Pembangunan</h1>
            <p>Halo, Sobat Jiva Abisatya! Kami sedang bekerja keras untuk memberikan pengalaman terbaik untuk Anda dan akan segera hadir kembali.</p>

            <div id="countdown">
                <div class="time-block">
                    <span id="days" class="number">00</span>
                    <div class="label">Hari</div>
                </div>
                <div class="time-block">
                    <span id="hours" class="number">00</span>
                    <div class="label">Jam</div>
                </div>
                <div class="time-block">
                    <span id="minutes" class="number">00</span>
                    <div class="label">Menit</div>
                </div>
                <div class="time-block">
                    <span id="seconds" class="number">00</span>
                    <div class="label">Detik</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // === JavaScript Internal untuk Countdown Timer ===
        const thirtyDaysFromNow = new Date();
        thirtyDaysFromNow.setDate(thirtyDaysFromNow.getDate() + 30);
        
        const launchDate = thirtyDaysFromNow.getTime();

        const countdownFunction = setInterval(function() {
            const now = new Date().getTime();
            const distance = launchDate - now;

            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            const formatTime = (time) => time < 10 ? `0${time}` : time;

            document.getElementById("days").innerText = formatTime(days);
            document.getElementById("hours").innerText = formatTime(hours);
            document.getElementById("minutes").innerText = formatTime(minutes);
            document.getElementById("seconds").innerText = formatTime(seconds);

            if (distance < 0) {
                clearInterval(countdownFunction);
                document.getElementById("countdown").innerHTML = "<h2 style='font-size: 1.5rem; color: #1d3557;'>Situs Telah Hadir!</h2>";
            }
        }, 1000);
    </script>
</body>
</html>