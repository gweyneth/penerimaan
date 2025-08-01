<!DOCTYPE html>
<html>
<head>
    <title>{{ $judul }}</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            font-size: 12px;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            margin: 0;
            font-size: 20px;
        }
        .header p {
            margin: 5px 0;
            font-size: 14px;
        }
        .student-card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 20px; /* Ini yang membuat jarak antar data */
            page-break-inside: avoid; /* Mencegah kartu terpotong di antara halaman */
        }
        .student-card h3 {
            margin-top: 0;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
            font-size: 16px;
        }
        .info-grid {
            display: inline-block; /* Menggunakan inline-block untuk kompatibilitas */
        }
        .info-row {
            margin-bottom: 8px;
        }
        .info-label {
            display: inline-block;
            width: 120px;
            font-weight: bold;
        }
        .info-value {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>{{ $judul }}</h1>
        <p>Dicetak pada: {{ $tanggal }}</p>
    </div>

    @forelse ($akunSiswa as $akun)
        <div class="student-card">
            <h3>{{ $akun->name }}</h3>
            <div class="info-grid">
                <div class="info-row">
                    <span class="info-label">Tanggal Lahir</span>
                    <span class="info-value">: {{ $akun->penerima ? \Carbon\Carbon::parse($akun->penerima->tanggal_lahir)->format('d F Y') : 'N/A' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Email (Username)</span>
                    <span class="info-value">: {{ $akun->email }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Password</span>
                    <span class="info-value">: <strong>{{ $akun->plain_password ?? 'Tidak Tersimpan' }}</strong></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Kode Akses</span>
                    <span class="info-value">: <strong>{{ $akun->penerima?->kodeAkses?->kode ?? 'Belum Dibuat' }}</strong></span>
                </div>
            </div>
        </div>
    @empty
        <p style="text-align: center;">Tidak ada data akun siswa untuk dicetak.</p>
    @endforelse
</body>
</html>
