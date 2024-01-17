<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
Use App\Role;
use App\Models\Home;
use App\Models\Agenda;
use App\Models\Pengunjung;
use App\Models\ScPerbandingan;
use App\Models\ScPenilaianUnit;
use App\Models\ScPenilaianFlukUnit;
use App\Models\ScPenilaianFlukAp;
use App\Models\Picture;
use App\Imports\ScPenilaianUploadImport;
use App\Imports\ScPerbandinganImport;
use App\Imports\AppEstMrgCinImport;
use App\Imports\AppEstMrgPanenImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Yajra\DataTables\DataTables;
use Alert;

class HomeController extends Controller
{
    public function privacy(){
        return view('privacy', compact('no'));
    }

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        return view('dashboard.home');
    }
}
