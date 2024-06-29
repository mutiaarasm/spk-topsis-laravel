@extends('layout.base')

@section('title', 'Edit Penilaian')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Edit Penilaian</h1>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-edit me-1"></i>
            Form Edit Penilaian
        </div>
        <div class="card-body">
            <form action="{{ route('penilaian.update', $penilaian->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label for="nasabah_id" class="form-label">Nama Nasabah</label>
                    <select class="form-control" id="nasabah_id" name="nasabah_id">
                        @foreach($nasabahs as $nasabah)
                            <option value="{{ $nasabah->id }}" {{ $nasabah->id == $penilaian->nasabah_id ? 'selected' : '' }}>{{ $nasabah->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="pendapatan" class="form-label">Pendapatan</label>
                    <select class="form-control" id="pendapatan" name="pendapatan">
                        @foreach($subkriteriasPendapatan as $subkriteria)
                            <option value="{{ $subkriteria->nilai }}" {{ $subkriteria->nilai == $penilaian->pendapatan ? 'selected' : '' }}>{{ $subkriteria->subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_tanggungan" class="form-label">Jumlah Tanggungan</label>
                    <select class="form-control" id="jumlah_tanggungan" name="jumlah_tanggungan">
                        @foreach($subkriteriasJumlahTanggungan as $subkriteria)
                            <option value="{{ $subkriteria->nilai }}" {{ $subkriteria->nilai == $penilaian->jumlah_tanggungan ? 'selected' : '' }}>{{ $subkriteria->subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jaminan" class="form-label">Jaminan</label>
                    <select class="form-control" id="jaminan" name="jaminan">
                        @foreach($subkriteriasJaminan as $subkriteria)
                            <option value="{{ $subkriteria->nilai }}" {{ $subkriteria->nilai == $penilaian->jaminan ? 'selected' : '' }}>{{ $subkriteria->subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_pinjaman" class="form-label">Jumlah Pinjaman</label>
                    <select class="form-control" id="jumlah_pinjaman" name="jumlah_pinjaman">
                        @foreach($subkriteriasJumlahPinjaman as $subkriteria)
                            <option value="{{ $subkriteria->nilai }}" {{ $subkriteria->nilai == $penilaian->jumlah_pinjaman ? 'selected' : '' }}>{{ $subkriteria->subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="lama_angsuran" class="form-label">Lama Angsuran</label>
                    <select class="form-control" id="lama_angsuran" name="lama_angsuran">
                        @foreach($subkriteriasLamaAngsuran as $subkriteria)
                            <option value="{{ $subkriteria->nilai }}" {{ $subkriteria->nilai == $penilaian->lama_angsuran ? 'selected' : '' }}>{{ $subkriteria->subkriteria }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
