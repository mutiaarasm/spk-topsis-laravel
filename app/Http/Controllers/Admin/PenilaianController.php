<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use App\Models\Penilaian;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class PenilaianController extends Controller
{
    public function indexPage()
    {
        $penilaians = Penilaian::with('nasabah')->get();
        return view('Admin.pages.penilaian.index', compact('penilaians'));
    }

    public function create()
    {
        $nasabahs = Nasabah::all();
        $subkriteriasPendapatan = SubKriteria::where('kriteria_id', 1)->get();
        $subkriteriasJumlahTanggungan = SubKriteria::where('kriteria_id', 2)->get();
        $subkriteriasJaminan = SubKriteria::where('kriteria_id', 3)->get();
        $subkriteriasJumlahPinjaman = SubKriteria::where('kriteria_id', 4)->get();
        $subkriteriasLamaAngsuran = SubKriteria::where('kriteria_id', 5)->get();

        return view('Admin.pages.penilaian.create', compact('nasabahs', 'subkriteriasPendapatan', 'subkriteriasJumlahTanggungan', 'subkriteriasJaminan', 'subkriteriasJumlahPinjaman', 'subkriteriasLamaAngsuran'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nasabah_id' => 'required',
            'pendapatan' => 'required',
            'jumlah_tanggungan' => 'required',
            'jaminan' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required',
        ]);

        Penilaian::create([
            'nasabah_id' => $request->nasabah_id,
            'pendapatan' => $request->pendapatan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jaminan' => $request->jaminan,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'lama_angsuran' => $request->lama_angsuran,
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $nasabahs = Nasabah::all();
        $subkriteriasPendapatan = SubKriteria::where('kriteria_id', 1)->get();
        $subkriteriasJumlahTanggungan = SubKriteria::where('kriteria_id', 2)->get();
        $subkriteriasJaminan = SubKriteria::where('kriteria_id', 3)->get();
        $subkriteriasJumlahPinjaman = SubKriteria::where('kriteria_id', 4)->get();
        $subkriteriasLamaAngsuran = SubKriteria::where('kriteria_id', 5)->get();

        return view('Admin.pages.penilaian.edit', compact('penilaian', 'nasabahs', 'subkriteriasPendapatan', 'subkriteriasJumlahTanggungan', 'subkriteriasJaminan', 'subkriteriasJumlahPinjaman', 'subkriteriasLamaAngsuran'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nasabah_id' => 'required',
            'pendapatan' => 'required',
            'jumlah_tanggungan' => 'required',
            'jaminan' => 'required',
            'jumlah_pinjaman' => 'required',
            'lama_angsuran' => 'required',
        ]);

        $penilaian = Penilaian::findOrFail($id);
        $penilaian->update([
            'nasabah_id' => $request->nasabah_id,
            'pendapatan' => $request->pendapatan,
            'jumlah_tanggungan' => $request->jumlah_tanggungan,
            'jaminan' => $request->jaminan,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'lama_angsuran' => $request->lama_angsuran,
        ]);

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil diupdate.');
    }

    public function destroy($id)
    {
        $penilaian = Penilaian::findOrFail($id);
        $penilaian->delete();

        return redirect()->route('penilaian.index')->with('success', 'Penilaian berhasil dihapus.');
    }

    
}
