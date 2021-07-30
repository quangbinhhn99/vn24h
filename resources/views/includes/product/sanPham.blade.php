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
    <section class="container" style="margin-top:8%">
        <div class="row">
            <div class="col-sm-5 col-md-5 col-12">
                <img src="{{ $listdata['image'] }}" width="100%">
            </div>
            <div class="col-md-7 col-sm-7 col-12">
                <h3>Sản Phẩm</h3>
                <h2>{{ $listdata['name']}}</h2>
                <p class="text-left" style="font-size: 12px">{!! $listdata['description'] !!}</p>
            </div>

        </div>
    </section>

    @if  ( empty( $listdata['product_feel'] ) ) <br>
    @else
    <section class="container" style="margin-top:8%">
        <div class="row">

            <div class="col-md-12 col-sm-6 col-12">

                <h3>Cảm nhận</h3>
                <h2>Sự Hài Lòng Của Khách Hàng</h2>
                <div id="person">
                    @foreach ($listdata['product_feel'] as $item)
                        
                    <div class="row" id="person">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm-2 col-2 "><img class="avatar" src="{{ $item['avatar'] }}" alt=""></div>
                                    <div class="col-sm-10 col-10">
                                        <p><b>{{ $item['name']}}</b><br><i style="font-size: 10px; font-weight:100">Người sử dụng sản phẩm</i></p>
                                        <p style="font-weight: 400; font-size: 13px;">{!! $item['content'] !!}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                <div class="col-12">
                                    <?php 
                                        $array = preg_split("/=/", $item['video']);
                                        $str = str_replace("watch?v","embed/",$array[0]);
                                        $video = $str . $array[1];  
                                    ?>
                                    <iframe width="100%" height="300px" src="{{$video}}" frameborder="0"></iframe>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    @endif

    <section id="sanPham" style="margin-top:100px">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="page-heading" style="text-align: center">
                        <h1 style="font-weight:800">Tầm Nhìn Chiến Lược</h1>
                        <p class="text-center" style="font-size: 12px; color: #959292; width:80%">{!! $listdata['strategic_vision'] !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sanPham" style="margin:8%">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div style="text-align: left">
                        <h1 style="font-weight:800">Sản Phẩm Liên Quan</h1>
                        
                    </div>
                    <div class="container" id="owl-demo">
                        {{-- @if   (($listdata['related_product'])=='0') <p>chưa có dữ liệu</p> --}}
                        {{-- @else  { --}}
                            @foreach ($listdata['related_product'] as $item)
                                <div class="products">
                                    <img src="{{ $item['product']['image'] }}">
                                    <p class="text-center">{{$item['product']['name']}}</p>
                                </div>
                            @endforeach
                        {{-- }   --}}
                        {{-- @endif    --}}
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
    <!-- Page Scripts Ends -->

    @include('layout.footer')

    <script>
        $(document).ready(function() {

            $("#person").owlCarousel({
                rtl: true,
                autoPlay: 5000,
                items: 1,
                pagination: true,
                itemsDesktop: [1199, 3],
                itemsDesktopSmall: [979, 3],
                margin: 10,
                center: true,
                nav: true,
                loop: true,
                responsive: {
                    500: {
                        items: 1,
                        nav: true
                    }
                }

            });

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

    </script>

</body>

</html>
