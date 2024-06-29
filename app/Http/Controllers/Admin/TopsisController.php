<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\Penilaian;
use Illuminate\Http\Request;

class TopsisController extends Controller
{
    private $kriteria = [
        'pendapatan' => 'Pendapatan',
        'jumlah_tanggungan' => 'Jumlah Tanggungan',
        'jaminan' => 'Jaminan',
        'jumlah_pinjaman' => 'Jumlah Pinjaman',
        'lama_angsuran' => 'Lama angsuran'
    ];
    public function showTopsisPage()
    {
        // Mendapatkan pembagi
        $pembagi = $this->hitungPembagi();

        // Menghitung matriks ternormalisasi dengan menggunakan pembagi
        $matriksTernormalisasi = $this->hitungMatriksTernormalisasi($pembagi);

        // Menghitung matriks ternormalisasi terbobot dengan menggunakan matriks ternormalisasi
        $matriksTerbobot = $this->hitungMatriksTerbobot($matriksTernormalisasi);

         // Menghitung A+ dan A-
       $aPlusMinus = $this->hitungAPlusMinus($matriksTerbobot);

      // Menghitung nilai D
     $nilaiD = $this->hitungD($matriksTerbobot, $aPlusMinus['A+'], $aPlusMinus['A-']);

     $nilaiV = $this->hitungV($nilaiD);


        // Mengirimkan variabel ke view
        return view('Admin.pages.penilaian.topsis', compact('pembagi', 'matriksTernormalisasi', 'matriksTerbobot','aPlusMinus','nilaiD','nilaiV'));
    }

    public function hitungPembagi()
    {
        // Ambil semua data penilaian
        $penilaians = Penilaian::all();

        // Inisialisasi array untuk menyimpan pembagi untuk setiap kriteria
        $pembagi = [];

        // Loop melalui setiap kriteria
        foreach (array_keys($this->kriteria) as $kriteria) {
            // Hitung jumlah kuadrat untuk kriteria saat ini
            $jumlahKuadrat = $penilaians->sum(function ($penilaian) use ($kriteria) {
                return pow($penilaian->$kriteria, 2);
            });

            // Hitung pembagi (akar kuadrat dari total jumlah kuadrat)
            $pembagi[$kriteria] = sqrt($jumlahKuadrat);
        }

        // Sekarang Anda memiliki pembagi untuk setiap kriteria
        return $pembagi;
    }

    public function hitungMatriksTernormalisasi($pembagi)
    {
        // Ambil semua data penilaian
        $penilaians = Penilaian::all();

        // Inisialisasi array untuk menyimpan matriks ternormalisasi
        $matriksTernormalisasi = [];

        // Loop melalui setiap penilaian
        foreach ($penilaians as $penilaian) {
            // Inisialisasi array untuk menyimpan nilai ternormalisasi untuk penilaian saat ini
            $nilaiTernormalisasi = [];

            // Loop melalui setiap kriteria
            foreach (array_keys($this->kriteria) as $kriteria) {
                // Hitung nilai ternormalisasi
                $nilaiTernormalisasi[$kriteria] = $penilaian->$kriteria / $pembagi[$kriteria];
            }

            // Simpan nilai ternormalisasi dalam array matriks ternormalisasi
            $matriksTernormalisasi[$penilaian->id] = $nilaiTernormalisasi;
        }

        // Kembalikan array matriks ternormalisasi
        return $matriksTernormalisasi;
    }

