@php
$totalPage = $listCtv['last_page'];
$currentPage = $listCtv['current_page'];

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
                <div style="float: right">
                    <a href="{{ route('backPage') }}"><button type="submit" class="btn btn-secondary">
                            Quay lại</button>
                    </a>

                    <a href="{{ asset('admin/ctv/cap-nhat-thong-tin/'.$id) }}"><button type="submit" class="btn btn-primary">
                            Cập nhật</button>
                    </a>

                    {{-- <a href="{{ asset('admin/ctv/reset-mat-khau/' .$id) }}"><button type="submit" >
                            Reset password</button>
                    </a> --}}

                    <a class="btn btn-danger" href="" data-toggle="modal"
                    data-target="#resetPassword">
                    Reset password

                </a>

                </div>

                <div class="container row">
                    <h4 class="text-center">Thông tin CTV</h4>
                    <table class="table table-responsive" boder="none">
                        <tr>
                            <th class="col-md-3 col-6" style="width:20%">Họ tên:</th>
                            <td class="col-md-3 col-6">{{ $user['name'] }}</td>
                            <th class="col-md-3 col-6">Mã CTV</th>
                            <td class="col-md-3 col-6">{{ $user['code_branch']}}-{{ $user['code_ordinal']}}</td>
                        </tr>
                        <tr>
                            <th class="col-md-3 col-6">Số điện thoại:</th>
                            <td class="col-md-3 col-6">{{ $user['phone'] }}</td>
                            <th class="col-md-3 col-6">Email:</th>
                            <td class="col-md-3 col-6">{{ $user['email'] }}</td>
                           
                        </tr>
                        <tr>
                            <th class="col-md-3 col-6">Tên định danh:</th>
                            <td class="col-md-3 col-6">{{ $user['identifier_name'] }}</td>
                            <th class="col-md-3 col-6">Tổng số tiền:</th>
                            <td class="col-md-3 col-6">{{ number_format($user['total_money'])}} Đ</td>
                        </tr>
                        <tr>
                            <th class="col-md-3 col-6">Cổ phần:</th>
                            <td class="col-md-3 col-6">{{ $user['share_number'] }}</td>
                            <th class="col-md-3 col-6">Số tiền thưởng trực tiếp:</th>
                            <td class="col-md-3 col-6">{{ number_format($user['identifier_money'])}} Đ</td>
                        </tr>
                        
                       

                    </table>
                </div>
                <div class="container mt-5">
                    <h4 class="text-center">Thông tin các gói mua</h4>
                    @if(isset($listBuyPacket) && count($listBuyPacket)>0 )
                    <table class="table table-striped table-responsive" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Mã CTV</th>
                                <th scope="col" class="text-center">Tên gói mua</th>
                                <th scope="col">Giá tiền</th>
                                <th scope="col">Nội dung</th>
                                <th scope="col" class="text-center">Nội dung chuyển tiền</th>
                                <th scope="col">Tình trạng</th>
                                <th scope="col">Ngày mua</th>
                                {{-- <th scope="col">Thao tác</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listBuyPacket as $index => $packet)
                                {{-- {{ dd($packet) }} --}}
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{ $index + 1 }}</td>
                                    <td class="text-center" style="vertical-align: middle">{{ $packet['code_ctv'] }}
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">{{ $packet['namePacket'] }}
                                    </td>
                                    <td>{{ number_format($packet['price']) }}</td>
                                    <td class="text-center">{{ $packet['content'] }}</td>
                                    <td class="text-center">{{ $packet['content_payment'] }}</td>
                                    <td class="text-center">
                                        @if ($packet['status'] == 1)
                                            {{ 'Chờ xác nhận' }}

                                        @elseif($packet['status']==2)
                                            {{ 'Đã xác nhận' }}
                                            }
                                        @elseif($packet['status']==3)
                                            {{ 'Hoàn thành' }}

                                        @elseif($packet['status']==4)
                                            {{ 'Đã huỷ' }}

                                        @endif
                                    </td>
                                    <td class="text-center">
                                        {{ date('d-m-Y', strtotime($packet['created_at']) + 7 * 60 * 60) }}
                                    </td>



                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else 
                    <p class="text-center">Chưa có thông tin các gói mua!</p>
                    @endif


                </div>
                <hr>
                <div class="container">
                    <h4 class="text-center">Thông tin CTV cấp dưới</h4>
                    @if(isset($listCtv['data']) && count($listCtv['data']) > 0)
                    <table class="table table-striped table-responsive" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" class="text-center">Mã CTV</th>
                                <th scope="col" class="text-center">Họ tên</th>
                                <th scope="col">Thông tin liên hệ</th>
                                <th scope="col">Tổng số tiền</th>
                                <th scope="col" class="text-center">Tên định danh</th>
                                <th scope="col">Cổ phần</th>
                                <th scope="col">Tiền thưởng</th>
                                {{-- <th scope="col">Thao tác</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($listCtv['data'] as $index => $ctv)
                                {{-- {{ dd($ctv) }} --}}
                                <tr>
                                    <td class="text-center" style="vertical-align: middle">{{ $index + 1 }}</td>
                                    <td class="text-center" style="vertical-align: middle">{{ $ctv['name'] }}</td>
                                    <td class="text-center" style="vertical-align: middle">{{ $ctv['code_branch'] }}
                                        -
                                        {{ $ctv['code_ordinal'] }}</td>
                                    <td style="vertical-align: middle">
                                        <p>{{ $ctv['phone'] }}</p>
                                        <p>{{ $ctv['email'] }}</p>
                                        <p>{{ $ctv['address'] }}</p>
                                    </td>
                                    <td style="vertical-align: middle">{{ number_format($ctv['total_money']) }} Đ
                                    </td>
                                    <td class="text-center" style="vertical-align: middle">
                                        {{ $ctv['identifier_name'] }}</td>
                                    <td class="text-center" style="vertical-align: middle">{{ $ctv['share_number'] }}
                                    </td>
                                    <td style="vertical-align: middle">{{ number_format($ctv['identifier_money']) }}
                                        Đ</td>


                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                    @else 
                    <p class="text-center">Chưa có thông tin CTV cấp dưới!</p>
                    @endif
                    {{-- <ul class="pagination justify-content-end">
                      
                        <li class="page-item"><a class="page-link" href="#">Trước</a></li>
                        @for ($i = 1; $i <= $totalPage; $i++)
                        <li class="page-item @if ($i == $currentPage) {{'active'}} @endif"><a class="page-link" href="{{ asset('/admin/ctv/chi-tiet-cong-tac-vien/'.$id.'/'.$i')}}">{{$i}}</a></li>
                        @endfor
                        <li class="page-item"><a class="page-link" href="#">Sau</a></li>
                    </ul> --}}


                </div>
                <!-- /.container-fluid -->
                  <!-- delete Modal-->
                  <div class="modal fade" id="resetPassword" tabindex="-1" role="dialog"
                  aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn muốn
                                  reset mật khẩu?</h5>
                              <button class="close" type="button" data-dismiss="modal"
                                  aria-label="Close">
                                  <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <p>Mã CTV: {{ $detailCtv['code_branch'] }}-{{ $detailCtv['code_ordinal'] }} </p>
                              <p>Tên CTV: {{$detailCtv['name']}}</p>
                              {{-- <p>Giá mua: {{number_format($ctv['price']) }} Đ</p> --}}
                          </div>
                          <div class="modal-footer">
                              <button class="btn btn-secondary" type="button"
                                  data-dismiss="modal">Huỷ</button>
                                
                              <a class="btn btn-danger"
                                  href="{{ asset('admin/ctv/reset-password/' . $id) }}">Reset</a>
                          </div>
                      </div>
                  </div>
              </div>

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
