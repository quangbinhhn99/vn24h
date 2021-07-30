
@include('admin.layout.head')
<body id="page-top">

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
                    <h2>Thông tin tài khoản: </h2>
                    <table class="table" boder="none">
                        <tr>
                            <th class="text-center">Họ tên: </th>
                            <td>{{ $infor['name']}}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Vai trò: </th>
                            <td>{{ $infor['role']['name']}}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Email: </th>
                            <td>{{ $infor['email']}}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Số điện thoại: </th>
                            <td>{{ $infor['phone']}}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Số chứng minh thư: </th>
                            <td>{{ $infor['cmt']}}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Địa chỉ: </th>
                            <td>{{$infor['address']}}</td>
                        </tr>
                        <tr class="mt-2">
                            <td class="text-right">
                            <a href="{{route('viewUpdateInfo')}}">
                
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

    @include('admin.layout.foot')



</body>

</html>