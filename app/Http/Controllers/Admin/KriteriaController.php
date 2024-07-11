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

    public function create()
    {
        return view('admin.pages.kriteria.create');
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'kode_kriteria' => 'required|string|max:255',
            'nama_kriteria' => 'required|string|max:255',
            'bobot' => 'required|integer',
            'atribut' => 'required',
        ]);

        
        Kriteria::create($request->all());

        
        return redirect()->route('kriteria.index')->with('success', 'Kriteria created successfully.');
    }

    public function edit($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        return view('Admin.pages.kriteria.edit', compact('kriteria'));
    }

    
    public function update(Request $request, $id)
{
    
    $request->validate([
        'kode_kriteria' => 'required|string|max:255',
        'nama_kriteria' => 'required|string|max:255',
        'bobot' => 'required|integer',
        'atribut' => 'required|string|max:255',
    ]);

    $kriteria = Kriteria::findOrFail($id);
    $kriteria->update($request->all());


    return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diupdate.');
}

    
    public function destroy(Kriteria $kriteria)
    {
        
        $kriteria->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('kriteria.index')->with('success', 'Kriteria deleted successfully.');
    }
    public function show($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $subkriterias = SubKriteria::where('kriteria_id', $id)->get();
        return view('Admin.pages.kriteria.show', compact('kriteria', 'subkriterias'));
    }

}
