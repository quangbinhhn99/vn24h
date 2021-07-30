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
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Thông tin CTV mua:</h3>
                            <table class="table table-responsive" boder="none">
                                <tr>
                                    <th>Mã CTV: </th>
                                    <td class="">{{ $ctv['code_ctv'] }}</td>
                                </tr>
                                <tr>
                                    <th>Tên CTV: </th>
                                    <td class="">{{ $ctv['name'] }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại: </th>
                                    <td class="">{{ $ctv['phone'] }}</td>
                                <tr>
                                    <th>Địa chỉ: </th>
                                    <td>{{ $ctv['address'] }}</td>
                                </tr>

                            </table>
                        </div>
                        <div class="col-md-6 col-12">
                            <h3>Thông tin gói:</h3>
                            <table class="table table-responsive" boder="none">
                                <tr>
                                    <th>Tên gói: </th>
                                    <td>{{ $ctv['packet']['name'] }}</td>
                                </tr>
                                <tr>
                                    <th>Nội dung gói: </th>
                                    <td>{{ $ctv['packet']['content'] }}</td>
                                </tr>
                                <tr>
                                    <th>Giá mua tối thiểu: </th>
                                    <td>{{ number_format($ctv['packet']['price_from']) }} Đ</td>

                                </tr>
                                <tr>
                                    <th>Giá mua tối đa: </th>
                                    <td>{{ number_format($ctv['packet']['price_to']) }} Đ</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <hr>
                    <div >
                    <h3>Thông tin mua gói: </h3>
                    <form action="{{ asset('admin/mua-goi/thay-doi-trang-thai/' .$ctv['id'])}}" method="post">
                        @csrf
                        @method('PUT')
                    <table class="table" boder="none" style="dislay: inline-table !important">
                        <tr >
                            <th>Người mua: </th>
                            <td >{{ $ctv['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Gói mua: </th>
                            <td>{{ $ctv['packet']['name'] }}</td>
                        </tr>
                        <tr>
                            <th>Nội dung mua: </th>
                            <td>{{ $ctv['content'] }}</td>
                        </tr>
                        <tr>
                            <th>Giá mua: </th>
                            <td>{{ number_format($ctv['price']) }} Đ</td>
                        </tr>
                        <tr>
                            <th>Nội dung chuyển tiền: </th>
                            <td>{{ $ctv['content_payment'] }}</td>
                        </tr>
                        <tr>
                            <th>Trạng thái: </th>
                            <td class="form-group">
                                <select class="form-control" name="status" value="">
                                    <option value="1" @if ($ctv['status'] == 1) {{ 'selected' }} @endif>Chờ xác nhận</option>
                                    <option value="2" @if ($ctv['status'] == 2) {{ 'selected' }} @endif>Đã xác nhận</option>
                                    <option value="3" @if ($ctv['status'] == 3) {{ 'selected' }} @endif>Hoàn thành</option>
                                    <option value="4" @if ($ctv['status'] == 4) {{ 'selected' }} @endif>Đã huỷ</option>

                                </select>
                            </td>
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
                                <a href="{{ asset('admin/mua-goi/thay-doi-trang-thai/' .$ctv['id'])}}">

                                <button class="btn btn-primary" type="submit">
                                    Lưu
                                </button>

                                </a>
                            </td>

                            

                        </tr>
                    </table>
                    </form>
                    </div>


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
