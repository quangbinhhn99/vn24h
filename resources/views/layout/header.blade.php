@php
    use GuzzleHttp\Client;
    $client = new Client([
        'headers' => [
        'Content-Type' => 'application/json',
        ],
    ]);

    $databanner = $client->get(\App\Models\BaseModel::URI_API . 'list-banner');
    $responsebanner = json_decode($databanner->getBody()->getContents(), true);

    if ($responsebanner['status'] == 1) {
        $listbanner = $responsebanner['data'];
    } else {
        alert()->warning($responsebanner['message']);
    }


    $datatitlebanner = $client->get(\App\Models\BaseModel::URI_API . 'list-titlebanner');
    $responsetitlebanner = json_decode($datatitlebanner->getBody()->getContents(), true);

    if ($responsetitlebanner['status'] == 1) {
        $listtitlebanner = $responsetitlebanner['data'];
    } else {
        alert()->warning($responsetitlebanner['message']);
    }

@endphp

<div class="loader"></div>


    <!--======== SEARCH-OVERLAY =========-->
    <div class="overlay">
        <a href="javascript:void(0)" id="close-button" class="closebtn">&times;</a>
        <div class="overlay-content">
            <div class="form-center">
                <form>
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search..." required />
                            <span class="input-group-btn"><button type="submit" class="btn"><span><i
                                            class="fa fa-search"></i></span></button></span>
                        </div><!-- end input-group -->
                    </div><!-- end form-group -->
                </form>
            </div><!-- end form-center -->
        </div><!-- end overlay-content -->
    </div><!-- end overlay -->


    <!--============= TOP-BAR ===========-->
    <div id="top-bar" class="tb-text-white">
    </div><!-- end top-bar -->


    <!--========================= FLEX SLIDER =====================-->
    <section class="flexslider-container" id="flexslider-container-6">

        <div class="header-absolute">
            <nav class="navbar navbar-default main-navbar navbar-custom navbar-transparent landing-page-navbar"
                id="mynavbar">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/" class="navbar-brand" style="padding-top:8px;"><img src="{{ asset('img/logo2.jpg') }}" alt=""
                            style="width:60%;"></a>
                        <button type="button" class="navbar-toggle" id="menu-button">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <div class="header-search hidden-lg">
                            <a href="javascript:void(0)" class="search-button"><span><i
                                        class="fas fa-search"></i></span></a>
                        </div>
                       
                    </div><!-- end navbar-header -->

                    <div class="collapse navbar-collapse" id="myNavbar1">
                        <ul class="nav navbar-nav navbar-right">
                            <li><a href="/">TRANG CHỦ</a></li>
                            <li><a href="{{asset('san-pham/page=1')}}">SẢN PHẨM</a></li>
                            <li><a href="{{asset('khuyen-mai')}}">KHUYẾN MẠI</a></li>
                            <li><a href="{{asset('chinh-sach-kinh-doanh')}}">CHÍNH SÁCH KINH DOANH</a></li>
                            <li><a href="{{asset('su-kien/page=1')}}">SỰ KIỆN</a></li>
                            <li></li>
                        </ul>
                    </div><!-- end navbar collapse -->
                </div><!-- end container -->
            </nav><!-- end navbar -->
        </div><!-- end header-absolute -->

        <div class="sidenav-content">
            <div id="mySidenav" class="sidenav">
                <h2 id="web-name"><span><i class="fa fa-home"></i></span>Việt Nam 24H</h2>

                <div id="main-menu">
                    <div class="closebtn">
                        <button class="btn btn-default" id="closebtn">&times;</button>
                    </div><!-- end close-btn -->

                    <div class="list-group landing-page-navbar">

                        <a href="/" class="list-group-item"><span><i
                                    class="fa fa-home link-icon"></i></span>TRANG CHỦ</a>
                        <a href="{{asset('san-pham/page=1')}}" class="list-group-item"><span><i
                                    class="fa fa-plane link-icon"></i></span>SẢN PHẨM</a>
                        <a href="{{asset('khuyen-mai')}}" class="list-group-item"><span><i
                                    class="fa fa-building link-icon"></i></span>KHUYẾN MÃI</a>
                        <a href="{{asset('chinh-sach-kinh-doanh')}}" class="list-group-item"><span><i
                                    class="fa fa-car link-icon"></i></span>CHÍNH SÁCH KINH DOANH</a>
                        <a href="{{asset('su-kien/page=1')}}" class="list-group-item"><span><i
                                    class="fa fa-globe link-icon"></i></span>SỰ KIỆN</a>

                    </div><!-- end list-group -->
                </div><!-- end main-menu -->
            </div><!-- end mySidenav -->
        </div><!-- end sidenav-content -->

        <div class="flexslider slider tour-slider" id="slider-6">
            <ul class="slides">
                @foreach ($listbanner as $item)
                <li class="item-1 back-size" style="background:url({{ $item['image'] }}); background-size:cover; height:100%;">
                    <div class="meta">
                        <div class="container" style="margin-top:-100px">

                            <div style="width: 52%; line-height: normal; text-align: left; font-size:40px; color:white;">{{$listtitlebanner[0]['title']}}</div>
                            <div style="width: 58%; line-height: normal; margin-top: 30px; text-align: left; font-size:18px; color:white; font-weight:100">{!! $listtitlebanner[0]['content'] !!}</div>

                        </div><!-- end container -->
                    </div><!-- end meta -->
                    {{-- <div>
                        <img src="{{ asset('img/milk.png') }}"
                            style="width: 55%; item-align: left; margin: 0px 0px auto auto;">
                    </div> --}}
                </li><!-- end item-1 -->
                @endforeach
            </ul>
        </div><!-- end slider -->
    </section><!-- end flexslider-container -->

