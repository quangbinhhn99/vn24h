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
                   <h2 class="m-3">Cập nhật thông tin</h2>
                   @if(isset($infor) && $infor!=null)
                   <form action="{{route('updateInfo')}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Họ tên: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="name" name="name" placeholder="Nhập họ tên..." value="{{$infor['name']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="admin" class="col-sm-2 col-form-label">Vai trò: </label>
                        <div class="col-sm-9">
                          <input readonly type="text" class="form-control" id="admin" value="{{ $infor['role']['name']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email: </label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email..."  value="{{$infor['email']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone" class="col-sm-2 col-form-label">Số điện thoại: </label>
                        <div class="col-sm-9">
                          <input type="number" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại..." value="{{$infor['phone']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="cmt" class="col-sm-2 col-form-label">Số CMT: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="cmt" name="cmt" placeholder="Nhập số CMT..." value="{{ $infor['cmt']}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Địa chỉ: </label>
                        <div class="col-sm-9">
                          <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ..." value="{{$infor['address']}}">
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">
                        Quay lại
                    </button>
                    <a href="{{ route('updateInfo')}}"><button class="btn btn-primary" type="submit">
                        Cập nhật
                    </button></a>
                    
                   </form>

                   @endif
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