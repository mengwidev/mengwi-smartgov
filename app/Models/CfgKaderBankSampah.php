<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CfgKaderBankSampah extends Model
{
    use HasFactory;
    protected $table = "cfg_kader_bank_sampah";
    protected $fillable =
    [
        'bank_sampah_name',
        'kd_count_bt',
        'kd_count_gb',
        'kd_count_pd',
        'kd_count_mg',
        'kd_count_pdn',
        'kd_count_srg',
        'kd_count_prg',
        'kd_count_lp',
        'kd_count_pg',
        'kd_count_al',
        'kd_count_dba',
        'honor',
        'tax'
    ];
}
