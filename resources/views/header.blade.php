<div class="header">
    <div id="top-header">
        <div class="container">     
            <div class="tt-left">
                <a style="text-decoration:none" href="{{route('trang-chu')}}"><i style="font-size:20px;" class="fa fa-home" aria-hidden="true"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;
                <span class="hotline">Hotline</span>&nbsp;
                <a href="#" style="text-decoration:none"><i class="glyphicon glyphicon-earphone"> </i> &nbsp;</a><span class="hotline">0963.537.347</span> 
            </div><!--/tt-left-->
            
            <div class="cart">
                <a style="text-decoration:none" href="{{route('giohang')}}"><i class="glyphicon glyphicon-shopping-cart"></i><span>({{ Cart::count()}})</span></a>
            </div>
            
            <div class="tt-menu">
                <ul >
                  <li class="active"><a href="#">Liên Hệ</a></li>
                  <li><a href="#">Bảng Giá</a></li>
                  <li><a href="#">Giới Thiệu</a></li>
                </ul>
            </div>
        </div><!--//container-->
    </div><!--/top-header-->

    <div id="main-header">
        <div class="container">
            <div id="logo"> 
                <a href="{{route('trang-chu')}}"><img src="source/images/Photo-Camera-Free-Download-PNG.png" width="150px" alt="camera" /></a>
            </div><!--/logo-->
            <div class="btnmenu-mobile">
                <span class="glyphicon glyphicon-align-justify"></span>
            </div><!--/menu-mobile-->
            <script type="text/javascript">
                $(document).ready(function(){
                    $('.btnmenu-mobile').on('click',function(){
                        $('#main-menu-mobile ul').toggleClass('open');
                    });
                });
            </script>
            <div id="main-menu-mobile">
                <ul>
                    <li>
                        <a href="">tenloai</a> 
                        <span class="glyphicon glyphicon-play"></span>
                    </li>
                </ul>
            </div><!--/main-menu-mobile-->
            <div id="search-box">
                <form action="index.html" method="get" id="frmsearch">
                    <div class="fiel clearfix">
                        <input type="text" placeholder="Tìm sản phẩm" value="" id="search" name="search" autocomplete="off" />
                        <button type="submit" id="btnsubmit" name="" value="submit" title="Tìm kiếm">
                            <span class="glyphicon glyphicon-search"> </span>
                        </button>
                    </div>
                </form>
            </div><!--/search-box-->
            @if(Auth::check())
                <div style="float:right" class="dangnhap">
                    <!--avartar-->
                    <div id="avartar" style="float: left; width: 40px; height: 40px;">
                       <img src="source/images/default.jpg" style="margin-top: 5px; border: 1px solid; border-radius: 20px 20px 20px 20px;width: 40px; height: 40px;" alt="" />
                    </div>
                    <!--NAME USER-->
                    <div id="name" style="float: left; line-height: 50px;">
                        <span style="color:white; padding-left: 20px;">{{Auth::user()->name}}</span>
                    </div>

                    <!--menu setting-->
                    <div id="logout" style="float: left; padding-left: 20px; cursor: pointer;">
                        <i id="arow_dow" class="fa fa-caret-down" aria-hidden="true" style=" line-height: 50px;font-size: 20px; color:white"></i>
                    </div>
                    <!--menu setting-->
                    <div id="menu_logout">
                        <ul>
                            <li>
                                <a href=""><i class="fa fa-key" aria-hidden="true"></i>&nbsp Đổi mật khẩu</a>
                            </li>
                            <li>
                                <a href=""><i class="fa fa-file-image-o" aria-hidden="true"></i>&nbsp Đổi ảnh đại diện</a>
                            </li>
                            <li>
                                <a href="{{route('dangxuat')}}"><i class="fa fa-sign-out" aria-hidden="true"></i>&nbsp Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div> <br />
                
            @else
                <div style="float:right" class="dangnhap">
                    <a href="{{route('dangnhap')}}" style="color:#FFF; margin:0px" id="dangnhap_p">Đăng Nhập</a>
                    <!--avartar-->

                </div> <br />
                <div style="float:right" class="dangki">
                    <a href="{{route('dangki')}}" style="color:#FFF; padding-top: 20px;" id="dangki_p" >Đăng kí tài khoản | </a>
                </div>
            @endif
        </div><!--/container-->
    </div><!--/main-header-->
</div><!--//header-->