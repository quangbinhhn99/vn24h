<!DOCTYPE html>
<html lang="en">

<head>
    <title>Việt Nam 24H</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo1.jpg') }}" type="image/x-icon">

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" id="cpswitch" href="{{ asset('css/orange.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vinh.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.css" />

    <!-- Owl Carousel Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">

    <!-- Flex Slider Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}" type="text/css" />

    <!--Date-Picker Stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <style>
        h3 {
            color: black;
        }

    </style>
    
</head>


<body id="home-homepage" data-spy="scroll">

    @include('layout.header')
    @include('sweetalert::alert')
  

    <!--=============== về công ty  ===============-->
    @if  ( empty( $listintroduce['0'] ) ) Chưa có thông tin giới thiệu <br>
    @else
    <section class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-12">
                    <img src=" {{ $listintroduce[0]['image'] }} " width="95%" alt="chưa có ảnh">
                </div>
                <h3>Giới thiệu</h3>
                <h1>Về Công Ty Và Sản Phẩm</h1>
                <div class="col-sm-7 col-md-7 col-12" style="padding-right: 5%;">
                    <div class="page-heading" style="">
                        <div style="width: 100% !important;">{!! $listintroduce[0]['content'] !!}
                        </div>
                    </div>
                    <div style="text-align: justify;">
                        <p style=" font-size:12px; font-weight:100"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--=============== quảng bá sản phẩm  ===============-->
    @if  ( empty( $listdata['data'] ) ) sản phẩm chưa có data <br>
    @else
    <section id="sanPham">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-heading" style="text-align: center">
                        <h1 style="font-weight:800">Sản phẩm</h1>
                        <p class="text-center" style="font-size: 14px; color: #959292">Các sản phẩm sữa mang nhãn hiệu
                            Việt Nam 24H được
                            nghiên cứu và phát triển
                            bởi các chuyên gia dinh dưỡng hàng đầu đến từ Hà Lan, cung cấp cho Việt Nam các sản phẩm sữa
                            dinh dưỡng đạt tiêu chuẩn quốc tế. </p>
                    </div>
                    <div class="container" id="owl-demo">
                        @foreach ($listdata['data'] as $key=>$item)
                        <a style="text-decoration: none; color: black" href="{{route('sanPham', $item['id'])}}">
                            <div class="products">
                                <img src="{{ $item['image'] }}">
                                <p style="font-size: 12px; font-weight:800;" class="text-center"><b>{{ $item['name'] }}</b></p>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--=============== Chính sách kinh doanh  ===============-->
    @if  ( empty( $listpolicy ) ) chính sách kinh doanh chưa có data <br>
    @else
    <section id="cskd" class="section-padding" style="background: url({{ asset('img/background1.png') }})">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-heading" style="text-align: center">
                        <h1 style="font-weight:800">Chính Sách Kinh Doanh</h1>
                        <p class="text-center" style="font-size: 14px; color: #959292">Các sản phẩm sữa mang nhãn hiệu
                            Việt Nam 24H được
                            nghiên cứu và phát triển
                            bởi các chuyên gia dinh dưỡng hàng đầu đến từ Hà Lan, cung cấp cho Việt Nam các sản phẩm sữa
                            dinh dưỡng đạt tiêu chuẩn quốc tế. </p>
                    </div>
                    <div class="container row" id="owl-demoo">
                        @foreach ($listpolicy  as $key=>$item)
                        <?php ?>
                        <a style="text-decoration: none; color: black" href="{{route('policy', $item['id'])}}">
                            <div class="cskd" style="margin: 50px auto; padding:15px;">
                                <img src="{{ $item['icon'] }}" style="height:90px;">
                                <h4 class="text-center p-3">{{$item['title']}} </h4>
                                <div style="text-alight:center; white-space: normal; height:60px; 
                                width: 100%; 
                                overflow: hidden;
                                text-overflow: ellipsis;;" class="text-center">{!! $item['content'] !!}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--=============== Sự kiện nổi bật  ===============-->
    <section id="suKien" class="section-padding" style="background: url({{ asset('img/background2.png') }})">
        <div class="page-heading unNone" style="text-align: center;">
            <h1 style="font-weight:800">Sự Kiện Nổi Bật </h1>
            <p class="text-center" style="font-size: 14px; color: #959292">Các sản phẩm sữa mang nhãn hiệu Việt Nam 24H
                được nghiên cứu và phát triển bởi các chuyên gia
                dinh dưỡng hàng đầu đến từ Hà Lan, cung cấp cho Việt Nam
            </p>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-12 row ">
                    <a style="text-decoration: none; color: black" href="{{route('event-detail', $listevent['data'][0]['id'])}}">
                        <div class="rectangle1 above">
                            <div class="col-md-4 col-4">
                                @if  ( empty( $listevent['data'][0]['image'] ) ) chưa có image
                                    @else <img src="{{ $listevent['data'][0]['image'] }}" style="width: 100px; height: 80%;
                                    margin: 10px 0px; border-radius: 18px;">
                                    @endif
                            </div>
                            <div class="col-md-8 col-8" style="margin:0px 0px; padding-left:0px">
                                <h6 class="text-justify" style="font-size: 12px; margin: 10px 0px 0px;"><b>
                                    @if  ( empty( $listevent['data'][0]['title'] ) ) chưa có title
                                    @else {{ $listevent['data'][0]['title'] }}
                                    @endif
                                    
                                    </b> </h6>
                                <div>
                                    <img src="{{ asset('img/time.png') }}">
                                    @if  ( empty( $listevent['data'][0]['created_at'] ) ) chưa có time
                                    @else 
                                    <span style="font-size: 9px; color: #959292">{{$date = date(' d-m-Y', strtotime($listevent['data'][0]['created_at']) + 7*60*60)}}</span>
                                    @endif
                                </div>
                                @if  ( empty( $listevent['data'][0]['content'] ) ) chưa có content
                                @else   
                                    <div style="text-alight:left; white-space: normal; height:45px; 
                                        width: 100%; 
                                        overflow: hidden;
                                        text-overflow: ellipsis;">{!! $listevent['data'][0]['content'] !!}
                                    </div> 
                                @endif                             
                            </div>
                        </div>
                    </a>
                </div>

                <div class=" col-md-12 row">
                    <div class="col-md-7 none" style=" margin-left:-20px">
                        <h1>Sự Kiện Nổi Bật</h1>
                        <p style="font-size: 22px"><b>Của Chúng Tôi</b></p>
                        <p class="text-left" style="font-size: 11px; color: #959292; width:90%">Các sản phẩm sữa mang nhãn hiệu
                            Việt Nam 24H được nghiên cứu và phát triển bởi các chuyên gia
                            dinh dưỡng hàng đầu đến từ Hà Lan, cung cấp cho Việt Nam</p>
                        <a href="{{asset('su-kien/page=1')}}"><button style="background: #F7BC00;
                            width: 125px;
                            height: 38px;
                            border: none;
                            border-radius: 22px;
                            color: #333;
                            font-weight: 600;
                            font-size: 13px;" class=" promotion_program_btn">Xem tất cả</button></a>
                    </div>
                    <a style="text-decoration: none; color: black" href="{{route('event-detail', $listevent['data'][1]['id'])}}">
                        <div class="rectangle1 above1 col-md-5 col-12" style="padding:0">
                            <div class="col-md-4 col-4">
                                @if  ( empty( $listevent['data'][1]['image'] ) ) chưa có image
                                @else <img src="{{ $listevent['data'][1]['image'] }}" style="width: 100px; height: 80%;
                                    margin: 10px 0px; border-radius: 18px;">
                                @endif
                            </div>
                            <div class="col-md-8 col-8" style="margin:0px 0px; padding-left:0px">
                                <h6 class="text-justify" style="font-size: 12px; margin: 10px 0px 0px;"><b>
                                    @if  ( empty( $listevent['data'][1]['title'] ) ) chưa có image
                                    @else {{ $listevent['data'][1]['title'] }}
                                    @endif
                                    </b> </h6>
                                <div style="float: left">
                                    <img src="{{ asset('img/time.png') }}">
                                    @if  ( empty( $listevent['data'][1]['created_at'] ) ) chưa có image
                                    @else <span style="font-size: 9px; color: #959292">{{$date = date(' d-m-Y', strtotime($listevent['data'][1]['created_at']) + 7*60*60)}}</span>
                                    @endif
                                </div>
                                {{-- < class="text-justify " style="font-size: 10px; float:left; margin-top:5px;">< class="text-justify" style="font-size: 10px; margin-top:5px;"> --}}
                                <div style="text-alight:left; white-space: normal; height:45px; 
                                    width: 100%; 
                                    overflow: hidden;
                                    text-overflow: ellipsis;">
                                    @if  ( empty( $listevent['data'][1]['content'] ) ) chưa có content
                                    @else {!! $listevent['data'][1]['content'] !!}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-12 row">
                    <a style="text-decoration: none; color: black" href="{{route('event-detail', $listevent['data'][2]['id'])}}">
                    <div class="rectangle1 above2">
                        <div class="col-md-4 col-4"><img src="{{ $listevent['data'][2]['image'] }}" style="width: 100px; height: 80%;
                            margin: 10px 0px; border-radius: 18px;"></div>
                        <div class="col-md-8 col-8" style="margin:0px 0px; padding-left:0px">
                            <h6 class="text-justify" style="font-size: 12px; margin: 10px 0px 0px;"><b>
                                {{ $listevent['data'][2]['title'] }}
                                </b> </h6>
                            <div style="float: left">
                                <img src="{{ asset('img/time.png') }}">
                                @if  ( empty( $listevent['data'][2]['created_at'] ) ) chưa có image
                                @else <span style="font-size: 9px; color: #959292">{{$date = date(' d-m-Y', strtotime($listevent['data'][2]['created_at']) + 7*60*60)}}</span>
                                @endif
                            </div>
                            {{-- <p class="text-justify " style="float:left; margin-top:5px;"><div class="text-justify" style="margin-top:5px;"> --}}
                            <div style="text-alight:left; white-space: normal; height:45px; 
                                width: 100%; 
                                overflow: hidden;
                                text-overflow: ellipsis;">
                                 @if  ( empty( $listevent['data'][2]['content'] ) ) chưa có content
                                 @else {!! $listevent['data'][2]['content'] !!}
                                 @endif
                            </div>
                            </div> 
                        {{-- </p> --}}
                        </div>
                    </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!--=============== Trụ sở công ty  ===============-->
    @if  ( empty( $listheadquarter['0'] ) ) vp đại diện chưa có data <br>
    @else
    <section id="truSo" class="section-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-12 background3">
                    <img src="{{ $listheadquarter[0]['image'] }}" width="90%">
                    
                </div>
                <div class="col-sm-7 col-md-7 col-12">
                    <div class="page-heading" style="margin-top:50px">
                        <h1 style="font-weight:800">Trụ Sở Công Ty</h1>
                        <h3>Của Chúng Tôi</h3>

                    </div>
                    <div style="text-align: justify; padding-right:13%">
                        <div style="text-alight:left; white-space: normal; 
                            width: 100%; 
                            overflow: hidden;
                            text-overflow: ellipsis;;">{!! $listheadquarter[0]['content'] !!}</div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

     <!--=============== văn phòng đại diện  ===============-->
     <section >
        <div class="container">
            <div class="row">
                <div class="col-sm-5 col-md-5 col-12">
                    <div class="page-heading" style="padding-top:30%" >
                    <h2 style="font-weight:800">Văn Phòng Đại Diện</h2>
                        <h3>Của Chúng Tôi</h3>
                        </div>
                </div>
                <div class="col-sm-7 col-md-7 col-12 ">
                    <div class="" >
                        <div class="ggmap" style="width: 600px; height: 350px; overflow: hidden;">
                            @if  ( empty($listheadquarter[0]['link_map']) ) chưa có map
                            @else {!! $listheadquarter[0]['link_map'] !!} 
                            @endif
                        </div>
                        <div class="notiMap">
                            <p><b>
                                @if  ( empty($listheadquarter[0]['name']) ) chưa có name
                                @else {{ $listheadquarter[0]['name'] }}
                                @endif
                            </b></p>
                            <p>
                                <img src="{{ asset('img/location.png')}}">
                                <span style="font-size: 12px;">
                                    @if  ( empty($listheadquarter[0]['address']) ) chưa có address 
                                    @else {{ $listheadquarter[0]['address'] }}
                                    @endif
                                </span>
                            </p>
                            <p>
                                <img src="{{ asset('img/call.png')}}">
                                <span style="font-size: 12px">
                                    @if  ( empty($listheadquarter[0]['phone']) ) chưa có phone 
                                    @else {{ $listheadquarter[0]['phone'] }}
                                    @endif
                                </span>
                            </p>
                        </div>
                        <img src="{{ asset('img/down.png')}}" class="down">
                    </div>
                  
                </div>
            </div>
        </div>
    </section>
   

       <!--=============== Chăm sóc khách hàng ===============-->
       <section id="truSo" class="section-padding">
        <div class="container">
            <div class="row container">
                <div class="col-sm-5 col-md-5 col-12 container">
                    <img src="{{ asset('img/info1.png') }}" width="25%" >
                    <img src="{{ asset('img/info2.png') }}" width="40%" class="img2">
                    <img src="{{ asset('img/info3.png') }}" width="25%" class="img3">
                    <img src="{{ asset('img/info1.png') }}" width="20%" class="img4">
                    <img src="{{ asset('img/info4.png') }}" width="25%" class="img7">
                    <img src="{{ asset('img/info1.png') }}" width="20%" class="img6">
                    <img src="{{ asset('img/info5.png') }}" width="28%" class="img5">
                </div>
                <div class="col-sm-7 col-md-7 col-12 container">
                    <div class="page-heading" style="margin-top:50px">
                        <h1 class="text-center" style="font-weight:800">Chăm Sóc Khách Hàng</h1>
                       <p class="text-center" style="font-size: 11px; color: #959292">Hãy để lại thông tin email hoặc số điện thoại của bạn để được chứng tôi tư vấn giải đáp các thắc mắc của bạn.</p>

                    </div>
                    <div style="text-align: justify;margin-left:20%">
                       <form action="{{route('CSKH')}}" method="post">
                        @csrf
                            <label for="email" style="color: #959292">Email</label><br>
                            <div>
                                <input class="inputIndex" name="email" type="email" value="">
                            </div>
                            <br>
                            <label for="email" style="color: #959292">Số điện thoại</label><br>
                           <div style="display:flex">
                            <input class="inputIndex" name="phone" type="tel" value="">
                        </div>
                        <button class="send" type="submit"> <span style="font-weight:600; font-size:12px; padding-right:5px">Gửi</span>
                        <img src="{{asset('img/send.png')}}" width="20%" class="none">
                    </button>
                       </form>
                        

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Page Scripts Starts -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/custom-navigation.js') }}"></script>
    <script src="{{ asset('js/custom-flex.js') }}"></script>

    <script src="{{ asset('js/custom-date-picker.js') }}"></script>
    <script src="{{ asset('js/owl-carousel/owl.carousel.js') }}"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.11.0/sweetalert2.all.min.js"></script>
    
    <!-- Page Scripts Ends -->
    <script>
        $(document).ready(function() {

            $("#owl-demo").owlCarousel({
                rtl: true,
                autoPlay: 3000,
                items: 5,
                pagination: false,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                margin: 10,
                center: true,
                nav: true,
                loop: true,

                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }

            });

        });

        $(document).ready(function() {

            $("#owl-demoo").owlCarousel({
                rtl: true,
                autoPlay: 3000,
                items: 4,
                pagination: false,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                margin: 10,
                center: true,
                nav: true,
                loop: true,

                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 3,
                        nav: false
                    },
                    1000: {
                        items: 5,
                        nav: true,
                        loop: false
                    }
                }

            });

        });

    // load css for iframe
            window.onload = function() {
            let myiFrame = document.getElementById("myiFrame");
            let doc = myiFrame.contentDocument;
            doc.body.innerHTML = doc.body.innerHTML + 'css/responsive.css';
    }
    </script>
    @include('layout.footer')

</body>

</html>