    public function hitungMatriksTerbobot($matriksTernormalisasi)
    {
        // Ambil bobot dari tabel kriteria
        $kriterias = Kriteria::all()->pluck('bobot', 'nama_kriteria')->toArray();
    
        // Inisialisasi array untuk menyimpan matriks ternormalisasi terbobot
        $matriksTerbobot = [];
    
        // Loop melalui setiap penilaian dalam matriks ternormalisasi
        foreach ($matriksTernormalisasi as $id => $nilaiTernormalisasi) {
            // Inisialisasi array untuk menyimpan nilai terbobot untuk penilaian saat ini
            $nilaiTerbobot = [];
    
            // Loop melalui setiap kriteria
            foreach ($this->kriteria as $kriteriaKey => $kriteriaValue) {
                // Ambil bobot untuk kriteria saat ini dari array kriterias
                $bobot = $kriterias[$kriteriaValue] ?? 0; // Jika bobot tidak ditemukan, gunakan nilai default 0
    
                // Hitung nilai terbobot
                $nilaiTerbobot[$kriteriaKey] = $nilaiTernormalisasi[$kriteriaKey] * $bobot;
            }
    
            // Simpan nilai terbobot dalam array matriks terbobot
            $matriksTerbobot[$id] = $nilaiTerbobot;
        }
    
        // Kembalikan array matriks terbobot
        return $matriksTerbobot;
    }
    public function hitungAPlusMinus($matriksTerbobot)
    {
        // Inisialisasi array untuk menyimpan nilai A+ dan A-
        $aPlus = [];
        $aMinus = [];
    
        // Loop melalui setiap kriteria
        foreach ($this->kriteria as $kriteriaKey => $kriteriaValue) {
            // Ambil nilai untuk kriteria saat ini dari matriks terbobot
            $values = array_column($matriksTerbobot, $kriteriaKey);
    
            // Pastikan array nilai tidak kosong sebelum menghitung max/min
            if (!empty($values)) {
                // Jika kriteria adalah 'Benefit', maka A+ adalah nilai maksimum, dan A- adalah nilai minimum
                if ($this->atributKriteria($kriteriaValue) == 'Benefit') {
                    $aPlus[$kriteriaKey] = max($values);
                    $aMinus[$kriteriaKey] = min($values);
                } else { // Jika kriteria adalah 'Cost', maka A+ adalah nilai minimum, dan A- adalah nilai maksimum
                    $aPlus[$kriteriaKey] = min($values);
                    $aMinus[$kriteriaKey] = max($values);
                }
            } else {
                // Tambahkan penanganan untuk kasus nilai kosong
                $aPlus[$kriteriaKey] = 0; // Atau nilai default lainnya
                $aMinus[$kriteriaKey] = 0; // Atau nilai default lainnya
            }
        }
    
        // Kembalikan array nilai A+ dan A-
        return ['A+' => $aPlus, 'A-' => $aMinus];
    }
    
    // Fungsi tambahan untuk mendapatkan atribut kriteria dari database
    private function atributKriteria($namaKriteria)
    {
        $kriteria = Kriteria::where('nama_kriteria', $namaKriteria)->first();
        return $kriteria ? $kriteria->atribut : null;
    }
    
    public function hitungD($matriksTerbobot, $aPlus, $aMinus)
{
    $dPlus = [];
    $dMinus = [];

    foreach ($matriksTerbobot as $id => $nilaiTerbobot) {
        $totalPlus = 0;
        $totalMinus = 0;

        foreach ($nilaiTerbobot as $kriteria => $nilai) {
            // Hitung total kuadrat selisih ke solusi ideal positif (A+)
            $totalPlus += pow($nilai - $aPlus[$kriteria], 2);
            // Hitung total kuadrat selisih ke solusi ideal negatif (A-)
            $totalMinus += pow($nilai - $aMinus[$kriteria], 2);
        }

        // Hitung D+ dan D- menggunakan akar kuadrat dari total kuadrat selisih
        $dPlus[$id] = sqrt($totalPlus);
        $dMinus[$id] = sqrt($totalMinus);
    }

    return ['D+' => $dPlus, 'D-' => $dMinus];
}

    public function hitungV($nilaiD)
{
    $nilaiV = [];

    foreach ($nilaiD['D+'] as $id => $dPlusValue) {
        $dMinusValue = $nilaiD['D-'][$id];
        $nilaiV[$id] = $dMinusValue / ($dPlusValue + $dMinusValue);
    }

    return $nilaiV;
}
    


    
 
}
    
