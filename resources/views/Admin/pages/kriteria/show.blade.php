@extends('layout.base')

@section('title', 'Detail Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Detail Kriteria</h1>
    <div class="row">
        <div class="col-md-6">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}">Data Kriteria</a></li>
                <li class="breadcrumb-item active">{{ $kriteria->nama_kriteria }}</li>
            </ol>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-warning mb-2">Edit Kriteria</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Sub Kriteria untuk {{ $kriteria->nama_kriteria }}
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Sub Kriteria</th>
                        <th>Nilai Bobot</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($subkriterias as $index => $subkriteria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $subkriteria->subkriteria }}</td>
                        <td>{{ $subkriteria->nilai}}</td>
                        <td>
                        <a href="{{ route('subkriteria.edit', [$kriteria->id, $subkriteria->id]) }}" class="btn btn-warning">Edit</a>
                           <form action="{{ route('subkriteria.destroy', [$kriteria->id, $subkriteria->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                             @method('DELETE')
                             <button type="submit" class="btn btn-danger">Hapus</button>
                             </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Formulir untuk menambahkan sub kriteria -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Tambah Sub Kriteria
        </div>
        <div class="card-body">
            <form action="{{ route('subkriteria.store', $kriteria->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="subkriteria" class="form-label">Nama Sub Kriteria</label>
                    <input type="text" class="form-control" id="subkriteria" name="subkriteria">
                </div>
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai Bobot</label>
                    <input type="number" class="form-control" id="nilai" name="nilai">
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
