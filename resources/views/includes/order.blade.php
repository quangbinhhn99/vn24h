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
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Thông tin mua hàng: <span style="color: blue;">{{$packetdetail['name']}}</span></h1>
                                </div>
                                <form class="user" method="post" action="{{route('comfirmOrder')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Họ và tên</label>
                                        <input type="text" class="form-control form-control-user" id="" name="name" value="{{$infor['name']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Số điện thoại</label>
                                        <input type="text" class="form-control form-control-user" id="" name="phone" value="{{$infor['phone']}}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Địa chỉ</label>
                                        <input type="text" class="form-control form-control-user" value="{{$infor['address']}}" name="address">
                                    </div>
                                    @php
                                         $stt = $infor['code_branch']."-".$infor['code_ordinal'];
                                    @endphp
                                    <div class="form-group">
                                        <label for="">Mã STT</label>
                                        <input type="text" class="form-control form-control-user" id="" value="{{$stt}}" readonly name="code_ctv">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Số tiền mua</label>
                                        <input type="text" class="form-control form-control-user" id="money-fee"
                                            placeholder="Nhập số tiền mua" name="price">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nội dung mua</label>
                                        <textarea name="content" id="" rows="5" class="form-control " placeholder="Nội dung mua"></textarea>
                                    </div>
                                    <input type="hidden" name="packet_id" value="{{$packetdetail['id']}}">
                                    <div class="text-center">
                                        <a href="" class="btn btn-primary btn-user " style="width:25%;" data-toggle="modal" data-target="#OrderModal">
                                            Đặt mua
                                        </a>
                                    </div>
                                    <div class="modal fade" id="OrderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Xác nhận</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Nội dung chuyển tiền:</label>
                                                    <input type="text" class="form-control form-control-user" id="" name="content_payment" value="Chuyen tien mua sua {{$stt}}" readonly>
                                                </div>
                                                <div class="modal-body">
                                                    <label for="">Thông tin tài khoản: </label>
                                                    <input type="text" class="form-control form-control-user" id="" name="content_payment" value="Số tài khoản: 19135326970011, TechComBank - CTy CPTĐDD VN24h" readonly>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                                                    <button style="background: #fff;border: none;" type="submit"><a class="btn btn-primary">Gửi</a></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
<script>
    $("#money-fee").on('keyup', function() {
            var n = parseInt($(this).val().replace(/\D/g, ''), 10);
            if (!isNaN(n)) $(this).val(n.toLocaleString());
            else $(this).val();
        });
</script>
</html>
