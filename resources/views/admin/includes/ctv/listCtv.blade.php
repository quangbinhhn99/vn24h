@php
$totalPage = $response['data']['list']['last_page'];
$currentPage = $response['data']['list']['current_page'];

@endphp
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
                        <h2 class="text-left col-md-10 col-12">Danh sách doanh số cộng tác viên: </h2>
                        <a class="col-md-2 col-12" href="{{ asset('admin/ctv/them-moi-cong-tac-vien') }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới CTV + </button>
                        </a>

                    </div>
                    <div>
                        <form action="{{asset('admin/ctv/danh-sach/1')}}" method="get">
                            <div style="display: flex" class="row">
                                <div class="form-group m-2 col-md-3 col-12">
                                    <label for="">Từ ngày:</label>
                                    <input type="date" class="form-control" name="from_date" value="{{ $from_date}}">
                                </div>

                                <div class="form-group m-2 col-md-3 col-12">
                                    <label for="">Đến ngày:</label>
                                    <input type="date" class="form-control" name="to_date" value="{{$to_date}}">
                                </div>
                                <div class="form-group m-2 col-md-3 col-12">
                                    <label for="">Hệ thống:</label>
                                    <select class="form-control" id="exampleSelect1" name="code_branch">
                                        <option value="">Tất cả</option>
                                       @foreach ($listTree as $tree)
                                           <option value="{{$tree['tree_name']}}" @if($code_branch == $tree['tree_name']) {{"selected"}} @endif> {{$tree['tree_name']}}</option>
                                       @endforeach
                                    </select>
                                </div>
                                <div class="form-group m-2 mt-3 col-md-1 col-12">
                                    <label for=""></label>
                                    <a href="{{asset('admin/ctv/danh-sach/1')}}"><button class="btn btn-primary form-control" type="submit">
                                        <i class="fas fa-search fa-sm"></i>
                                    </button></a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div>
                        <span class="text-danger"><b>Tổng thành viên : {{$response['data']['quantity_ctv']}}</b></span><br>
                        <span class="text-danger"><b>Tổng doanh số : {{ number_format($response['data']['total_money']) }} Đ</b></span>
                    </div>
                    <table class="table table-striped table-responsive" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Mã CTV</th>
                                <th scope="col" class="text-center">Tên CTV</th>
                                <th scope="col">Tên định danh</th>
                                <th scope="col" class="text-center">Tổng giá tiền</th>
                                <th scope="col">Cổ phần</th>
                                <th scope="col">Số tiền thưởng trực tiếp</th>
                                <th scope="col">Ngày tham gia</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listCtv as $index => $ctv)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    <td class="products" style="vertical-align: middle ">
                                        {{ $ctv['code_branch'] }}-{{ $ctv['code_ordinal'] }}</td>
                                    <td style="vertical-align: middle "> {{ $ctv['name'] }}</td>
                                    <td style="vertical-align: middle ">{{ $ctv['identifier_name'] }}
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ number_format($ctv['total_money']) }} Đ
                                    </td>
                                    <td style="vertical-align: middle ">{{ $ctv['share_number'] }}
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ number_format($ctv['identifier_money']) }} Đ
                                    </td>
                                    <td>
                                        {{ date('d-m-Y', strtotime($ctv['created_at']) + 7 * 60 * 60) }}
                                    </td>
                                    <td style="vertical-align: middle ">
                                        <a href="{{ asset('admin/ctv/chi-tiet-cong-tac-vien/' . $ctv['id'] ) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                            data-target="#delete{{ $ctv['id'] }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </td>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="delete{{ $ctv['id'] }}" tabindex="-1" role="dialog"
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
                                                    <p>Mã CTV: {{ $ctv['code_branch'] }}-{{ $ctv['code_ordinal'] }} </p>
                                                    <p>Tên CTV: {{$ctv['name']}}</p>
                                                    {{-- <p>Giá mua: {{number_format($ctv['price']) }} Đ</p> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ asset('admin/ctv/xoa-ctv/' . $ctv['id']) }}">Xoá</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <ul class="pagination justify-content-end">

                        <li class="page-item @if($currentPage == 1) {{"disabled"}} @endif"><a class="page-link" href="{{ asset('/admin/ctv/danh-sach/' .($currentPage-1) )}}">Trước</a></li>
                        @for ($i = 1; $i <= $totalPage; $i++)
                            <li class="page-item @if ($i==$currentPage) {{ 'active' }} @endif"><a class="page-link" type="submit"
                                    href="{{ asset('/admin/ctv/danh-sach/' . $i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                        <li class="page-item @if($currentPage == $totalPage) {{"disabled"}} @endif"><a class="page-link" href="{{asset('/admin/ctv/danh-sach/' .($currentPage+1)) }}">Sau</a></li>
                    </ul>
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
