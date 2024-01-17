@extends('dashboard.base')

@section('title', 'SALDO AWAL')

@section('content')
<div class="container-fluid">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <div class="card">
                    <div class="card-header">
                        <h3>
                            <i class="cil-description"></i> {{ __('TASK WORK MASTER') }}
                            <button type="button" class="btn btn-primary float-lg-right ml-5" onclick="window.history.go(-1)">KEMBALI</button>
                            <button type="button" id="template" class="btn btn-danger float-lg-right">TEMPLATE</button>
                            <button type="button" class="btn btn-success float-lg-right mr-3" data-toggle="modal" data-target="#import">UPLOAD</button>
                        </h3>
                    </div>
                    <div class="card-body">
                        <form class="row d-flex justify-content-start form-inline" action="{{ route('master.masterTaskWork') }}" method="get" style="margin-top:10px; margin-bottom: 10px">@csrf
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
                                <div class="d-inline-flex col-md-1 col-form-label">
                                    <label class="form-label mr-3" for="fmoffice">KATEGORI</label>
                                </div>
                                <select class="form-control ml-2 mr-1" name="kategoriFilter" id="kategoriFilter">
                                    @if (!empty($kategoriFilter))
                                        <option value="{{ $kategoriFilter }}" selected hidden>{{ strtoupper($kategoriFilter) }}</option>
                                    @else
                                        <option value="" selected hidden>SEMUA</option>
                                    @endif
                                    <option value="">SEMUA</option>
                                    <option value="CME">CME</option>
                                    <option value="TE">TE</option>
                                    <option value="BATTERY">BATTERY</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <div class="d-inline-flex col-md-1 col-form-label">
                                    <label class="form-label mr-3" for="fmoffice">FM OFFICE</label>
                                </div>
                                <select class="form-control ml-2 mr-1" name="fmofficeFilter" id="fmofficeFilter">
                                    @if (!empty($fmofficeFilter))
                                        <option value="{{ $fmofficeFilter }}" selected hidden>{{ strtoupper($fmofficeFilter) }}</option>
                                    @else
                                        <option value="" selected hidden>SEMUA</option>
                                    @endif
                                    <option value="">SEMUA</option>
                                    @foreach ($fmOffice as $fm)
                                        <option value="{{ $fm->fm_office }}">{{ strtoupper($fm->fm_office) }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-12 mb-3">
                                <div class="d-inline-flex col-md-1 col-form-label"></div>
                                <button class="btn btn-primary ml-2 mr-1" type="submit">{{ __('TAMPIL') }}</button>
                            </div>
                        </form>
                        @if (!empty($masterTaskWork))
                            <div>
                                Total Records: {{ count($masterTaskWork) }}
                            </div>
                            <table class="table table-responsive table-hover table-sm table-bordered" style="max-height: 500px; overflow-x: auto; overflow-y: auto">
                                <thead class="thead-dark">
                                    <tr style="text-align: center">
                                        <th> TASK ID </th>
                                        <th> OPERATE TYPE </th>
                                        <th> TASK TYPE </th>
                                        <th> TITLE </th>
                                        <th> TASK STATUS </th>
                                        <th> FM OFFICE </th>
                                        <th> ASSIGN TO FME </th>
                                        <th> ASSIGN TO FME NAME </th>
                                        <th> SITE ID </th>
                                        <th> PROJECT </th>
                                        <th> CREATION TIME </th>
                                        <th> DEPART TIME </th>
                                        <th> ARRIVE TIME </th>
                                        <th> COMPLETE TIME </th>
                                        <th> SUSPEND REASON </th>
                                        <th> REJECT REASON </th>
                                        <th> COMPLETE DESCRIPTION </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($masterTaskWork as $data)
                                        <tr style="text-align:center">
                                            <td>{{ $data->task_id }}</td>
                                            <td>{{ $data->operate_type }}</td>
                                            <td>{{ $data->task_type }}</td>
                                            <td>{{ $data->title }}</td>
                                            <td>{{ $data->task_status }}</td>
                                            <td>{{ $data->fm_office }}</td>
                                            <td>{{ $data->assign_to_fme }}</td>
                                            <td>{{ $data->assign_to_fme_name }}</td>
                                            <td>{{ $data->site_id }}</td>
                                            <td>{{ $data->project }}</td>
                                            <td>{{ $data->creation_time }}</td>
                                            <td>{{ $data->depart_time }}</td>
                                            <td>{{ $data->arrive_time }}</td>
                                            <td>{{ $data->complete_time }}</td>
                                            <td>{{ $data->suspend_reason }}</td>
                                            <td>{{ $data->reject_reason }}</td>
                                            <td>{{ $data->complete_description }}</td>
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

<!-- modal -->
<div class="modal fade" id="import" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">IMPORT DATA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('master.masterTaskWork.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>BULAN</label>
                        <select class="form-control" name="bulanUpload" id="bulanUpload">
                            <option value="" hidden>PILIH</option>
                            @foreach ($months as $monthName => $monthNumber)
                                <option value="{{ $monthNumber }}">{{ strtoupper($monthName) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>TAHUN</label>
                        <select class="form-control" name="tahunUpload" id="tahunUpload">
                            <option value="" hidden>PILIH</option>
                            @for ($year = $startYear; $year >= $endYear; $year--)
                                <option value="{{ $year }}">{{ $year }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="form-group">
                        <label>PILIH FILE</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                    <button type="submit" class="btn btn-success">IMPORT</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@section('javascript')
<script>
$('#template').click(function(e) {
    e.preventDefault();
    var linkURL = '/template/TEMPLATE_MASTER_TASK.xlsx';
    window.location.href = linkURL;
});
</script>
@endsection

