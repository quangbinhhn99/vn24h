<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/logo1.jpg') }}" type="image/x-icon">
    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">
    @include('sweetalert::alert')


    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin/layout/menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin/layout/header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <h3>Thông tin sản phẩm: </h3>
                    <div class=" row" style="width: 80%">
                        <div class="col-md-4">
                            <b class="text-center">Tên sản phẩm: </b>
                            <div class="">{{ $product['name'] }}</div>
                        </div>
                        <div class="col-md-4">
                            <b class="text-center">Ảnh: </b>
                            <div class="products"><img src="{{ $product['image'] }}" alt="" style="margin:0px"></div>
                        </div>
                        <div class="col-md-4">
                            <b class="text-center">Mô tả: </b>
                            <div class="cutText">{!! $product['description'] !!}</div>
                        </div>
                    </div>

                    <div class="row">
                        <h3 class="text-left col-md-10 col-12">Cảm nhận về sản phẩm: </h3>
                        <a class="col-md-2 col-12" href="{{ route('viewAddProductFeel', ['id'=>$product['id'] ]) }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới + </button>
                        </a>

                    </div>
                    @if(count($productFeel)==0) {{"Sản phẩm này chưa có cảm nhận."}}
                    @else
                    <table class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">User</th>
                                <th scope="col">Nội dung cảm nhận</th>
                                <th scope="col">Video</th>
                                <th scope="col">Ngày tạo</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productFeel as $index => $feel)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    <td class="row" style="">
                                        <div class="products col-md-6" ><img src="{{ $feel['avatar'] }}" style="max-width:70px; border-radius: 50%; float: right "></div>
                                        <b class="col-md-6">{{ $feel['name'] }}</b>
                                    <td style="width: 30%">{!! $feel['content'] !!}</td>
                                    <td class="" style="vertical-align: middle; display: position ">
                                        <p><a href="{{$feel['video']}}">{{$feel['video']}}</a></p>
                                        @if($feel['video']!=null)
                                        @php
                                        $linkvd = $feel['video'];
                                        $check = substr($linkvd, 0, 5);
                                        // dd($check);
                                        if ($check == 'https') {
                                        $num = 32;
                                        } else {
                                        $num = 31;
                                        }
                                        $url = substr($linkvd,$num);
                                        // dd($url);
                                        @endphp
                                        <iframe src="https://www.youtube.com/embed/{{ $url }}?autoplay=0">
                                        </iframe>
                                        @endif


                                    </td>
                                    <td class="">
                                        {{ date('d-m-Y', strtotime($feel['created_at']) + 7 * 60 * 60) }}</td>

                                    <td style="vertical-align: middle ">
                                        <a href="{{ asset('admin/san-pham/cap-nhat-cam-nhan-san-pham/' . $feel['id']) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                            data-target="#delete{{ $feel['id'] }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </td>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="delete{{ $feel['id'] }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn muốn
                                                        xoá?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Cảm nhận sản phẩm của: {{ $feel['name'] }}</p>
                                                    <p>Nội dung: {!! $feel['content'] !!}</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ asset('admin/san-pham/xoa-cam-nhan/' .$feel['id']) }}">Xoá</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    @endif

                    </nav>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



            <!-- Footer -->
            @include('admin.layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    @include('sweetalert::alert')





</body>

</html>
