<!DOCTYPE html>
<html>
    <head>

        <title>Sự kiện</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="icon" href="{{ asset('img/logo1.jpg') }}" type="image/x-icon">
    
        <!-- Bootstrap Stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    
        <!-- Custom Stylesheets -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}"> 
        <link rel="stylesheet" href="{{ asset('css/binh.css') }}">
        <link rel="stylesheet" id="cpswitch" href="{{ asset('css/orange.css') }}">
        <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
        <link rel="stylesheet" href="{{ asset('css/vinh.css') }}">
        <link rel="stylesheet" href="{{ asset('css/footer.css' )}}">
        <link class="cssdeck" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
        <!-- Owl Carousel Stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.css') }}">
        <link rel="stylesheet" href="{{ asset('css/owl.theme.css') }}">
    
        <!-- Flex Slider Stylesheet -->
        <link rel="stylesheet" href="{{ asset('css/flexslider.css') }}" type="text/css" />
    
        <!--Date-Picker Stylesheet-->
        <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    </head>

    <body>
        @include('layout.header')
<div class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                {{-- column-middle --}}
                <div class="column-middle" style="margin-top: 70px;">
                    <p style="color: black; font-size: 30px; font-weight: 700;">Sự Kiện Nổi Bật</p>
                    <p style="color: black; font-size: 25px; font-weight: 500; margin-bottom: 5%;">Của Chúng Tôi</p>
                    @foreach ($listdata['data'] as $item)
                    <div class="box-event">
                        <div class="img"><img style="width:100%;" src="{{$item['image']}}" alt="#"></div>
                        <div class="title">{{$item['title']}}</div>
                        <div class="time">
                            <div class="img"><img src="{{asset('img/Time-Circle.png')}}" alt="#"></div>&nbsp;
                            {{ $date = date(' d-m-Y', strtotime($item['created_at']) + 7*60*60)}}
                        </div>
                        <div class="content" style="text-alight:center; white-space: normal; height:60px; 
                            width: 90%; 
                            overflow: hidden;
                            text-overflow: ellipsis;;" class="text-center">{!! $item['content'] !!}</div>
                        <div class="seemore">
                            <a href="{{route('event-detail', $item['id'])}}"><button class="promotion_program_btn">Xem thêm</button></a>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{-- /column-middle --}}
                @php
                    if (isset($listdata)) {
                        $page = $listdata['current_page'];
                    } else {
                        $page = $listdata['current_page'];
                    }
                @endphp
                {{-- =
                {{-- pagination --}}
                <section  @if($listdata['last_page']==1) style="display:none;" @endif>
                    <div style="display:flex; justify-content:center">
                        <ul class="pagination1
                         mt-4 mr-3" style="float: right;">
             
                         @if ($page > 1)
                             <li class="page-item mr-2"><a style="color: #A2A6B0" class="page-link"
                                     href="{{ asset('su-kien/page=' . ($page - 1)) }}">
                                     <i class="fas fa-angle-left"></i></a>
                             </li>
                         @endif
                         @for ($i = $page - 1; $i <= $page + 1; $i++)
             
                             @if ($i > 0 && $i <= $listdata['last_page']) 
                                 <li class="page-item mr-2">
                                 <a href="{{ asset('su-kien/page=' . $i) }}" class="page-link         
                                 @if ($page==$i) {{ 'activePagi1' }} 
                                     @else {{ 'pagNoActive' }} 
                                 @endif"href="#">{{ $i }}</a></li>
                             @endif
             
                         @endfor
                         @if ($page < $listdata['last_page'])
                             <li class="page-item mr-2"><a style="color: #A2A6B0" class="page-link"
                                     href="{{ asset('su-kien/page=' . ($page + 1)) }}">
                                     <i class="fas fa-angle-right"></i></a>
                             </li>
                         @endif
             
                     </ul>
                    </div>
                </section>
                {{-- /pagination --}}
            </div>
            <div class="col-md-4">
                {{-- column-right --}}
                <div class="column-right" style="margin-top: 130px;">
                    <p style="color: black; font-size: 25px; font-weight: 700;">Tin Liên Quan</p>
                    @foreach ($listdata['data'] as $item)
                        <div class="box-new" style="display: flex">
                            <div class="img" style="width:24%; margin-left: 5%; margin-top:8%;"><img src="{{$item['image']}}" alt="" width="70px" height="60px"></div>
                            <div style="margin-left: 5%;">
                                <div class="title">{{$item['title']}}</div>
                                <div class="time">
                                    <div class="img"><img src="{{asset('img/time.png')}}" alt="#"></div>&nbsp;
                                    {{ $date = date(' d-m-Y', strtotime($item['created_at']) + 7*60*60)}}
                                </div>
                                <div class="content" style="text-alight:center; white-space: normal; height:60px; 
                            width: 90%; 
                            overflow: hidden;
                            text-overflow: ellipsis;;" class="text-center">{!! $item['content'] !!}</div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- column-right --}}
            </div>
        </div>
    </div>
</div>

        @include('layout.footer')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/custom-navigation.js') }}"></script>
    <script src="{{ asset('js/custom-flex.js') }}"></script>

    <script src="{{ asset('js/custom-date-picker.js') }}"></script>
    <script src="{{ asset('js/owl-carousel/owl.carousel.js') }}"></script>
    </body>

</html>