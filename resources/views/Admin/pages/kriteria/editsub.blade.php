@extends('layout.base')

@section('title', 'Edit Sub Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Sub Kriteria</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('kriteria.index') }}">Data Kriteria</a></li>
        <li class="breadcrumb-item active">{{ $kriteria->nama_kriteria }}</li>
    </ol>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Edit Sub Kriteria
        </div>
        <div class="card-body">
            <form action="{{ route('subkriteria.update', [$kriteria->id, $subkriteria->id]) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="subkriteria" class="form-label">Nama Sub Kriteria</label>
                    <input type="text" class="form-control" id="subkriteria" name="subkriteria" value="{{ $subkriteria->subkriteria }}" required>
                </div>
                <div class="mb-3">
                    <label for="nilai" class="form-label">Nilai Bobot</label>
                    <input type="number" class="form-control" id="nilai" name="nilai" value="{{ $subkriteria->nilai }}" required>
                </div>
                <button type="submit" class="btn btn-success">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
