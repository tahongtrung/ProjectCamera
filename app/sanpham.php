<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sanpham extends Model
{
    protected $table = 'webma_sanpham';

    public function loai(){
    	return $this->belongTo('App\loai' , 'idLoai' , 'idSP');
    }

    public function getTatCaSanPham (){  	
    	$sanpham = sanpham::where('AnHien',1)->Paginate(8);
    	return $sanpham;
    }

    public function getLoaiSanPham ($idloai){
        /*
        |
        |   lấy ra các sp khi chọn loại từ menu
        |   paginate() => phân trang
        |
         */
    	$loaisanpham = sanpham::where('idLoai',$idloai)->Paginate(8);
    	return $loaisanpham;
    }
    public function getSanPhamXemNhieu(){     
        $sanpham_xemnhieu = sanpham::orderBy('LuotXem','desc')->skip(0)->take(5)->get();
        return $sanpham_xemnhieu;
    }

    public function getChiTietSanPham($idsp){

        /*
        |
        |   lấy thông tin sản phẩm người dùng đang xem
        |
         */  
        $chitietsanpham = sanpham::where('idSP', $idsp)->first();
        /*
        |
        |   lấy ra lượt xem
        |
         */
        $LuotXem = $chitietsanpham->LuotXem;

        /*
        |
        |   Cập nhật lượt xem sản phẩm
        |
         */
        $update_LX = sanpham::where('idSP',$idsp)->update([
            'LuotXem'=> $LuotXem + 1
        ]);
        

        return $chitietsanpham;
    }
    public function getSanPhamCungLoai ($idsp) {
        /*
        |
        |   lấy ra idLoai của sản phẩm mà người dùng đang xem
        |
         */
        $idloai = sanpham::where('idSP', $idsp)->pluck('idLoai');

        /*
        |
        |   lấy ra 5 sản phẩm cùng loại với sản phẩm đang xem (có thể dùng random)
        |
         */
        $sp_cungloai = sanpham::where('idLoai',$idloai)->skip(0)->take(5)->get();

        return $sp_cungloai;
    }
}
