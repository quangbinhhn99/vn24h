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
                    <h1 class="text-center leader-title">Danh sách chi tiết mua {!!$buydetail['packet']['name']!!}</h1>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            @php
                                $date = date(' d-m-Y', strtotime($buydetail['created_at']));
								$time = date(' H:i', strtotime($buydetail['created_at']));
                            @endphp
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="font-size: 15px;">
                                    <thead>
                                        <tr>
                                            <th>Tên gói</th>
                                            <th>{!!$buydetail['packet']['name']!!}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th style="padding-bottom:80px;">Ảnh</th>
                                            <th><img src="{{$buydetail['packet']['image']}}" alt="" style="height: 150px;"></th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Giá mua</th>
                                            <th>{{number_format($buydetail['price'])}} VNĐ</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Thời gian mua</th>
                                            <th>{{$date}}<br>{{$time}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Địa chỉ</th>
                                            <th>{{$buydetail['address']}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Điện thoại</th>
                                            <th>{{$buydetail['phone']}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Mã</th>
                                            <th>{{$buydetail['code_ctv']}}</th>
                                            
                                        </tr>
                                        <tr>
                                            <th>Nội dung mua</th>
                                            <th><p><span style="width:100%;">{!!$buydetail['content']!!}</span></p></th>
                                            
                                        </tr>
                                    </thead>
                                   
                                  
                                </table>
                            </div>
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
