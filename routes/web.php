<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('trang-chu');
});
//----------------------------------------------------------------------
//			trang chủ
Route::get('index',[
 	'as'=>'trang-chu',
 	'uses'=>'PageController@getIndex'
]);

Route::get('loai-san-pham/{id}',[
	'as'=>'loaisanpham', 
	'uses'=>'PageController@getLoaiSanPham'
]);
route::get('chi-tiet-san-pham/{idsp}',[
	'as'=>'chitietsanpham',
	'uses'=>'PageController@getChiTiet'
]);
Route::get('danh-gia/{id}/{value}',[
	'as'=>'danhgia',
	'uses'=>'PageController@getDanhGia'
]);
Route::get('mua-hang/{id}/{tensanpham}',[
	'as'=>'muahang',
	'uses'=>'GioHangController@getMuaHang'
]);
Route::get('gio-hang',[
	'as'=>'giohang',
	'uses'=>'GioHangController@getGioHang'
]);
Route::get('cap-nhat-gio-hang/{id}/{qty}',[
	'as'=>'capnhatgiohang',
	'uses'=>'GioHangController@getCapNhatGioHang'
]);
Route::post('dat-hang',[
	'as'=>'dathang',
	'uses'=>'GioHangController@postDatHang'
]);
Route::get('dat-hang',[
	'as'=>'dathang',
	'uses'=>'GioHangController@getDatHang'
]);
Route::get('xoa-san-pham/{id}',[
	'as'=>'xoasanpham',
	'uses'=> 'GioHangController@getXoaSanPham'
]);
route::get('dang-nhap',[
	'as'=>'dangnhap',
	'uses' => 'PageController@getDangNhap'
]);

route::post('dang-nhap',[
	'as'=>'dangnhap',
	'uses' => 'PageController@postDangNhap'
]);

route::get('dang-xuat',[
	'as'=>'dangxuat',
	'uses'=>'PageController@getDangXuat'
]);
route::get('dang-ki',[
	'as'=>'dangki',
	'uses' => 'PageController@getDangKi'
]);

route::post('dang-ki',[
	'as'=>'dangki',
	'uses' => 'PageController@postDangKi'
]);

/*
|
|------------------------các Route trong admin------------------------
|
 */
Route::get('admin', [
	'as'=>'admin',
	'uses'=>'AdminController@getDangNhapAdmin'
]);
Route::post('admin', [
	'as'=>'admin',
	'uses'=>'AdminController@postDangNhapAdmin'
]);
Route::get('dang-xuat-admin', [
	'as'=>'dangxuatadmin',
	'uses'=>'AdminController@getDangXuat'
]);

/*
|	nhóm các trang admin
 */
Route::group(['prefix'=>'admin','middleware'=>'admin'], function(){
	Route::get('trang-chu',[
		'as'=>'trangchuadmin',
		'uses'=>'AdminController@getTrangChu'
	]);
	/*
	|	nhóm chủng loại
	 */
	Route::group(['prefix'=>'chung-loai'], function(){
		
		Route::get('danh-sach',[
			'as'=>'danhsachchungloai',
			'uses'=>'ChungLoaiController@getDanhSachCL'
		]);
		Route::get('them',[
			'as'=>'themchungloai',
			'uses'=>'ChungLoaiController@getThemChungLoai'
		]);
		Route::post('them',[
			'as'=>'themchungloai',
			'uses'=>'ChungLoaiController@postThemChungLoai'
		]);
		Route::get('xoa/{id}',[
			'as'=>'xoachungloai',
			'uses'=>'ChungLoaiController@getXoaChungLoai'
		]);
	});
	/*
	|	nhóm  loại
	 */
	Route::group(['prefix'=>'loai'], function(){
		
		Route::get('danh-sach',[
			'as'=>'danhsachloai',
			'uses'=>'LoaiSanPhamController@getDanhSachLoai'
		]);

		Route::get('them-loai',[
			'as'=>'themloai',
			'uses'=>'LoaiSanPhamController@getThemLoai'
		]);

		Route::post('them-loai',[
			'as'=>'themloai',
			'uses'=>'LoaiSanPhamController@postThemLoai'
		]);

		Route::get('xoa-loai/{id}',[
			'as'=>'xoaloai',
			'uses'=>'LoaiSanPhamController@getXoaLoai'
		]);
	});
	/*
	|	nhóm sản phẩm
	 */
	Route::group(['prefix'=>'san-pham'], function(){
		Route::get('danh-sach',[
			'as'=>'danhsachsanpham',
			'uses'=>'SanPhamController@getDanhSachSanPham'
		]);
		Route::get('chon-chung-loai/{id}',[
			'as'=>'chonchungloai',
			'uses'=>'AdminController@getChonChungLoai'
		]);
		/*
		|	thêm sản phẩm
		 */
		Route::get('them',[
			'as'=>'themsanpham',
			'uses'=>'SanPhamController@getThemSanPham'
		]);

		Route::post('them',[
			'as'=>'themsanpham',
			'uses'=>'SanPhamController@postThemSanPham'
		]);		
		/*
		|	xóa sản phẩm
		 */
		Route::get('xoa/{id}',[
			'as'=>'xoasanpham',
			'uses'=>'SanPhamController@getXoaSanPham'
		]);	

		Route::get('sua/{id}',[
			'as'=>'suasanpham',
			'uses'=>'SanPhamController@getSuaSanPham'
		]);

		
		Route::get('danh-sach-theo-loai/{loai}',[
			'as'=>'danhsachsanphamtheoloai',
			'uses'=>'SanPhamController@getDanhSachSanPhamTheoLoai'
		]);
	});
});
