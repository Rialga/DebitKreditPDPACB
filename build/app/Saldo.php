<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    protected $table = 'saldo';
    protected $primaryKey = 'id';
    protected $fillable = [
       'nama' , 'saldo'
    ];

    public $incrementing = false;

    public $timestamps = false;

    public function alat() {
        return $this->hasMany('App\Transaksi', 'saldo_id', 'id');
    }

}
