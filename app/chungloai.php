<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chungloai extends Model
{
    protected $table = 'webma_chungloaisp';
    
    public function loaisanpham (){
    	return $this->('App\loai' , 'idCL' , 'idCL');
    } 
}
