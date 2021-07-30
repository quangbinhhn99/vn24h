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
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">



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
                <div class="container">
                    <h2>Chi tiết khuyến mãi:</h2>
                    <table class="table table-responsive" boder="none">
                        <tr>
                            <th class="text-center" style="width:20%">Tên tiêu đề: </th>
                            <td class="">{{ $promotion['title'] }}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Ảnh: </th>
                            <td class="products"><img src="{{ $promotion['image'] }}" alt="" style="margin:0px"></td>
                        </tr>
                        <tr>
                            <th class="text-center">Video: </th>
                            <td>
                                <p><a href="{{ $promotion['video'] }}">{{ $promotion['video'] }}</a></p>
                                @if ($promotion['video'] != null)
                                    @php
                                        $linkvd = $promotion['video'];
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
                                    <iframe src="https://www.youtube.com/embed/{{ $url }}?autoplay=0">
                                    </iframe>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">Nội dung khuyễn mãi: </th>
                            <td>{!! $promotion['content'] !!}</td>
                        </tr>
                    
                        <tr class="mt-2">
                            <td class="text-right">
                                <a href="{{ URL::previous() }}">

                                    <button class="btn btn-secondary" type="button">
                                        Quay lại
                                    </button>

                                </a>
                            </td>
                            <td>
                                <a href="{{ route('viewUpdatePromotion', ['id'=>$promotion['id']]) }}">

                                    <button class="btn btn-primary" type="button">
                                        Cập nhật
                                    </button>

                                </a>
                            </td>

                        </tr>
                    </table>


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
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    @include('sweetalert::alert')




</body>

</html>
