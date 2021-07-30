<!DOCTYPE html>
<html lang="en">

<head>

    <title>Khuyến mại</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="{{ asset('img/logo1.jpg') }}" type="image/x-icon">

    <!-- Bootstrap Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <!-- Custom Stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/binh.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
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
    <style>
        h3 {
            color: black;
        }

    </style>
</head>


<body id="home-homepage" data-spy="scroll">
    @include('layout/header')

    <!--=============== khuyenmai ===============-->
    <section style="margin-top:50px;">
        <div class="container-fluid">
            <div class="container">
                <div class="page-heading">
                    <h3>Chương Trình</h3>
                    <h1 style="font-weight:800">Khuyến Mại Của Chúng Tôi </h1>

                </div>
                @if(!empty($listdata[0]))
                    <div class="row promotion_program">
                        <div class="col-md-7 col-sm-7 col-lg-7 col-12">
                            <div class="promotion_program_padding clearfix">
                                <div class="promotion_program_title">{{ $listdata[0]['title'] }}</div>
                                <div class="promotion_program_content">
                                    <div class="content" style="text-alight:center; white-space: normal; height:115px; 
                                    width: 100%; 
                                    overflow: hidden;
                                    text-overflow: ellipsis;;" class="text-center">{!! $listdata[0]['content'] !!}
                                    </div>
                                </div>
                                <div>
                                    <div style="float: left;">
                                        <img src="{{ asset('img/icon-calendar.png') }}" alt="">
                                        <span class="promotion_program_time">{{ $date = date(' d-m-Y', strtotime($listdata[0]['created_at']) + 7*60*60)}}</span>
                                    </div>
                                    <div style="float: right;">
                                        <a href="{{route('promotion-details', $listdata[0]['id'])}}"><button class="promotion_program_btn">Xem thêm</button></a>
                                    </div>
                                </div>
                            </div>  

                        </div>
                        <div class="col-md-5 col-sm-5 col-lg-5 col-12 promotion_program_img"
                            style="background: url({{ $listdata[0]['image'] }});background-size: cover;">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!--===============  ===============-->
    <section class="section-padding-promotion">
        <div class="container-fluid">
            <div class="container">
                <div class="row">
                    @if(!empty($listdata[1]))
                        <div class="col-md-4 col-sm-4 col-lg-4 col-12  clearfix">
                            <div class="promotion_program">
                                <div class="row-promotion"
                                    style="background: url({{ $listdata[1]['image'] }});background-size: cover;">

                                </div>
                                <div class="promotion_program_padding">
                                    <div class="promotion_program_title">{{ $listdata[1]['title'] }}</div>
                                    <div class="promotion_program_content">
                                        <div class="content" style="text-alight:center; white-space: normal; height:60px; 
                                        width: 100%; 
                                        overflow: hidden;
                                        text-overflow: ellipsis;;" class="text-center">{!! $listdata[1]['content'] !!}
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 60px;">
                                        <div style="float: left; padding-top:5px;">
                                            <img src="{{ asset('img/icon-calendar.png') }}" alt="">
                                            <span class="promotion_program_time">{{ $date = date(' d-m-Y', strtotime($listdata[1]['created_at']) + 7*60*60)}}</span>
                                        </div>
                                        <div style="float: right;">
                                            <a href="{{route('promotion-details', $listdata[1]['id'])}}"><button class="promotion_program_btn">Xem thêm</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!empty($listdata[2]))
                        <div class="col-md-4 col-sm-4 col-lg-4 col-12  clearfix">
                            <div class="promotion_program">
                                <div class="row-promotion"
                                    style="background: url({{ $listdata[2]['image'] }});background-size: cover;">

                                </div>
                                <div class="promotion_program_padding">
                                    <div class="promotion_program_title">{{ $listdata[2]['title'] }}</div>
                                    <div class="promotion_program_content">
                                        <div class="content" style="text-alight:center; white-space: normal; height:60px; 
                                        width: 100%; 
                                        overflow: hidden;
                                        text-overflow: ellipsis;;" class="text-center">{!! $listdata[2]['content'] !!}
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 60px;">
                                        <div style="float: left; padding-top:5px;">
                                            <img src="{{ asset('img/icon-calendar.png') }}" alt="">
                                            <span class="promotion_program_time">{{ $date = date(' d-m-Y', strtotime($listdata[2]['created_at']) + 7*60*60)}}</span>
                                        </div>
                                        <div style="float: right;">
                                            <a href="{{route('promotion-details', $listdata[2]['id'])}}"><button class="promotion_program_btn">Xem thêm</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if(!empty($listdata[3]))
                        <div class="col-md-4 col-sm-4 col-lg-4 col-12  clearfix">
                            <div class="promotion_program">
                                <div class="row-promotion"
                                    style="background: url({{ $listdata[3]['image'] }});background-size: cover;">

                                </div>
                                <div class="promotion_program_padding">
                                    <div class="promotion_program_title">{{ $listdata[3]['title'] }}</div>
                                    <div class="promotion_program_content">
                                        <div class="content" style="text-alight:center; white-space: normal; height:60px; 
                                        width: 100%; 
                                        overflow: hidden;
                                        text-overflow: ellipsis;;" class="text-center">{!! $listdata[3]['content'] !!}
                                        </div>
                                    </div>
                                    <div style="margin-bottom: 60px;">
                                        <div style="float: left; padding-top:5px;">
                                            <img src="{{ asset('img/icon-calendar.png') }}" alt="">
                                            <span class="promotion_program_time">{{ $date = date(' d-m-Y', strtotime($listdata[3]['created_at']) + 7*60*60)}}</span>
                                        </div>
                                        <div style="float: right;">
                                            <a href="{{route('promotion-details', $listdata[3]['id'])}}"><button class="promotion_program_btn">Xem thêm</button></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container-fluid">
            <div class="container">
                @if(!empty($listdata[4]))
                    <div class="row promotion_program">
                        <div class="col-md-5 col-sm-5 col-lg-5 col-12">
                            <div class="promotion_program_padding clearfix">
                                <div class="promotion_program_title">{{ $listdata[4]['title'] }}</div>
                                <div class="promotion_program_content">
                                    <div class="content" style="text-alight:center; white-space: normal; height:60px; 
                                    width: 100%; 
                                    overflow: hidden;
                                    text-overflow: ellipsis;;" class="text-center">{!! $listdata[4]['content'] !!}
                                    </div>
                                </div>
                                <div>
                                    <div style="float: left;">
                                        <img src="{{ asset('img/icon-calendar.png') }}" alt="">
                                        <span class="promotion_program_time">{{ $date = date(' d-m-Y', strtotime($listdata[4]['created_at']) + 7*60*60)}}</span>
                                    </div>
                                    <div style="float: right;">
                                        <a href="{{route('promotion-details', $listdata[4]['id'])}}"><button class="promotion_program_btn">Xem thêm</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-7 col-sm-7 col-lg-7 col-12 promotion_program_img-a"
                            style="background: url({{ $listdata[4]['image'] }});background-size: cover;">
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>

    @include('layout/footer')


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

</body>

</html>
