
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
                <div class="container-fluid text-center">
                   <h2 class="m-3">Cập nhật mật khẩu</h2>
               
                   <form action="{{route('updatePassword')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Mật khẩu hiện tại: </label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="name" name="current_password" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="admin" class="col-sm-2 col-form-label">Mật khẩu mới: </label>
                        <div class="col-sm-9">
                          <input type="password" name="password" class="form-control" id="admin" value="">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password_confirmation" class="col-sm-2 col-form-label">Nhập lại mật khẩu: </label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" id="email" name="password_confirmation"  value="">
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">
                        Quay lại
                    </button>
                    <a href="{{ route('updatePassword')}}"><button class="btn btn-primary" type="submit">
                        Cập nhật
                    </button></a>
                    
                   </form>

                
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