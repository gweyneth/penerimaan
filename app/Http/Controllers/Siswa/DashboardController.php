<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard untuk siswa.
     */
    public function index()
    {
        // Mengembalikan view yang akan kita buat selanjutnya.
        return view('siswa.dashboard');
    }
}
