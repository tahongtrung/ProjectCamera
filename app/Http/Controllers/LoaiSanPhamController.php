<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\chungloai;
use App\User;
use App\sanpham;
use App\loai;

class LoaiSanPhamController extends Controller
{
    /*
    |
    |   Lấy ra danh sách loại
    |
     */
    public function getDanhSachLoai (){
        $stt = 0;
        $ds_loai = loai::where('AnHien', 1)->Paginate(10);
        return view('admin.loai.loai', compact('ds_loai', 'stt'));
    }

    public function getThemLoai () {
        $chungloai = chungloai::where('AnHien', 1)->get();
        return view('admin.loai.them', compact('chungloai'));
    }

    public function postThemLoai (Request $req) {
        $idChungLoai = $req->chungloai ;
        $tenloai = $req->tenloai;

        $themloai = new loai();
        $themloai->idCL = $idChungLoai;
        $themloai->TenLoai = $tenloai;

        $themloai->save();

        return redirect()->route('danhsachloai');
    }

    public function getXoaLoai ($id) {
        $xoaloai = loai::where('idLoai' , $id )->delete();
        return redirect()->back();
    }
}
