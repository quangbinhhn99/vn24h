<!DOCTYPE html>
<html lang="en">

<head>

    <title>Khuyến mại-chi tiết</title>
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
                <div class="row" style="margin-top: 50px;">
                    <div class="box-promotion" style="box-shadow:none;">
                        <div class="img"><img style="width:100%;" src="{{$listdata['image']}}" alt="#"></div><br>
                        <b><div class="title" style="">{!! $listdata['title'] !!}</div></b>
                        <div class="time" style="display: flex;">
                            <div class="img"><img src="{{asset('img/Time-Circle.png')}}" alt="#"></div>&nbsp;
                            {{ $date = date(' d-m-Y', strtotime($listdata['created_at']) + 7*60*60)}}
                        </div><br>
                        <div class="img2" >
                            <?php 
                                $array = preg_split("/=/", $listdata['video']);
                                $str = str_replace("watch?v","embed/",$array[0]);
                                $video = $str . $array[1];  
                            ?>
                            <iframe width="50%" height="300px" src="{{$video}}" frameborder="0"></iframe>
                        </div><br>
                        <div class="content">{!! $listdata['content'] !!}</div>
                    </div>
                </div>
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
