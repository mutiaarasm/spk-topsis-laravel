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
       
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:nasabahs,nik',
        ]);

     
        Nasabah::create($request->all());

        
        return redirect()->route('dataNasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        return view('admin.pages.dataNasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
    {
       
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:nasabahs,nik,' . $id,
        ]);

      
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->update($request->all());

        
        return redirect()->route('dataNasabah.index')->with('success', 'Nasabah berhasil diupdate.');
    }

    public function destroy($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $nasabah->delete();

        
        return redirect()->route('dataNasabah.index')->with('success', 'Nasabah berhasil dihapus.');
    }
}
