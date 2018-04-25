<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\chungloai;
use App\User;
use App\sanpham;
use App\loai;
class ChungLoaiController extends Controller
{
    /*
    |
    |   Lấy ra danh sách chủng loại
    |
     */
    public function getDanhSachCL(){
        $stt = 1;
        $ds_chungloai = chungloai::where('AnHien', 1)->Paginate(8);
        return view('admin.chungloai.chungloai', compact('ds_chungloai', 'stt'));
    }

    /*
    |
    |   thêm chủng loại
    |
     */
    public function getThemChungLoai(){
        return view('admin.chungloai.them');
    }
    public function postThemChungLoai(Request $req ){
        $slug = str_slug($req->ten_chung_loai) ;
        $name = $req->ten_chung_loai;

        $chungloai = new chungloai();
        $chungloai->TenCL = $name;
        $chungloai->slug = $slug;
        $chungloai->save();

        return redirect()->route('danhsachchungloai');
    }

    public function getXoaChungLoai  ($id) {
        $xoa = chungloai::where('idCL', $id)->delete();
        return redirect()->back();
    }
}
