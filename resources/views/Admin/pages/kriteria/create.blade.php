@extends('layout.base')

@section('title', 'Tambah Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Kriteria</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Tambah Kriteria
        </div>
        <div class="card-body">
            <form action="{{ route('kriteria.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kode_kriteria">Kode Kriteria</label>
                    <input type="text" class="form-control" id="kode_kriteria" name="kode_kriteria" required>
                </div>
                <div class="form-group">
                    <label for="nama_kriteria">Nama Kriteria</label>
                    <input type="text" class="form-control" id="nama_kriteria" name="nama_kriteria" required>
                </div>
                <div class="form-group">
                    <label for="bobot">Bobot</label>
                    <input type="number" class="form-control" id="bobot" name="bobot" required>
                </div>
                <div class="form-group">
                    <label for="atribut">Atribut</label>
                    <select class="form-control" id="atribut" name="atribut" required>
                        <option value="Benefit">Benefit</option>
                        <option value="Cost">Cost</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary mt-2">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
