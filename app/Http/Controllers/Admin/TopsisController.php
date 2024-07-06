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
        $pembagi = $this->hitungPembagi();
        $matriksTernormalisasi = $this->hitungMatriksTernormalisasi($pembagi);
        $matriksTerbobot = $this->hitungMatriksTerbobot($matriksTernormalisasi);
        $aPlusMinus = $this->hitungAPlusMinus($matriksTerbobot);
        $nilaiD = $this->hitungD($matriksTerbobot, $aPlusMinus['A+'], $aPlusMinus['A-']);
        $nilaiV = $this->hitungV($nilaiD);
        $ranking = $this->hitungRanking($nilaiV);

        // Mengirimkan variabel ke view
        return view('Admin.pages.penilaian.topsis', compact('pembagi', 'matriksTernormalisasi', 'matriksTerbobot', 'aPlusMinus', 'nilaiD', 'nilaiV','ranking'));
    }

    public function hitungPembagi()
    {
        $penilaians = Penilaian::with('nasabah')->get();
        $pembagi = [];

        foreach (array_keys($this->kriteria) as $kriteria) {
            $jumlahKuadrat = $penilaians->sum(function ($penilaian) use ($kriteria) {
                return pow($penilaian->$kriteria, 2);
            });
            $pembagi[$kriteria] = sqrt($jumlahKuadrat);
        }

        return $pembagi;
    }

    public function hitungMatriksTernormalisasi($pembagi)
    {
        $penilaians = Penilaian::with('nasabah')->get();
        $matriksTernormalisasi = [];

        foreach ($penilaians as $penilaian) {
            $nilaiTernormalisasi = [];
            foreach (array_keys($this->kriteria) as $kriteria) {
                $nilaiTernormalisasi[$kriteria] = $penilaian->$kriteria / $pembagi[$kriteria];
            }
            $matriksTernormalisasi[] = [
                'id' => $penilaian->id,
                'nama' => $penilaian->nasabah->nama,
                'values' => $nilaiTernormalisasi
            ];
        }

        return $matriksTernormalisasi;
    }

    public function hitungMatriksTerbobot($matriksTernormalisasi)
    {
        $kriterias = Kriteria::all()->pluck('bobot', 'nama_kriteria')->toArray();
        $matriksTerbobot = [];

        foreach ($matriksTernormalisasi as $item) {
            $nilaiTerbobot = [];
            foreach ($this->kriteria as $kriteriaKey => $kriteriaValue) {
                $bobot = $kriterias[$kriteriaValue] ?? 0;
                $nilaiTerbobot[$kriteriaKey] = $item['values'][$kriteriaKey] * $bobot;
            }
            $matriksTerbobot[] = [
                'id' => $item['id'],
                'nama' => $item['nama'],
                'values' => $nilaiTerbobot
            ];
        }

        return $matriksTerbobot;
    }

    public function hitungAPlusMinus($matriksTerbobot)
    {
        $aPlus = [];
        $aMinus = [];

        foreach ($this->kriteria as $kriteriaKey => $kriteriaValue) {
            $values = array_column(array_column($matriksTerbobot, 'values'), $kriteriaKey);

            if (!empty($values)) {
                if ($this->atributKriteria($kriteriaValue) == 'Benefit') {
                    $aPlus[$kriteriaKey] = max($values);
                    $aMinus[$kriteriaKey] = min($values);
                } else {
                    $aPlus[$kriteriaKey] = min($values);
                    $aMinus[$kriteriaKey] = max($values);
                }
            } else {
                $aPlus[$kriteriaKey] = 0;
                $aMinus[$kriteriaKey] = 0;
            }
        }

        return ['A+' => $aPlus, 'A-' => $aMinus];
    }

    private function atributKriteria($namaKriteria)
    {
        $kriteria = Kriteria::where('nama_kriteria', $namaKriteria)->first();
        return $kriteria ? $kriteria->atribut : null;
    }

    public function hitungD($matriksTerbobot, $aPlus, $aMinus)
    {
        $dPlus = [];
        $dMinus = [];

        foreach ($matriksTerbobot as $item) {
            $totalPlus = 0;
            $totalMinus = 0;

            foreach ($item['values'] as $kriteria => $nilai) {
                $totalPlus += pow($nilai - $aPlus[$kriteria], 2);
                $totalMinus += pow($nilai - $aMinus[$kriteria], 2);
            }

            $dPlus[] = [
                'id' => $item['id'],
                'nama' => $item['nama'],
                'd_plus' => sqrt($totalPlus)
            ];
            $dMinus[] = [
                'id' => $item['id'],
                'nama' => $item['nama'],
                'd_minus' => sqrt($totalMinus)
            ];
        }

        return ['D+' => $dPlus, 'D-' => $dMinus];
    }

    public function hitungV($nilaiD)
    {
        $nilaiV = [];

        foreach ($nilaiD['D+'] as $index => $dPlusValue) {
            $dMinusValue = $nilaiD['D-'][$index]['d_minus'];
            $nilaiV[] = [
                'id' => $nilaiD['D+'][$index]['id'],
                'nama' => $nilaiD['D+'][$index]['nama'],
                'v_value' => $dMinusValue / ($dPlusValue['d_plus'] + $dMinusValue)
            ];
        }

        return $nilaiV;
    }
    public function hitungRanking($nilaiV)
    {
        // Urutkan nilai V dari terbesar ke terkecil
        usort($nilaiV, function($a, $b) {
            return $b['v_value'] <=> $a['v_value'];
        });

        // Tambahkan ranking berdasarkan urutan
        foreach ($nilaiV as $index => $item) {
            $nilaiV[$index]['ranking'] = $index + 1;
        }

        return $nilaiV;
    }
}
    
