@extends('layout.base')

@section('title', 'Penilaian')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Penilaian</h1>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('penilaian.create') }}" class="btn btn-success">Tambah Penilaian</a>
        <form action="{{ route('penilaian.topsis') }}" method="GET" class="ms-2">
            @csrf
            <button type="submit" class="btn btn-primary">Proses TOPSIS</button>
        </form>
    </div>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Data Penilaian
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Nasabah</th>
                        <th>Pendapatan</th>
                        <th>Jumlah Tanggungan</th>
                        <th>Jaminan</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Lama Angsuran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($penilaians as $index => $penilaian)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $penilaian->nasabah->nama }}</td>
                        <td>{{ $penilaian->pendapatan }}</td>
                        <td>{{ $penilaian->jumlah_tanggungan }}</td>
                        <td>{{ $penilaian->jaminan }}</td>
                        <td>{{ $penilaian->jumlah_pinjaman }}</td>
                        <td>{{ $penilaian->lama_angsuran}}</td>
                        <td>
                            <a href="{{ route('penilaian.edit', $penilaian->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('penilaian.destroy', $penilaian->id) }}" method="POST" style="display:inline-block;">
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
