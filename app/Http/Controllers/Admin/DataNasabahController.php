<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Nasabah;
use Illuminate\Http\Request;

class DataNasabahController extends Controller
{
    public function indexPage()
    {
        $nasabahs = Nasabah::all();
        return view('admin.pages.dataNasabah.index', compact('nasabahs'));
    }

    public function create()
    {
        return view('admin.pages.dataNasabah.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:nasabahs,nik',
        ]);

        // Simpan data nasabah
        Nasabah::create($request->all());

        // Redirect ke halaman data nasabah dengan pesan sukses
        return redirect()->route('dataNasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return view('admin.pages.dataNasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:nasabahs,nik,' . $id,
        ]);

        // Update data nasabah
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->update($request->all());

        // Redirect ke halaman data nasabah dengan pesan sukses
        return redirect()->route('dataNasabah.index')->with('success', 'Nasabah berhasil diupdate.');
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->delete();

        // Redirect ke halaman data nasabah dengan pesan sukses
        return redirect()->route('dataNasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}
