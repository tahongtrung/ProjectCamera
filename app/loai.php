<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class loai extends Model
{
    protected $table = 'webma_loaisp';

    public function chungloai (){
    	return $this->belongTo('App\chungloai' , 'idCL' , 'idLoai');
    }

    public function sanpham () {
    	return $this->hasMany('App\sanpham' , 'idLoai' , 'idLoai');
    }
}
