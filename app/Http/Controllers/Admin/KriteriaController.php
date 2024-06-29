<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function indexPage()
    {
        $kriterias = Kriteria::all();
        return view('admin.pages.kriteria.index', compact('kriterias'));
    }

    // Menampilkan form tambah kriteria
    public function create()
    {
        return view('admin.pages.kriteria.create');
    }

    // Menyimpan kriteria baru
    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'kode_kriteria' => 'required|string|max:255',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
            'atribut' => 'required',
        ]);

        // Membuat kriteria baru
        Kriteria::create($request->all());

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.index')->with('success', 'Kriteria created successfully.');
    }

    // Menampilkan form edit kriteria
    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('Admin.pages.kriteria.edit', compact('kriteria'));
    }

    // Mengupdate kriteria yang ada
    public function update(Request $request, $id)
{
    // Validasi data
    $request->validate([
        'kode_kriteria' => 'required|string|max:255',
        'nama_kriteria' => 'required|string|max:255',
        'bobot' => 'required|integer',
        'atribut' => 'required|string|max:255',
    ]);

    // Update data kriteria
    $kriteria = Kriteria::findOrFail($id);
    $kriteria->update($request->all());

    // Redirect ke halaman data kriteria dengan pesan sukses
    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate.');
}

    // Menghapus kriteria
    public function destroy(Kriteria $kriteria)
    {
        // Menghapus kriteria
        $kriteria->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.kriteria.index')->with('success', 'Kriteria deleted successfully.');
    }
    public function show($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $subkriterias = SubKriteria::where('kriteria_id', $id)->get();
        return view('admin.pages.kriteria.show', compact('kriteria', 'subkriterias'));
    }

}
