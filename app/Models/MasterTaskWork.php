<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterTaskWork extends Model
{
    use HasFactory;
    protected $table = 'table_master_task_work';
    protected $fillable = [
        'tahun',
        'bulan',
        'task_id',
        'operate_type',
        'task_type',
        'title',
        'task_status',
        'fm_office',
        'assign_to_fme',
        'assign_to_fme_name',
        'site_id',
        'project',
        'creation_time',
        'depart_time',
        'arrive_time',
        'complete_time',
        'suspend_reason',
        'reject_reason',
        'complete_description',
    ];
}
