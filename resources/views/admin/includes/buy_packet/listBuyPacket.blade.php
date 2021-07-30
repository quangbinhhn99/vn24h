@php
$totalPage = $response['data']['list_buy_packet']['last_page'];
$currentPage = $response['data']['list_buy_packet']['current_page'];

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
                        <h2 class="text-left col-md-10 col-12">Danh sách mua gói sữa: </h2>
                    </div>
                    <table class="table table-striped table-responsive" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Mã CTV</th>
                                <th scope="col" class="text-center">Tên người mua</th>
                                <th scope="col" >Gói mua</th>
                                <th scope="col" >Giá mua</th>
                                <th scope="col" >Nội dung mua</th>
                                <th scope="col">Nội dung chuyển khoản</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBuyPacket as $index => $ctv)
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    <td class="products" style="vertical-align: middle ">{{ $ctv['code_ctv']}}</td>
                                    <td style="vertical-align: middle ">
                                        <b>{{ $ctv['name'] }}</b><br>
                                        <p>{{ $ctv['phone'] }}</p>
                                        {{-- <p>{{ $ctv['address']}}</p> --}}
                                    </td>
                                    <td style="vertical-align: middle ">{{ $ctv['packet']['name'] }} 
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ number_format($ctv['price']) }} Đ
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ $ctv['content'] }}
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ $ctv['content_payment'] }}
                                    </td>
                                    <td style="vertical-align: middle; ">
                                        @php $status = $ctv['status']; @endphp
                                        @if ($status == 1) {{"Chờ xác nhận"}}
                                        @elseif ($status == 2) {{"Đã xác nhận"}}
                                        @elseif($status == 3) {{"Hoàn thành"}}
                                        @elseif($status == 4) {{"Đã huỷ"}}
                                            
                                        @endif                                                                                                                                                                         
                                        
                                    </td>
                                    <td style="vertical-align: middle ">
                                        <a href="{{ asset('admin/mua-goi/chi-tiet/' . $ctv['id']) }}"
                                            class="btn btn-info btn-circle btn-sm">
                                            <i class="fas fa-info-circle"></i>
                                        </a>

                                        <a class="btn btn-danger btn-circle btn-sm" href="" data-toggle="modal"
                                            data-target="#delete{{ $ctv['id'] }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </td>
                                    <!-- delete Modal-->
                                    <div class="modal fade" id="delete{{ $ctv['id'] }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                                    <p>Mã CTV: {{ $ctv['code_ctv'] }}</p>
                                                    <p>Tên gói mua: {{$ctv['packet']['name']}}</p>
                                                    <p>Giá mua: {{number_format($ctv['price']) }} Đ</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ asset('admin/mua-goi/xoa/' . $ctv['id']) }}">Xoá</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <ul class="pagination justify-content-end">
                      
                        <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                        @for($i=1; $i<=$totalPage; $i++)
                        <li class="page-item @if($i == $currentPage) {{'active'}} @endif"><a class="page-link" href="{{ asset('/admin/san-pham/danh-sach/'.$i)}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="#">Sau</a></li>
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
