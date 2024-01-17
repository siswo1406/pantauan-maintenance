<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function privacy(){
        return view('privacy', compact('no'));
    }

    public function __construct(){
        $this->middleware('auth');
    }

    public function reportCme(Request $request){
        $noCme = 0;
        $months = [
            "JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04",
            "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08",
            "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"
        ];

        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;

        $queryWhere = 'title LIKE "%CME%"';

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $queryWhere .= ' AND bulan = "'.$bulanFilter.'" AND tahun = "'.$tahunFilter.'"';
        }

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $reportCme = DB::select(
                'SELECT
                    fm_office AS cluster,
                    COUNT(task_id) AS plan_h3l,
                    SUM(IF(complete_time != "", 1, 0)) AS achievement,
                    (COUNT(task_id) - SUM(IF(complete_time != "", 1, 0))) AS gap,
                    (SUM(IF(complete_time != "", 1, 0)) / COUNT(task_id) * 100) AS percent
                FROM
                    table_master_task_work
                WHERE '.$queryWhere.' AND (
                        (
                            title LIKE "%CME%"
                            AND assign_to_fme_name IN ("salatigautara", "salatigaselatan")
                            AND title NOT LIKE "%3M%"
                            AND title NOT LIKE "%1M%"
                        )
                        OR (
                            assign_to_fme_name LIKE "%cjs%"
                            OR fm_office IN ("Jogja Utara", "Magelang 3", "Salatiga Selatan", "Salatiga Utara", "Sleman Barat 2", "Sukoharjo 4", "Temanggung 2", "Wates Selatan", "Wates Timur", "Wonogiri 2", "Wonogiri 3", "Wonosari 2")
                            AND title NOT LIKE "%3M%"
                            AND title NOT LIKE "%1M%"
                        )
                    )
                GROUP BY
                    fm_office
                ORDER BY
                    cluster'
            );
        } else {
            $reportCme = [];
        }

        return view('dashboard.report.reportCme', compact('noCme', 'reportCme', 'bulanFilter', 'tahunFilter', 'months', 'currentYear', 'startYear', 'endYear'));
    }

    public function reportTe(Request $request){
        $noTe = 0;
        $months = [
            "JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04",
            "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08",
            "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"
        ];

        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;

        $queryWhere = 'title LIKE "%TE_PL%"';

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $queryWhere .= ' AND bulan = "'.$bulanFilter.'" AND tahun = "'.$tahunFilter.'"';
        }

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $reportTe = DB::select(
                'SELECT
                    fm_office AS cluster,
                    COUNT(task_id) AS plan_h3l,
                    SUM(IF(complete_time != "", 1, 0)) AS achievement,
                    (COUNT(task_id) - SUM(IF(complete_time != "", 1, 0))) AS gap,
                    (SUM(IF(complete_time != "", 1, 0)) / COUNT(task_id) * 100) AS percent
                FROM
                    table_master_task_work
                WHERE '.$queryWhere.' AND (
                        (
                            title LIKE "%TE_PL%"
                            AND assign_to_fme_name IN ("salatigautara", "salatigaselatan")
                            AND title NOT LIKE "%3M%"
                            AND title NOT LIKE "%1M%"
                        )
                        OR (
                            assign_to_fme_name LIKE "%cjs%"
                            OR fm_office IN ("Jogja Utara", "Magelang 3", "Salatiga Selatan", "Salatiga Utara", "Sleman Barat 2", "Sukoharjo 4", "Temanggung 2", "Wates Selatan", "Wates Timur", "Wonogiri 2", "Wonogiri 3", "Wonosari 2")
                            AND title NOT LIKE "%3M%"
                            AND title NOT LIKE "%1M%"
                        )
                    )
                GROUP BY
                    fm_office
                ORDER BY
                    cluster'
            );
        } else {
            $reportTe = [];
        }

        return view('dashboard.report.reportTe', compact('noTe', 'reportTe', 'bulanFilter', 'tahunFilter', 'months', 'currentYear', 'startYear', 'endYear'));
    }

    public function reportBattery(Request $request){
        $noBattery = 0;
        $months = [
            "JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04",
            "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08",
            "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"
        ];

        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;

        $queryWhere = 'title LIKE "%Battery%"';

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $queryWhere .= ' AND bulan = "'.$bulanFilter.'" AND tahun = "'.$tahunFilter.'"';
        }

        if (!empty($bulanFilter) && !empty($tahunFilter)) {
            $reportBattery = DB::select(
                'SELECT
                    fm_office AS cluster,
                    COUNT(task_id) AS plan_h3l,
                    SUM(IF(complete_time != "", 1, 0)) AS achievement,
                    (COUNT(task_id) - SUM(IF(complete_time != "", 1, 0))) AS gap,
                    (SUM(IF(complete_time != "", 1, 0)) / COUNT(task_id) * 100) AS percent
                FROM
                    table_master_task_work
                WHERE '.$queryWhere.' AND (
                        (
                            title LIKE "%Battery%"
                            AND assign_to_fme_name IN ("salatigautara", "salatigaselatan")
                            AND title NOT LIKE "%3M%"
                            AND title NOT LIKE "%1M%"
                        )
                        OR (
                            assign_to_fme_name LIKE "%cjs%"
                            OR fm_office IN ("Jogja Utara", "Magelang 3", "Salatiga Selatan", "Salatiga Utara", "Sleman Barat 2", "Sukoharjo 4", "Temanggung 2", "Wates Selatan", "Wates Timur", "Wonogiri 2", "Wonogiri 3", "Wonosari 2")
                            AND title NOT LIKE "%3M%"
                            AND title NOT LIKE "%1M%"
                        )
                    )
                GROUP BY
                    fm_office
                ORDER BY
                    cluster'
            );
        } else {
            $reportBattery = [];
        }

        return view('dashboard.report.reportBattery', compact('noBattery', 'reportBattery', 'bulanFilter', 'tahunFilter', 'months', 'currentYear', 'startYear', 'endYear'));
    }

    /* public function reportTe(Request $request){
        $months = [
            "JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04",
            "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08",
            "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"
        ];

        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;

        $reportTe = DB::select(
            "SELECT
            fm_office AS cluster,
            COUNT(task_id) AS plan_h3l,
            SUM(IF(complete_time != '', 1, 0)) AS achievement,
            (COUNT(task_id) - SUM(IF(complete_time != '', 1, 0))) AS gap,
                (SUM(IF(complete_time != '', 1, 0)) / COUNT(task_id) * 100) AS percent
            FROM
                table_master_task_work
            WHERE
                bulan = '12'
                AND title LIKE '%TE_PL%'
                AND (
                    (
                        title LIKE '%TE_PL%'
                        AND assign_to_fme_name IN ('salatigautara', 'salatigaselatan')
                        AND title NOT LIKE '%3M%'
                        AND title NOT LIKE '%1M%'
                    )
                    OR (
                        assign_to_fme_name LIKE '%cjs%'
                        OR fm_office IN ('Jogja Utara', 'Magelang 3', 'Salatiga Selatan', 'Salatiga Utara', 'Sleman Barat 2', 'Sukoharjo 4', 'Temanggung 2', 'Wates Selatan', 'Wates Timur', 'Wonogiri 2', 'Wonogiri 3', 'Wonosari 2')
                        AND title NOT LIKE '%3M%'
                        AND title NOT LIKE '%1M%'
                    )
                )
            GROUP BY
                fm_office
            ORDER BY
                cluster"
        );

        return view('dashboard.report.reportTe', compact('reportTe', 'bulanFilter', 'tahunFilter', 'months', 'currentYear', 'startYear', 'endYear'));
    }

    public function reportBattery(Request $request){
        $months = [
            "JANUARI" => "01", "FEBRUARI" => "02", "MARET" => "03", "APRIL" => "04",
            "MEI" => "05", "JUNI" => "06", "JULI" => "07", "AGUSTUS" => "08",
            "SEPTEMBER" => "09", "OKTOBER" => "10", "NOVEMBER" => "11", "DESEMBER" => "12"
        ];

        $currentYear = date('Y');
        $startYear = $currentYear;
        $endYear = $currentYear - 5;

        $bulanFilter = $request->bulanFilter;
        $tahunFilter = $request->tahunFilter;

        $reportBattery = DB::select(
            "SELECT
                fm_office AS cluster,
                COUNT(task_id) AS plan_h3l,
                SUM(IF(complete_time != '', 1, 0)) AS achievement,
                (COUNT(task_id) - SUM(IF(complete_time != '', 1, 0))) AS gap,
                (SUM(IF(complete_time != '', 1, 0)) / COUNT(task_id) * 100) AS percent
            FROM
                table_master_task_work
            WHERE
                bulan = '12'
                AND title LIKE '%Battery%'
                AND (
                    (
                        title LIKE '%Battery%'
                        AND assign_to_fme_name IN ('salatigautara', 'salatigaselatan')
                        AND title NOT LIKE '%3M%'
                        AND title NOT LIKE '%1M%'
                    )
                    OR (
                        assign_to_fme_name LIKE '%cjs%'
                        OR fm_office IN ('Jogja Utara', 'Magelang 3', 'Salatiga Selatan', 'Salatiga Utara', 'Sleman Barat 2', 'Sukoharjo 4', 'Temanggung 2', 'Wates Selatan', 'Wates Timur', 'Wonogiri 2', 'Wonogiri 3', 'Wonosari 2')
                        AND title NOT LIKE '%3M%'
                        AND title NOT LIKE '%1M%'
                    )
                )
            GROUP BY
                fm_office
            ORDER BY
                cluster"
        );

        return view('dashboard.report.reportBattery', compact('reportBattery', 'bulanFilter', 'tahunFilter', 'months', 'currentYear', 'startYear', 'endYear'));
    } */

}
