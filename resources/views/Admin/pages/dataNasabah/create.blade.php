@extends('layout.base')
@section('title', 'Tambah Nasabah')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Tambah Nasabah</h1>
    <div class="row">
        <div class="col-md-6">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="">Data Nasabah</a></li>
                <li class="breadcrumb-item active">Tambah Nasabah</li>
            </ol>
        </div>
    </div>

    <!-- Form Tambah Nasabah -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus me-1"></i>
            Tambah Nasabah
        </div>
        <div class="card-body">
            <form action="{{ route('dataNasabah.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="alamat">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
                    @error('alamat')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group mb-3">
                    <label for="nik">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ old('nik') }}" required>
                    @error('nik')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>
        </div>
    </div>
</div>
@endsection
