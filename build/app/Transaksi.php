<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transaksi';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nominal' , 'id_saldo' , 'jenis'
    ];


    public function alat() {
        return $this->belongsTo('App\Saldo', 'id_saldo', 'id');
    }
}
