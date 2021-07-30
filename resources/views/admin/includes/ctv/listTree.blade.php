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
                        <h2 class="text-left col-md-10 col-12">Danh sách cây hệ thống: </h2>
                        <a class="col-md-2 col-12" href="{{ asset('admin/ctv/them-moi-cong-tac-vien') }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới CTV + </button>
                        </a>

                    </div>
                    <table class="table table-striped " style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="">Tên cây hệ thống</th>
                                <th scope="col" class="">Tổng doanh thu</th>
                                <th scope="col" class="">Số cộng tác viên</th>
                                <th scope="col">Chi tiết</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listTree as $index => $ctv)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    
                                    <td style="vertical-align: middle "> {{ $ctv['tree_name'] }}</td>
                                    <td style="vertical-align: middle "> {{ number_format($ctv['total_money']) }} VNĐ</td>
                                    <td style="vertical-align: middle "> {{ $ctv['quantity_ctv'] }} </td>
                                   
                                   
                                   
                                    <td style="vertical-align: middle ">
                                            <a href="{{asset('admin/ctv/danh-sach/1?code_branch='.$ctv['tree_name'])}}"
                                                class="btn btn-info btn-circle btn-sm">
                                                <i class="fas fa-info-circle"></i>
                                            </a>  
                                    </td>
                          
                                    
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
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
