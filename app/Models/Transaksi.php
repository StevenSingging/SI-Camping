<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = ['user_id','id_barang','jumlah','tgl_pesan','tgl_kembali','total_bayar','jenis_jaminan','foto_jaminan'];
}
