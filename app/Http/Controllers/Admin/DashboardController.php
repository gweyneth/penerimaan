<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KodeAkses;
use App\Models\Penerima;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk admin dengan data statistik.
     */
    public function index()
    {
        // Menghitung total penerima
        $totalPenerima = Penerima::count();

        // Menghitung total akun siswa yang sudah dibuat
        $totalAkun = User::where('role', 'siswa')->count();

        // Menghitung yang lolos dan tidak lolos dari tabel kode_akses
        $totalLolos = KodeAkses::where('status_kelulusan', 'Lolos')->count();
        $totalTidakLolos = KodeAkses::where('status_kelulusan', 'Tidak Lolos')->count();

        // Mengirim semua data ke view
        return view('admin.dashboard', compact(
            'totalPenerima',
            'totalAkun',
            'totalLolos',
            'totalTidakLolos'
        ));
    }
}
