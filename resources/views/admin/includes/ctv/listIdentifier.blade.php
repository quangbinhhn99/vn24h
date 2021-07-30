@include('admin.layout.head')


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
                    <div class="row">
                        <h2 class="text-left col-md-10 col-12">Danh sách định danh CTV: </h2>
                        <a class="col-md-2 col-12" href="{{ asset('admin/ctv/them-dinh-danh') }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới + </button>
                        </a>

                    </div>
                    <table class="table table-striped table-responsive" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên định danh</th>
                                <th scope="col">Số tiền</th>
                                <th scope="col" class="none">Cổ phần</th>
                                <th scope="col" class="none">Số tiền thưởng trực tiếp</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listIdentifier as $index => $data)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    <td class="products" style="vertical-align: middle ">
                                        {{ $data['name'] }}</td>
                                    <td style="vertical-align: middle "> {{number_format($data['price']) }} Đ</td>
                                    <td style="vertical-align: middle " class="none">{{ $data['share_number'] }}
                                    </td>
                                    <td style="vertical-align: middle;" class="none">
                                        {{number_format($data['money']) }} Đ
                                    </td>
                                  
                                    <td style="vertical-align: middle ">
                                        <a href="{{ asset('admin/ctv/cap-nhat/' . $data['id']) }}"
                                            class="btn btn-info btn-circle btn-sm">
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
                                                <div class="modal-body">
                                                    <p>Tên định danh: {{$data['name']}}</p>
                                                    {{-- <p>Giá mua: {{number_format($ctv['price']) }} Đ</p> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ asset('admin/ctv/xoa/' . $data['id']) }}">Xoá</a>
                                                </div>
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


    @include('admin.layout.foot')
</body>

</html>
