<?php

namespace App\Http\Controllers;

use App\Imports\MasterTaskWorkImport;
use App\Models\MasterTaskWork;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use Alert;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    public function privacy(){
        return view('privacy', compact('no'));
    }

    public function __construct(){
        $this->middleware('auth');
    }

    public function masterTaskWork(Request $request){
        $months = [
            "JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04",
            "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08",
            "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"
        ];

        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;

        $fmOffice = DB::table('table_master_fm_office')->orderBy('fm_office')->get();

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;
        $kategoriFilter = $request->kategoriFilter;
        $fmofficeFilter = $request->fmofficeFilter;

        $whereQuery = '';

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $whereQuery .= 'bulan = ' . $bulanFilter . ' AND ';
            $whereQuery .= 'tahun = ' . $tahunFilter;

            if (!empty($kategoriFilter)) {
                $kategoriFilterLowerCase = strtolower($kategoriFilter);
                $whereQuery .= ' AND LOWER(title) LIKE "%' . $kategoriFilterLowerCase . '%"';
            }

            if (!empty($fmofficeFilter)) {
                $whereQuery .= ' AND fm_office = "' . $fmofficeFilter . '"';
            }
        }

        $masterTaskWork = DB::select('SELECT * FROM table_master_task_work ' . (!empty($whereQuery) ? 'WHERE ' . $whereQuery : ''));

        return view('dashboard.master.masterTaskWork', compact(
            'masterTaskWork', 'bulanFilter', 'tahunFilter', 'kategoriFilter', 'fmofficeFilter', 'fmOffice', 'months', 'currentYear', 'startYear', 'endYear'
        ));
    }

    /* public function masterTaskWork(Request $request){
        $months = ["JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04", "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08", "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"];
        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;
        $fmOffice = DB::select('SELECT * FROM table_master_fm_office ORDER BY fm_office');

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;
        $kategoriFilter = $request->kategoriFilter;
        $fmofficeFilter = $request->fmofficeFilter;

        if (!empty($bulanFilter) && !empty($tahunFilter) && !empty($kategoriFilter) && !empty($fmofficeFilter)) {
            $whereQuery = 'WHERE bulan = '.$bulanFilter.' AND tahun = '.$tahunFilter.' AND assign_to_fme_name LIKE "%'.$fmofficeFilter.'%"'.' AND fm_office = "'.$fmofficeFilter.'"';
        } else if (!empty($bulanFilter) && !empty($tahunFilter) && !empty($kategoriFilter) && empty($fmofficeFilter)) {
            $whereQuery = 'WHERE bulan = '.$bulanFilter.' AND tahun = '.$tahunFilter.' AND assign_to_fme_name LIKE "%'.$fmofficeFilter.'%"';
        } else if (!empty($bulanFilter) && !empty($tahunFilter) && empty($kategoriFilter) && empty($fmofficeFilter)) {
            $whereQuery = 'WHERE bulan = '.$bulanFilter.' AND tahun = '.$tahunFilter;
        } else {
            $whereQuery = 'WHERE bulan = '.$bulanFilter.' AND tahun = '.$tahunFilter;
        }

        $masterTaskWork = DB::select('SELECT * FROM table_master_task_work '.$whereQuery);

        return view('dashboard.master.masterTaskWork', compact('masterTaskWork', 'bulanFilter', 'tahunFilter', 'kategoriFilter', 'fmofficeFilter', 'fmOffice', 'months', 'currentYear', 'startYear', 'endYear'));
    } */

    public function masterTaskWorkImport(Request $request){
        $bulanUpload = $request->bulanUpload;
        $tahunUpload = $request->tahunUpload;

        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx'
        ]);

        $file = $request->file('file');
        $nama_file = 'TEMPLATE_MASTER_TASK' . $file->hashName();
        $path = $file->storeAs('public/excel/', $nama_file);
        $import = new MasterTaskWorkImport($tahunUpload, $bulanUpload);

        $clear = MasterTaskWork::where('bulan', $bulanUpload)->where('tahun', $tahunUpload)->delete();

        if ($clear) {
            $import = Excel::import($import, storage_path('app/public/excel/' . $nama_file));
        } else {
            $import = Excel::import($import, storage_path('app/public/excel/' . $nama_file));
        }
        Storage::delete($path);

        if ($import) {
            Alert::success('Data Berhasil Diimport!');
        } else {
            Alert::error('Data Gagal Diimport!');
        }
        return redirect()->route('master.masterTaskWork');
    }
}
