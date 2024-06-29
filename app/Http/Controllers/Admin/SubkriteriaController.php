<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;

class SubkriteriaController extends Controller
{
    public function show($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $subkriterias = SubKriteria::where('kriteria_id', $id)->get();
        return view('admin.pages.kriteria.show', compact('kriteria', 'subkriterias'));
    }

   public function store(Request $request, $kriteriaId)
    {
        $request->validate([
            'subkriteria' => 'required|string|max:255',
            'nilai' => 'required|integer',
        ]);
    
        SubKriteria::create([
            'kriteria_id' => $kriteriaId,
            'subkriteria' => $request->subkriteria,
            'nilai' => $request->nilai, // Perhatikan bahwa kolom disebut 'nilai'
        ]);
    
        return redirect()->route('kriteria.show', $kriteriaId)->with('success', 'Sub Kriteria berhasil ditambahkan.');
    }
    public function edit($kriteriaId, $subkriteriaId)
    {
        $kriteria = Kriteria::findOrFail($kriteriaId);
        $subkriteria = SubKriteria::findOrFail($subkriteriaId);

        return view('admin.pages.kriteria.editsub', compact('kriteria', 'subkriteria'));
    }

    public function update(Request $request, $kriteriaId, $subkriteriaId)
    {
        $request->validate([
            'subkriteria' => 'required|string|max:255',
            'nilai' => 'required|integer',
        ]);

        $subkriteria = SubKriteria::findOrFail($subkriteriaId);
        $subkriteria->update([
            'subkriteria' => $request->subkriteria,
            'nilai' => $request->nilai,
        ]);

        return redirect()->route('kriteria.show', $kriteriaId)->with('success', 'Sub Kriteria berhasil diupdate.');
    }
    
    public function destroy($kriteriaId, $id)
    {
        $subkriteria = SubKriteria::findOrFail($id);
        $subkriteria->delete();

        return redirect()->route('kriteria.show', $kriteriaId)->with('success', 'Sub Kriteria berhasil dihapus.');
    }
}

