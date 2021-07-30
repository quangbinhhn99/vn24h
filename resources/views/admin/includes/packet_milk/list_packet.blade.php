<?php
    $token = Cookie::get('tokenvn24h');
?>
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
    <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">
    

</head>
@include('sweetalert::alert')
<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
       @include('admin/layout/menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="contents">

                <!-- Topbar -->
               @include('admin/layout/header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="row">
                        <h2 class="text-left col-md-10 col-12">Danh sách gói sữa: </h2>
                        <a class="col-md-2 col-12" href="{{ asset('admin/goi-sua') }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới + </button>
                        </a>

                    </div>
                    <table class="table table-striped table-responsive">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">STT</th>
                                <th scope="col">Tên gói</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Giá mua tối thiểu</th>
                                <th scope="col">Giá mua tối đa</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                    
                            @endphp
                            @foreach ($listPacket as $index => $packet)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    
                                    <td style="vertical-align: middle ">{{ $packet['name'] }}</td>
                                    <td class="products" style="vertical-align: middle "><img
                                        src="{{ $packet['image'] }}" style="height: 130px;"></td>
                                    
                                    </td>
                                    <td class="" style="vertical-align: middle;">{{ number_format($packet['price_from']) }} VNĐ</td>
                                    <td class="" style="vertical-align: middle;">{{ number_format($packet['price_to']) }} VNĐ</td>
                                    <td class="cutText" style="vertical-align: middle ">{!! $packet['content'] !!}
                                    <td style="vertical-align: middle ">
                                        <a href="{{ asset('admin/chi-tiet-goi-sua/' . $packet['id']) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        <a class="btn btn-danger btn-circle btn-sm"  data-toggle="modal"
                                            data-target="#delete{{ $packet['id'] }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </td>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="delete{{ $packet['id'] }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                @php
                                                    $id = $packet['id'];
                                                @endphp
                                                <form action="{{route('deleteSP', $id)}}" method="post">
                                                    @csrf
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn muốn
                                                        xoá?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <input type="hidden" id="token1" value="{{ $token }}">
                                                <input type="hidden" id="id1" value="{{ $packet['id'] }}">
                                                <div class="modal-body">Sản phẩm: {{ $packet['name'] }}</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                        <button type="submit" style="border: none;
                                                        background: #fff;"><a class="btn btn-danger" 
                                                    > Xoá</a></button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    </nav>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
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

  


</body>

</html>