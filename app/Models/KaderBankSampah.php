<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KaderBankSampah extends Model
{
    use HasFactory;

    protected $table = 'kader_bank_sampah';
    
    protected $fillable = [
        'nama',
        'jabatan_id',
        'banjar_id'
    ];

    public function jabatan()
    {
        return $this->belongsTo(RefJabatanCommon::class, 'jabatan_id');
    }

    public function banjar()
    {
        return $this->belongsTo(RefBanjar::class, 'banjar_id');
    }
}
