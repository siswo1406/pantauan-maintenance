@extends('dashboard.base')

@section('title', 'REPORT BATTERY')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <i class="cil-description"></i> {{ __('REPORT BATTERY') }}
                            <button type="button" class="btn btn-primary float-lg-right ml-5" onclick="window.history.go(-1)">KEMBALI</button>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form class="row d-flex justify-content-start form-inline" action="{{ route('report.reportBattery') }}" method="get" style="margin-top:10px; margin-bottom: 10px">@csrf
                            <div class="form-group col-md-12 mb-3">
                                <div class="d-inline-flex col-md-1 col-form-label">
                                    <label class="form-label mr-3" for="bulan">BULAN</label>
                                </div>
                                <select class="form-control ml-2 mr-1" name="bulanFilter" id="bulanFilter">
                                    @if (!empty($bulanFilter))
                                        <option value="{{ $bulanFilter }}" selected hidden>{{ array_search($bulanFilter, $months) }}</option>
                                    @endif
                                    <option value="" hidden>PILIH</option>
                                    @foreach ($months as $monthName => $monthNumber)
                                        <option value="{{ $monthNumber }}">{{ $monthName }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <div class="d-inline-flex col-md-1 col-form-label">
                                    <label class="form-label mr-3" for="tahun">TAHUN</label>
                                </div>
                                <select class="form-control ml-2 mr-1" name="tahunFilter" id="tahunFilter">
                                    @if (!empty($tahunFilter))
                                        <option value="{{ $tahunFilter }}" selected hidden>{{ $tahunFilter }}</option>
                                    @endif
                                    <option value="" hidden>PILIH</option>
                                    @for ($year = $startYear; $year >= $endYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <div class="d-inline-flex col-md-1 col-form-label"></div>
                                <button class="btn btn-primary ml-2 mr-1" type="submit">{{ __('TAMPIL') }}</button>
                            </div>
                        </form>
                        @if (!empty($reportBattery))
                            <table class="table table-responsive table-hover table-sm table-bordered" style="max-height: 500px; overflow-x: auto; overflow-y: auto">
                                <thead class="thead-dark">
                                    <tr style="text-align: center">
                                        <th> NO </th>
                                        <th> CLUSTER </th>
                                        <th> PLAN H3L </th>
                                        <th> ACHIEVEMENT </th>
                                        <th> GAP </th>
                                        <th> % </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reportBattery as $data)
                                        <tr style="text-align:center">
                                            <td>{{ ++$noBattery }}</td>
                                            <td>{{ $data->cluster }}</td>
                                            <td>{{ $data->plan_h3l }}</td>
                                            <td>{{ $data->achievement }}</td>
                                            <td>{{ $data->gap }}</td>
                                            @php
                                                if ($data->percent <= 25) {
                                                    $warna = '#FF9999'; // Merah Muda
                                                } elseif ($data->percent <= 50) {
                                                    $warna = '#FFD699'; // Jingga Muda
                                                } elseif ($data->percent <= 75) {
                                                    $warna = '#FFFF9E'; // Kuning Muda
                                                } else {
                                                    $warna = '#99FF99'; // Hijau Muda
                                                }
                                            @endphp
                                            <td style="background-color: {{ $warna }}">{{ round($data->percent, 1).'%' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('javascript')
<script>
</script>
@endsection

