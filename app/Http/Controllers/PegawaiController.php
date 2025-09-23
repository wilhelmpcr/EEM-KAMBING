<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    public function index()
    {
        // Nama
        $data['name'] = 'Wilhelm';

        // Hitung umur dari tanggal lahir (pakai DateTime biasa)
        $birthdate = date_create('2005-05-06');
        $today = date_create(date('Y-m-d'));
        $age = date_diff($birthdate, $today)->y;
        $data['my_age'] = $age;

        // Hobi
        $data['hobbies'] = ['Berenang', 'Main Game', 'Kuliner', 'Jalan-Jalan', 'Main Alat Musik'];

        // Tanggal harus wisuda
        $tglWisuda = '2028-08-02';
        $data['tgl_harus_wisuda'] = $tglWisuda;

        // Jarak hari ke wisuda
        $tglWisudaTime = strtotime($tglWisuda);
        $todayTime = strtotime(date('Y-m-d'));
        $selisihHari = round(($tglWisudaTime - $todayTime) / (60 * 60 * 24));
        $data['time_to_study_left'] = $selisihHari;

        // Semester
        $data['current_semester'] = 3;

        // Info semester
        if ($data['current_semester'] < 2) {
            $data['semester_info'] = 'Masih Awal, Kejar TAK!';
        } else {
            $data['semester_info'] = 'Jangan main-main, kurang-kurangi main game!';
        }

        // Cita-cita
        $data['future_goal'] = 'Menjadi Programmer Handal';

        return view('pegawai', $data);
    }
}
