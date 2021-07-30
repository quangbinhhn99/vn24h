<!DOCTYPE html>
<html>
    <head>

        <title>Chính sách</title>
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
        <link href="//cdn.muicss.com/mui-0.10.3/css/mui.min.css" rel="stylesheet" type="text/css" />
        <script src="//cdn.muicss.com/mui-0.10.3/js/mui.min.js"></script>
        {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous"> --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    </head>

    <body>
    @include('layout.header')
    
    <?php 
        // $dem = 1;  
        // $dem1 = 1;
    ?>
    <?php 
        $d = 1;  
        $d1 = 1;
    ?>
    <div class="container">
        <div class="row">
			<ul class="{{--mui-tabs__bar--}} mui-app tab-policy" id="next-step" style="margin-top:30px;">
                @foreach ($listdata as $item)
                    <div class="cskd col-md-3 col-sm-12 col-12" style="height: 250px;">
                        <li @if($d==1) class="mui--is-active" @endif><a href="#{{$item['id']}}" style="text-decoration: none; color: black;" data-mui-toggle="tab" data-mui-controls="pane-default-{{$item['id']}}">
                            <div class="square @if($d==1) redSquare   @endif">
                                
                                    <div style="cursor: pointer;" >
                                        <img src="{{$item['icon']}}" style="height: 100px;">
                                        <h4 class="text-center p-3">{{ $item['title'] }} </h4>
                                    </div>
                                    <div style="text-alight:center; white-space: normal; height:60px; font-size: 12px; color: #959292;
                                    width: 100%; 
                                    overflow: hidden;
                                    text-overflow: ellipsis;" class="text-center">{!! $item['content'] !!}</div>
                                
                            </div></a>
                        </li>
                    </div>
                    {{-- <div class="nextStep{{$dem}} none"></div> --}}
                    <?php $d++; ?> 
                @endforeach
			</ul>
		</div>
    </div>

    @foreach ($listdata as $item)	
        <div class="mui-tabs__pane step-mui-app @if($d1==1) mui--is-active @endif"  id="pane-default-{{$item['id']}}" style="margin-top:0;">
            <div class="container-fluid bg-policy" id="{{$item['id']}}">
                <div class="row policy" style="margin-top: 12%;">
                    <div class="col-md-12 col-sm-12">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="title">{{$item['title']}}</div>
                                <div class="img"><img style="width:60%;" src="{{$item['image']}}" alt="#"></div>
                            </div>
                            <div class="col-md-7">
                                <div class="content">
                                    <p>{!!$item['content']!!}</p>  
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php $d1++;?>
    @endforeach
        
    
        @include('layout.footer')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/custom-navigation.js') }}"></script>
    <script src="{{ asset('js/custom-flex.js') }}"></script>

    <script src="{{ asset('js/custom-date-picker.js') }}"></script>
    <script src="{{ asset('js/owl-carousel/owl.carousel.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    
</body>
    <script>
        $(document).ready(function(){
            $("#show").show();
        });
    </script>

</html>