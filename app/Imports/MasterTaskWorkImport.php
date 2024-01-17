<?php

namespace App\Imports;

use App\Models\MasterTaskWork;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class MasterTaskWorkImport implements ToCollection
{
    private $tahun;
    private $bulan;

    public function __construct($tahun, $bulan)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }

    /**
    * @param Collection $collection
    */

    public function collection(Collection $collection)
    {
        $collection->shift();

        foreach ($collection as $row) {
            $data = [
                'tahun' => $this->tahun,
                'bulan' => $this->bulan,
                'task_id' => $row[0],
                'operate_type' => $row[1],
                'task_type' => $row[2],
                'title' => $row[3],
                'task_status' => $row[4],
                'fm_office' => $row[5],
                'assign_to_fme' => $row[6],
                'assign_to_fme_name' => $row[7],
                'site_id' => $row[8],
                'project' => $row[9],
                'creation_time' => $row[10],
                'depart_time' => $row[11],
                'arrive_time' => $row[12],
                'complete_time' => $row[13],
                'suspend_reason' => $row[14],
                'reject_reason' => $row[15],
                'complete_description' => $row[16],
            ];

            if (!empty(array_filter($data))) {
                MasterTaskWork::create($data);
            }
        }
    }
}

