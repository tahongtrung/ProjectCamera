<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\slide;
use App\sanpham;
use App\loai;
use App\User;
use Session;
use Illuminate\Support\Facades\Auth;
use Hash;
use Cart;
use DB;
use App\donhang;
use App\chitiet_donhang;
class PageController extends Controller
{

    /*function __construct (sanpham $sanpham){
        //
    }*/
    public function getIndex(){
        $sanpham = new sanpham();
        $sanpham = $sanpham->getTatCaSanPham(); //
    	return view('page.trangchu', compact('sanpham'));
       
    }
    public function getLoaiSanPham ($idloai){
        
        $loai = new sanpham();
        $SP_TheoLoai = $loai->getLoaiSanPham($idloai);
        /*
        |
        |   lấy 5 sản phẩm có lượt xem nhiều nhất
        |
         */
        $sanpham_xemnhieu = $loai->getSanPhamXemNhieu();
        return view('page.loaisanpham', compact('SP_TheoLoai','sanpham_xemnhieu'));
    }
    // chi tiet san pham
    public function getChiTiet($idsp){
        
    	$sanpham = new sanpham();
        $chitietsanpham = $sanpham->getChiTietSanPham($idsp);
        
        $sp_cungloai = $sanpham->getSanPhamCungLoai($idsp);
    	return view('page.chitietsanpham', compact('chitietsanpham','sp_cungloai')); 
    }

    public function getDanhGia($id , $value){

        $idSanPham = $id ; 
        $diembinhchon = $value*2;
        /*
        |
        | lấy ra số lần chọn và số điểm
        |
        */
        $binhchon= sanpham::where('idSP', $idSanPham)->first();
        /*
        | cập nhật lại số lần chọn và điểm bình chọn
        | số lần chọn + 1 , điểm bình chọn + điểm bình chọn người dùng vừa chọn
        |
         */
        $sanpham = sanpham::where('idSP', $idSanPham)->update([
            'SoLanChon'=> $binhchon->SoLanChon + 1, 'DiemBinhChon'=>$binhchon->DiemBinhChon + $diembinhchon
        ]);
        /*
        | 
        | lấy ra điểm và số lần chọn sau khi đã cập nhật để tính điểm trung bình
        |
         */
        $tb = sanpham::where('idSP', $idSanPham)->first();
        $diem = $tb->DiemBinhChon;
        $solan = $tb->SoLanChon;
        $dtb = ($diem / $solan);
        /*
        | 
        | cập nhật lại điểm trung bình (có thể không cần lưu vào database)
        |
         */
        $DiemTrungBinh = DB::table('webma_sanpham')->where('idSP', $idSanPham)->update([
            'DiemTrungBinh'=> $dtb
        ]);
        /*
        | 
        | lấy ra điểm trung bình
        |
         */
        $solanchon = sanpham::where('idSP', $idSanPham)->first();
        /*
        | 
        | Gửi sang class binhchon trong chitietsanpham.balde.php (sử dụng ajax)
        |
         */
        echo '<span>'.round (($solanchon->DiemTrungBinh),1).'/10'.' ('.$solanchon->SoLanChon .' Lượt)'.'</span>';
    }
    public function getDangNhap(){
        return view('page.dangnhap');
    }

    public function postDangNhap(Request $req){
        /*
        |
        |   kiểm tra dữ liệu nhập vào
        |
         */
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
        $chungnhan = array('email'=>$req->email,'password'=>$req->password); //('email-cot trong database')
        if(Auth::attempt($chungnhan)){
            return redirect()->route('trang-chu');
        }else{
            return redirect()->back()->with(['flag'=>'danger', 'message'=>'SAI TÊN ĐĂNG NHẬP HOẶC MẬT KHẨU']);
        }
    }
    // dang xuat
    public function getDangXuat(){
        Auth::logout();
        return redirect()->route('trang-chu');
    }
    // dang ki 
    public function getDangKi(){
        return view('page.dangki');
    }
    public function postDangKi(Request $req){
        $hoten = str_slug($req->hoten);
        $this->validate($req,
            [
                'username'=>'required|min:6|max:12',
                'password'=>'required|min:6|max:12',
                'nhaplai_password'=>'required|same:password',
                'hoten' =>'required',
                'email' => 'required|email',
                'sodienthoai'=> 'required',
                'diachi' => 'required'
            ],
            [
                'username.required'=>'Nhập username',
                'username.min'=>'lớn hơn 6 kí tự',
                'username.max'=>'nhỏ hơn 12 kí tự',
                'password.required'=>'nhập password',
                'password.min'=>'lớn hơn 6 kí tự',
                'password.max'=>'nhỏ hơn 12 kí tự',
                'nhaplai_password.same'=>'Nhạp lại ko đúng',
                'nhaplai_password.required'=>'nhập lại password',
                'hoten.required'=>'nhập họ tên',
                'email.required'=>'nhập email',
                'email.email'=>'nhập email ko đúng',
                'sodienthoai.required'=>'nhập sđt',
                'diachi.required'=>'nhập địa chỉ'
            ]
        );

        $user = new User();
        $user->UserName = $req->username;
        $user->Password = Hash::make($req->password);
        $user->name = $req->hoten;
        $user->Email = $req->email;
        $user->SDT = $req->sodienthoai;
        $user->DiaChi = $req->diachi;
        $user->slug = $hoten;

        $user->save();

        return redirect()->back()->with('thongbao', 'ĐĂNG KÍ TÀI KHOẢN THÀNH CÔNG');

    }
}
