<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ</title>


    @include('layout/libcss')

</head>

<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">

                @include('layout/header')

                <div class="container">
                    @php
                        $id = $packetdetail['id'];
                    @endphp
                    <h1 class="text-center leader-title">{{$packetdetail['name']}}</h1>
                
                            
                                    <div class="thumbnail document_total text-center" style="margin:0 10px;">
                                        <img src="{{ $packetdetail['image'] }}" alt=""
                                            style="border-top-left-radius:10px;border-top-right-radius:10px; height: 210px;">
                                        <div>
                                            <p style="text-align: left;padding: 20px 0 0 20px;">{!!$packetdetail['content']!!}</p>
                                            <div style="padding: 0 20px;">
                                                <p class="doc_down" style="text-align: left;">Giá: {{number_format($packetdetail['price_from'])}}<span>-</span>
                                                <span >{{number_format($packetdetail['price_to'])}} VNĐ</span></p>
                                            </div>
                                            <a href="{{ asset('dat-mua-sua/id='.$id) }}"><p class="btn-packet  ">Mua</p></a>
                                        </div>

                                    </div>
                

  
                </div>

            </div>
            @include('layout/footer')
        </div>


    </div>



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layout/libjs')

</body>

</html>
