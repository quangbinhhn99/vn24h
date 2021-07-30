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
    <link href="{{ asset('js/sweet-alert.js') }}" rel="stylesheet">

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
                    <div class="row">
                        <h2 class="text-left col-md-10 col-12">Danh sách văn phòng trụ sở: </h2>
                        <a class="col-md-2 col-12" href="{{ asset('admin/website/them-moi-tru-so') }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới + </button>
                        </a>

                    </div>
                    <table class="table table-striped table-responsive"  style="width:100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên trụ sở</th>
                                <th scope="col">Địa chỉ/SĐT</th>
                                <th scope="col" class="text-center">Ảnh </th>
                                <th scope="col" class="text-center">Nội dung</th>
                                {{-- <th scope="col" style="width: 20%">Link map</th> --}}
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{ dd($listEvent) }} --}}
                            @foreach ($listHeadquarter as $index => $data)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    <td style="vertical-align: middle ">
                                        {{ $data['name'] }}</td>
                                    <td style="vertical-align: middle ">
                                        <p>{{ $data['address'] }}
                                        </p>
                                        <p>{{ $data['phone'] }}</p>
                                    </td>
                                    <td class="products" style="vertical-align: middle "><img
                                        src="{{ $data['image'] }}">
                                </td>
                                    <td class="cutText" style="vertical-align: middle ">{!! $data['content'] !!}</td>
                                   
                                    {{-- <td class="" style="vertical-align: middle; display: position; width: 20%">
                                       
                                           {!! $data['link_map'] !!}
                                      
                                    </td> --}}
                                   
                                    <td style="vertical-align: middle ">
                                        <a href="{{ asset('admin/website/chi-tiet-tru-so/' . $data['id']) }}"
                                            class="btn btn-warning btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                            data-target="#delete{{ $data['id'] }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </td>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="delete{{ $data['id'] }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                <div class="modal-body">Tên: {{ $data['name'] }}</div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ asset('admin/website/xoa-tru-so/' . $data['id']) }}">Xoá</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    {{-- <ul class="pagination justify-content-end">
                      
                        <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                        @for ($i = 1; $i <= $totalPage; $i++)
                        <li class="page-item @if ($i == $currentPage) {{'active'}} @endif"><a class="page-link" href="{{ asset('/admin/san-pham/danh-sach/'.$i)}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                    </ul> --}}
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
