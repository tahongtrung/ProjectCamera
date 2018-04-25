<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\chungloai;
use App\User;
use App\sanpham;
use App\loai;
class AdminController extends Controller
{

    /*
    |
    |   Đăng nhập admin
    |
     */
    public function getDangNhapAdmin () {
    	
        if(Auth::check()){
            return redirect()->route('trangchuadmin');
        }else{
            return view('admin.dangnhap.dangnhap');
        }
    }

    public function postDangNhapAdmin (Request $req){
    	$this->validate($req,
            [
                'email'=>'required|',
                'password'=>'required'
            ], 
            [
                'email.required'=>'nhap email',
                'password.required'=>'nhap password'
            ]
        );
        $chungnhan = array('email'=>$req->email,'password'=>$req->password, 'idGroup'=>1); //('email-cot trong database')
        if(Auth::attempt($chungnhan)){
            return redirect()->route('trangchuadmin');
        }else{
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'SAI TÊN ĐĂNG NHẬP HOẶC MẬT KHẨU']);
        }
    }

    /*
    |
    |   Đăng xuất
    |
     */
    public function getDangXuat(){
        Auth::logout();
        return redirect()->route('admin');
    }

    /*
    |
    |   Trang chủ
    |
     */
    public function getTrangChu(){
        return view('admin.trangchu.trangchu');
    }

    public function getChonChungLoai ($idChungLoai){
        $LoaiSanPham = loai::where('idCL', $idChungLoai)->get();

        echo "<option>----Chọn loại----</option>";
        foreach ($LoaiSanPham as $loaisp) {
            echo "<option value='".$loaisp->idLoai."'>".$loaisp->TenLoai."</option>";
        }
    }
    
}
