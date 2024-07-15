@extends('layouts.admin')

@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Simple Additive Weighting (SAW)') }}</h1>

    <!-- Langkah 1: Normalisasi Nilai -->
    <div class="card shadow mb-4">
        <div class="card-header">Normalisasi Nilai</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            @foreach ($kriterias as $kriteria)
                                <th>{{ $kriteria->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($alternatifs as $alternatif)
                            <tr>
                                <td>{{ $alternatif->nama_alternatif }}</td>
                                @foreach ($kriterias as $kriteria)
                                    @php
                                        $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                                        $nilai = $penilaian ? floatval($penilaian->nilai) : 0.0;
                                        if ($kriteria->jenis_kriteria == 'Benefit') {
                                            $nilaiNormalized = $nilai / max($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray());
                                        } else {
                                            $nilaiNormalized = min($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray()) / $nilai;
                                        }
                                    @endphp
                                    <td>{{ number_format($nilaiNormalized, 4) }}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 2: Menghitung Skor Akhir -->
    <div class="card shadow mb-4">
        <div class="card-header">Menghitung Skor Akhir</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Skor Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $skorAkhirArray = [];
                            foreach ($alternatifs as $alternatif) {
                                $skorAkhir = 0;
                                foreach ($kriterias as $kriteria) {
                                    $penilaian = $penilaians->where('alternatif_id', $alternatif->id)->where('kriteria_id', $kriteria->id)->first();
                                    $nilai = $penilaian ? floatval($penilaian->nilai) : 0.0;
                                    if ($kriteria->jenis_kriteria == 'Benefit') {
                                        $nilaiNormalized = $nilai / max($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray());
                                    } else {
                                        $nilaiNormalized = min($penilaians->where('kriteria_id', $kriteria->id)->pluck('nilai')->toArray()) / $nilai;
                                    }
                                    $skorAkhir += $nilaiNormalized * floatval($kriteria->bobot);
                                }
                                $skorAkhirArray[$alternatif->nama_alternatif] = $skorAkhir;
                            }
                        @endphp
                        @foreach ($skorAkhirArray as $namaAlternatif => $nilaiAkhir)
                            <tr>
                                <td>{{ $namaAlternatif }}</td>
                                <td>{{ number_format($nilaiAkhir, 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Langkah 3: Perankingan -->
    <div class="card shadow mb-4">
        <div class="card-header">Peringkat</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nama Alternatif</th>
                            <th>Skor Akhir</th>
                            <th>Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            arsort($skorAkhirArray);
                            $rank = 1;
                        @endphp
                        @foreach ($skorAkhirArray as $namaAlternatif => $nilaiAkhir)
                            <tr>
                                <td>{{ $namaAlternatif }}</td>
                                <td>{{ number_format($nilaiAkhir, 4) }}</td>
                                <td>{{ $rank++ }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
