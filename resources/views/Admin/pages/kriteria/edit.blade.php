@extends('layout.base')

@section('title', 'Edit Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Kriteria</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Kriteria
        </div>
        <div class="card-body">
            <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="kode_kriteria">Kode Kriteria</label>
                    <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" value="{{ $kriteria->kode_kriteria }}" required>
                </div>
                <div class="form-group">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" value="{{ $kriteria->nama_kriteria }}" required>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="number" class="form-control" id="bobot" name="bobot" value="{{ $kriteria->bobot }}" required>
                </div>
                <div class="form-group">
                    <label for="atribut">Atribut</label>
                    <input type="text" class="form-control" id="atribut" name="atribut" value="{{ $kriteria->atribut }}" required>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
