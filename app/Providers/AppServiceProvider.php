<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\loai;
use App\slide;
use App\sanpham;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view share
        view()->composer('slide',function($view_share){
            $slide = slide::all();
            $loai_sanpham = loai::all();
            $view_share->with('loai_sp', $loai_sanpham);
        });
        view()->composer('slide',function($view){
            $slide = slide::all();
            $view->with('slide', $slide);
        });
        //
        // VIEW SHARE -> sanpham_xemnhieu.blade.php
        // 
        view()->composer('sanpham_xemnhieu', function($view){
            $sanpham_xemnhieu = sanpham::orderBy('LuotXem','desc')->skip(0)->take(5)->get();
            $view->with('sanpham_xemnhieu', $sanpham_xemnhieu);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
