@extends('layout.base')

@section('title', 'Perhitungan TOPSIS')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Perhitungan TOPSIS</h1>

    <!-- Langkah 1: Mencari Pembagi -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-calculator me-1"></i>
            Langkah 1: Mencari Pembagi
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Pembagi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pembagi as $kriteria => $value)
                    <tr>
                        <td>{{ $kriteria }}</td>
                        <td>{{ number_format($value, 3) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Langkah 2: Matriks Ternormalisasi -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Langkah 2: Matriks Ternormalisasi
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nasabah</th>
                        @foreach(array_keys($pembagi) as $k)
                        <th>{{ ucfirst($k) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriksTernormalisasi as $item)
                    <tr>
                        <td>{{ $item['nama'] }}</td>
                        @foreach($item['values'] as $value)
                        <td>{{ number_format($value, 3) }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Langkah 3: Matriks Terbobot -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-weight-hanging me-1"></i>
            Langkah 3: Matriks Terbobot
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nasabah</th>
                        @foreach(array_keys($pembagi) as $k)
                        <th>{{ ucfirst($k) }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($matriksTerbobot as $item)
                    <tr>
                        <td>{{ $item['nama'] }}</td>
                        @foreach($item['values'] as $value)
                        <td>{{ number_format($value, 3) }}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Langkah 4: A+ dan A- -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-plus-minus me-1"></i>
            Langkah 4: A+ dan A-
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>A+</th>
                        <th>A-</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($aPlusMinus['A+'] as $kriteria => $value)
                    <tr>
                        <td>{{ ucfirst($kriteria) }}</td>
                        <td>{{ number_format($value, 3) }}</td>
                        <td>{{ number_format($aPlusMinus['A-'][$kriteria], 3) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Langkah 5: Nilai D -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-square-root-alt me-1"></i>
            Langkah 5: Nilai D
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nasabah</th>
                        <th>D+</th>
                        <th>D-</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilaiD['D+'] as $index => $value)
                    <tr>
                        <td>{{ $value['nama'] }}</td>
                        <td>{{ number_format($value['d_plus'], 3) }}</td>
                        <td>{{ number_format($nilaiD['D-'][$index]['d_minus'], 3) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Langkah 6: Nilai V -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-vote-yea me-1"></i>
            Langkah 6: Nilai V
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nasabah</th>
                        <th>Nilai V</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($nilaiV as $value)
                    <tr>
                        <td>{{ $value['nama'] }}</td>
                        <td>{{ number_format($value['v_value'], 3) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- Langkah 7: Ranking -->
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-list-ol me-1"></i>
            Langkah 7: Ranking
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Nasabah</th>
                        <th>Nilai V</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ranking as $item)
                    <tr>
                        <td>{{ $item['ranking'] }}</td>
                        <td>{{ $item['nama'] }}</td>
                        <td>{{ number_format($item['v_value'], 3) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
