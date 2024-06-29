@extends('layout.base')
@section('title', 'Data Nasabah')
@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Nasabah</h1>
    <div class="row">
        <div class="col-md-6">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Nasabah</li>
            </ol>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('dataNasabah.create') }}" class="btn btn-primary mb-2">Tambah Nasabah</a>
        </div>
    </div>
    
    <!-- Tabel Data Nasabah -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Nasabah
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>NIK</th>
                        <th>Aksi</th> <!-- Kolom Aksi -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($nasabahs as $index => $n)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $n->nama }}</td>
                        <td>{{ $n->alamat }}</td>
                        <td>{{ $n->nik }}</td>
                        <td>
                            <a href="{{ route('dataNasabah.edit', $n->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dataNasabah.destroy', $n->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
