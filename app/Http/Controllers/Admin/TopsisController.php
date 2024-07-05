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
        
        $penilaians = Penilaian::all();
        $pembagi = [];

        foreach (array_keys($this->kriteria) as $kriteria) {
            
            $jumlahKuadrat = $penilaians->sum(function ($penilaian) use ($kriteria) {
                return pow($penilaian->$kriteria, 2); //bikin penjumlahan+pangkat2
            });
            $pembagi[$kriteria] = sqrt($jumlahKuadrat);  //akar dari jumlahkuadrat
        }

        return $pembagi;
    }

    public function hitungMatriksTernormalisasi($pembagi)
    {
        
        $penilaians = Penilaian::all();

        $matriksTernormalisasi = []; //nyimpen nilai yg udh di normaliasasi buat ditampilin

        foreach ($penilaians as $penilaian) {
            $nilaiTernormalisasi = [];
            foreach (array_keys($this->kriteria) as $kriteria) {
                $nilaiTernormalisasi[$kriteria] = $penilaian->$kriteria / $pembagi[$kriteria]; //penilaian/pembagi
            }
            $matriksTernormalisasi[$penilaian->id] = $nilaiTernormalisasi;
        }
        return $matriksTernormalisasi;
    }

    public function hitungMatriksTerbobot($matriksTernormalisasi)
    {
        
        $kriterias = Kriteria::all()->pluck('bobot', 'nama_kriteria')->toArray(); //aray asosiatif
    
        $matriksTerbobot = [];
    
        foreach ($matriksTernormalisasi as $id => $nilaiTernormalisasi) {
            $nilaiTerbobot = [];
    
            foreach ($this->kriteria as $kriteriaKey => $kriteriaValue) {
                $bobot = $kriterias[$kriteriaValue] ?? 0; // Jika bobot tidak ditemukan, gunakan nilai default 0
    
                $nilaiTerbobot[$kriteriaKey] = $nilaiTernormalisasi[$kriteriaKey] * $bobot;//normalisasi * bobot
            }
    
            $matriksTerbobot[$id] = $nilaiTerbobot;
        }
    
        return $matriksTerbobot;
    }
    public function hitungAPlusMinus($matriksTerbobot)
    {
        $aPlus = [];
        $aMinus = [];
    
        foreach ($this->kriteria as $kriteriaKey => $kriteriaValue) {
        
            $values = array_column($matriksTerbobot, $kriteriaKey);
    
            if (!empty($values)) {
                
                if ($this->atributKriteria($kriteriaValue) == 'Benefit') {
                    $aPlus[$kriteriaKey] = max($values); // kl benefit max
                    $aMinus[$kriteriaKey] = min($values); // kl benefit min
                } else { 
                    $aPlus[$kriteriaKey] = min($values); //kalo cost 
                    $aMinus[$kriteriaKey] = max($values); // kalo cost
                }
            } else {
                
                $aPlus[$kriteriaKey] = 0; // Atau nilai default lainnya =0
                $aMinus[$kriteriaKey] = 0; 
            }
        }
    
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
        
            $totalPlus += pow($nilai - $aPlus[$kriteria], 2); //terbobot-nilai a ,pngkat dua
        
            $totalMinus += pow($nilai - $aMinus[$kriteria], 2);
        }

        
        $dPlus[$id] = sqrt($totalPlus); //akar kuadrat
        $dMinus[$id] = sqrt($totalMinus);
    }

    return ['D+' => $dPlus, 'D-' => $dMinus];
}

    public function hitungV($nilaiD)
{
    $nilaiV = [];

    foreach ($nilaiD['D+'] as $id => $dPlusValue) {
        $dMinusValue = $nilaiD['D-'][$id];
        $nilaiV[$id] = $dMinusValue / ($dPlusValue + $dMinusValue); //d-/(d+ + d-)
    }

    return $nilaiV;
}
    
 
}
    
