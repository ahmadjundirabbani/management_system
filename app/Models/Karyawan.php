<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    protected $table = 'KARYAWAN';

    protected $primaryKey = 'Id';

    protected $fillable = [
        'Nama',
        'Tgl Lahir',
        'Gaji'
    ];
}
