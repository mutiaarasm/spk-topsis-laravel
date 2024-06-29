@extends('layout.base')

@section('title', 'Edit Nasabah')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Nasabah</h1>
    <div class="card mb-4">
        <div class="card-body">
            <form action="{{ route('dataNasabah.update', $nasabah->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="nama" name="nama" value="{{ $nasabah->nama }}" required>
                </div>
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $nasabah->alamat }}" required>
                </div>
                <div class="mb-3">
                    <label for="nik" class="form-label">NIK</label>
                    <input type="text" class="form-control" id="nik" name="nik" value="{{ $nasabah->nik }}" required>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
