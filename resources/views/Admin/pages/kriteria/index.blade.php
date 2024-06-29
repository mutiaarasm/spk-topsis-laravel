@extends('layout.base')

@section('title', 'Data Kriteria')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Data Kriteria</h1>
    <div class="row">
        <div class="col-md-6">
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Data Kriteria</li>
            </ol>
        </div>
        <div class="col-md-6 d-flex justify-content-end align-items-center">
            <a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-2">Tambah Kriteria</a>
        </div>
    </div>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Kriteria
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Atribut</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kriterias as $index => $kriteria)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $kriteria->kode_kriteria }}</td>
                        <td>{{ $kriteria->nama_kriteria }}</td>
                        <td>{{ $kriteria->bobot }}</td>
                        <td>{{ $kriteria->atribut }}</td>
                        <td>
                            <a href="{{ route('kriteria.show', $kriteria->id) }}" class="btn btn-info">Sub Kriteria</a>
                            <a href="{{ route('kriteria.edit', $kriteria->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('kriteria.destroy', $kriteria->id) }}" method="POST" style="display:inline-block;">
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
</div>
@endsection
