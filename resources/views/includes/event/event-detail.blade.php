<!DOCTYPE html>
<html>
<head>

        <title>Chi tiết Sự kiện</title>
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
                <div class="column-middle" style="margin-top: 50px;">
                    <div class="box-event" style="box-shadow:none;">
                        <div class="img"><img style="width:100%;" src="{{$listdata['image']}}" alt="#"></div>
                        <div class="title">{!! $listdata['title'] !!}</div>
                        <div class="time">
                            <div class="img"><img src="{{asset('img/Time-Circle.png')}}" alt="#"></div>&nbsp;
                            {{ $date = date(' d-m-Y', strtotime($listdata['created_at']) + 7*60*60)}}
                        </div>
                        <div class="img2" >
                          
                            @php
                            $linkvd = $listdata['video'];
                            $check = substr($linkvd, 0, 5);
                            // dd($check);
                            if ($check == 'https') {
                                $num = 32;
                            } else {
                                $num = 31;
                            }
                            $url = substr($linkvd, $num);
                            // dd($url);
                        @endphp
                            <iframe width="100%" height="300px"src="https://www.youtube.com/embed/{{ $url }}?autoplay=0" frameborder="0"></iframe>
                           
                        </div>
                        <div class="content">{!! $listdata['content'] !!}</div>
                    </div>
                    {{-- <div class="big-event" style="display: flex;">
                        <div class="top" style="width:55%; margin-left: 4%;">
                            <div class="title">
                                <p style="font-size: 16px; font-weight: 700; color:black;">Sự Kiện Nổi bật</p>
                                <p style="font-size: 16px; font-weight: 500; color:black;">Của Chúng Tôi</p>
                            </div>
                            <div class="content" style="margin-right:4%;"><p>Năm nay, dù gặp nhiều khó khăn do ảnh hưởng của dịch Covid – 19 nhưng Ban lãnh đạo Công ty Cổ phần sữa Hà Lan vẫn luôn nỗ lực vượt qua khó khăn để sản xuất và phát triển công ty. Đồng thời, chung tay lan tỏa yêu thương bằng những hành động thiết thực để sẻ chia với những hộ gia đình có hoàn cảnh khó khăn trên địa bàn xã Hồng Phong.</p>

                                <p>Với tinh thần tương thân tương ái, lá lành đùm lá rách, từ nhiều năm nay Công ty Cổ phần sữa Hà Lan (địa chỉ: Khu sinh thái Đồng Khê, Thị trấn Nam Sách, huyện Nam Sách, tỉnh Hải Dương) luôn dành sự quan tâm, những phần quà ý nghĩa để dành tặng cho các hộ gia đình có hoàn cảnh khó khăn nhân dịp Tết đến xuân về.</p>
                                
                                    <p>Theo ông Phan Minh Tiên – Giám đốc Điều hành Marketing của Vinamilk, thì sữa nước là ngành hàng chủ lực được Vinamilk chú trọng đầu tư. Bên cạnh việc đảm bảo về chất lượng và giá trị dinh dưỡng cao cho sản phẩm, thì Vinamilk </p>
                                
                            </div>
                        </div>
                        <div class="img" style="width:55%;"><img style="width:100%;" src="{{asset('img/img-event5.png')}}" alt="#"></div>
                    </div> --}}
                </div>
                {{-- /column-middle --}}
            </div>

            <div class="col-md-4">
                {{-- column-right --}}
                <div class="column-right" style="margin-top: 50px;">
                    <p style="color: black; font-size: 25px; font-weight: 700;">Tin Liên Quan</p>
                    <div class="box-new" style="display: flex">
                        <div class="img" style="width:24%; margin-left: 5%; margin-top:8%;"><img src="{{asset('img/new-event.png')}}" alt=""></div>
                        <div style="margin-left: 5%;">
                            <div class="title">Việt Nam 24h Và Sứ Mệnh Chăm Sóc</div>
                            <div class="time">
                                <div class="img"><img src="{{asset('img/time.png')}}" alt="#"></div>&nbsp;
                                Ngày 5/4/2020
                            </div>
                            <div class="content">Tọa lạc tại khu sinh thái Đồng Khê, thị trấn Nam Sách</div>
                        </div>
                    </div>
                    <div class="box-new" style="display: flex">
                        <div class="img" style="width:24%; margin-left: 5%; margin-top:8%;"><img src="{{asset('img/new-event.png')}}" alt=""></div>
                        <div style="margin-left: 5%;">
                            <div class="title">Việt Nam 24h Và Sứ Mệnh Chăm Sóc</div>
                            <div class="time">
                                <div class="img"><img src="{{asset('img/time.png')}}" alt="#"></div>&nbsp;
                                Ngày 5/4/2020
                            </div>
                            <div class="content">Tọa lạc tại khu sinh thái Đồng Khê, thị trấn Nam Sách</div>
                        </div>
                    </div>
                    <div class="box-new" style="display: flex">
                        <div class="img" style="width:24%; margin-left: 5%; margin-top:8%;"><img src="{{asset('img/new-event.png')}}" alt=""></div>
                        <div style="margin-left: 5%;">
                            <div class="title">Việt Nam 24h Và Sứ Mệnh Chăm Sóc</div>
                            <div class="time">
                                <div class="img"><img src="{{asset('img/time.png')}}" alt="#"></div>&nbsp;
                                Ngày 5/4/2020
                            </div>
                            <div class="content">Tọa lạc tại khu sinh thái Đồng Khê, thị trấn Nam Sách</div>
                        </div>
                    </div>
                    <div class="box-new" style="display: flex">
                        <div class="img" style="width:24%; margin-left: 5%; margin-top:8%;"><img src="{{asset('img/new-event.png')}}" alt=""></div>
                        <div style="margin-left: 5%;">
                            <div class="title">Việt Nam 24h Và Sứ Mệnh Chăm Sóc</div>
                            <div class="time">
                                <div class="img"><img src="{{asset('img/time.png')}}" alt="#"></div>&nbsp;
                                Ngày 5/4/2020
                            </div>
                            <div class="content">Tọa lạc tại khu sinh thái Đồng Khê, thị trấn Nam Sách</div>
                        </div>
                    </div>  
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