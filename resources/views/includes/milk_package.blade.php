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
                    <h1 class="text-center leader-title">Các gói Sữa</h1>
                    <div class="row" id="document">
                        @foreach ($packet as $item)

                            @php
                                $id = $item['id'];
                            @endphp
                            <div class="col-lg-4 clo-md-4">
                                <div class="thumbnail document_total text-center" style="margin:15px 10px;">
                                    <a href="{{ asset('chi-tiet-goi-sua/id=' . $id) }}"><img src="{{ $item['image'] }}" alt=""
                                        style="border-top-left-radius:10px;border-top-right-radius:10px; height: 210px;width: 85%;"></a>
                                    <div>
                                        <a href="{{ asset('chi-tiet-goi-sua/id=' . $id) }}">
                                        <p style="padding-top: 10px; font-weight: bold; color:#000;">
                                            {!! $item['name'] !!}</p>
                                        <p class="name_doc">{!! $item['content'] !!}</p>
                                        </a>
                                        <div style="padding: 10px;">
                                            <p class="doc_down" style="float: left;">Giá: {{ number_format($item['price_from']) }}</p>
                                            <span>-</span>
                                            <p class="doc_down" style="float:right;">{{ number_format($item['price_to']) }} VNĐ</p>
                                        </div>
                                        <a href="{{ asset('dat-mua-sua/id='.$id) }}">
                                            <p class="btn-packet">Mua</p>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        @endforeach

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
