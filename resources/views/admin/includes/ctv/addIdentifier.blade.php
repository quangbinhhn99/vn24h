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
                    <div class="row">
                        <h2 class="text-left col-md-10 col-12">Thêm mới sản phẩm: </h2>
                    </div>

                    <form action="{{route('addIdentifier')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <div class="form-group">
                                <label for="name">Tên định danh: </label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Tên định danh ...">
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <label for="price">Số tiền: </label><br>
                            <input type="number" class="form-control" id="price" name="price" placeholder="Tổng số tiền ...">
                        </div>
                        <div class="form-group">
                            <label for="share_number">Cổ phần: </label><br>
                            <input type="number" class="form-control" id="share_number" name="share_number" placeholder="Cổ phẩn ...">
                        </div>
                        <div class="form-group">
                            <label for="money">Số tiền thưởng trực tiếp: </label><br>
                            <input type="number" class="form-control" id="money" name="money" placeholder="Số tiền thưởng trực tiếp ...">
                        </div>
                        
                        <button type="submit" class="btn btn-secondary">Quay lại</button>
                        <a href="{{route('addIdentifier')}}"><button type="submit" class="btn btn-primary">Thêm mới</button></a>
                    </form>

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
