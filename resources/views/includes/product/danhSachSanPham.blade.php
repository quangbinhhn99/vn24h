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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="{{ asset('css/vinh.css') }}">

    <!-- Owl Carousel Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">

    <!-- Flex Slider Stylesheet -->
    <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}" type="text/css" />

    <!--Date-Picker Stylesheet-->
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vinh.css') }}">

    <style>
        h3 {
            color: black;
        }

    </style>
    
</head>


<body id="home-homepage" data-spy="scroll">
    @include('layout.header')
   <section class="container" style="margin-top:8%">
    <div class="page-heading" style="text-align: center">
        <h1 style="font-weight:800">Sản phẩm</h1>
        <p class="text-center" style="font-size: 13px; color: #959292; width:80%">Các sản phẩm sữa mang nhãn hiệu
            Việt Nam 24H được
            nghiên cứu và phát triển
            bởi các chuyên gia dinh dưỡng hàng đầu đến từ Hà Lan, cung cấp cho Việt Nam các sản phẩm sữa
            dinh dưỡng đạt tiêu chuẩn quốc tế. </p>
    </div>
   </section>

   <section class="container">
           
                <div class="row products">
                    @foreach ($listdata['data'] as $key=>$item)
                    <div class="col-sm-12 col-md-3 col-12 " style="height: 250px;">
                        <a href="{{route('sanPham', $item['id'])}}" style="text-decoration: none; color: black;">
                        <img src="{{ $item['image'] }}">
                        <p style="font-size: 12px; font-weight:800;" class="text-center"><b>{{ $item['name'] }}</b></p></a>
                    </div>
                    @endforeach
                </div>
   </section>
   @php
   if (isset($listdata)) {
       $page = $listdata['current_page'];
   } else {
       $page = $listdata['current_page'];
   }
@endphp
   {{-- ====== Phân trang ======= activePagi--}}
   <section @if($listdata['last_page']==1) style="display:none;" @endif>
       <div class="container" style="display:flex; justify-content:center">
           <ul class="pagination1
            mt-4 mr-3" style="float: right;">

            @if ($page > 1)
                <li class="page-item mr-2"><a style="color: #A2A6B0" class="page-link"
                        href="{{ asset('san-pham/page=' . ($page - 1)) }}">
                        <i class="fas fa-angle-left"></i></a>
                </li>
            @endif
            @for ($i = $page - 1; $i <= $page + 1; $i++)

                @if ($i > 0 && $i <= $listdata['last_page']) 
                    <li class="page-item mr-2">
                    <a href="{{ asset('san-pham/page=' . $i) }}" class="page-link         
                    @if ($page==$i) {{ 'activePagi1' }} 
                        @else {{ 'pagNoActive' }} 
                    @endif"href="#">{{ $i }}</a></li>
                @endif

            @endfor
            @if ($page < $listdata['last_page'])
                <li class="page-item mr-2"><a style="color: #A2A6B0" class="page-link"
                        href="{{ asset('san-pham/page=' . ($page + 1)) }}">
                        <i class="fas fa-angle-right"></i></a>
                </li>
            @endif

        </ul>
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

</body>

</html>
