<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerModel extends Model
{
    protected $table = 'tb_khach_hang';

    protected $fillable = [
        'ten_khach_hang',
        'dia_chi',
        'so_dt',
        'created_at',
        'updated_at'
    ];
}
