@php
$totalPage = $response['data']['list_add_revenue']['last_page'];
$currentPage = $response['data']['list_add_revenue']['current_page'];

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
                        <h2 class="text-left col-md-10 col-12">Danh sách cộng doanh số: </h2>
                        {{-- <a class="col-md-2 col-12" href="{{ asset('admin/ctv/them-moi-cong-tac-vien') }}">
                            <button class="btn btn-primary btn-sm" style="">Thêm mới CTV + </button>
                        </a> --}}

                    </div>
              
                    <table class="table table-striped" style="width: 100%">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" >Mã CTV</th>
                                <th scope="col">Tên CTV</th>
                                <th scope="col">Cộng doanh thu</th>                            
                                <th scope="col">Nội dung</th>
                                <th scope="col">CTV cấp trên</th>
                                <th scope="col">Trạng thái</th>
                                <th scope="col">Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- {{dd($listAddRevenue)}} --}}
                            @foreach ($listAddRevenue as $index => $addRevenue)
                            @php 
                                $user = $addRevenue['user'];
                                $user_create = $addRevenue['user_create'];
                                if ($addRevenue['status'] == 0) {
                                                    $status = 'Chờ xác nhận';
                                                }
                                                if ($addRevenue['status'] == 1) {
                                                    $status = 'Đã xác nhận';
                                                }
                                                if ($addRevenue['status'] == 2) {
                                                    $status = 'Chờ xác nhận cập nhật';
                                                }
                                                if ($addRevenue['status'] == 3) {
                                                    $status = 'Chờ xác nhận xóa';
                                                }
                            @endphp
                                <tr>
                                    <th scope="row" style="vertical-align: middle ">{{ $index + 1 }}</th>
                                    <td class="products" style="vertical-align: middle ">
                                        {{ $user['code_branch'] }}-{{ $user['code_ordinal'] }}</td>
                                    <td style="vertical-align: middle "> {{ $addRevenue['user']['name'] }}</td>
                                    <td style="vertical-align: middle ">{{ number_format($addRevenue['price']) }}Đ
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ ($addRevenue['content']) }} 
                                    </td>
                                    <td style="vertical-align: middle ">
                                       <p> {{ $user_create['code_branch'] }}-{{ $user_create['code_ordinal']}}</p>
                                       <p>{{ $user_create['name']}}</p>
                                    </td>
                                    <td class="" style="vertical-align: middle; ">
                                        {{ $status }} 
                                    </td>
                                    
                                    <td style="vertical-align: middle ">
                                        @if($addRevenue['status']==0 || $addRevenue['status']==2)
                                            <a class="btn btn-success  btn-sm" data-toggle="modal"
                                            data-target="#confirm{{ $addRevenue['id'] }}">Xác nhận
                                            </a>
                                        @endif
                                        <a class="btn btn-danger btn-circle btn-sm"  data-toggle="modal"
                                            data-target="#delete{{ $addRevenue['id'] }}">
                                            <i class="fas fa-trash"></i>

                                        </a>
                                    </td>

                                     <div class="modal fade" id="confirm{{ $addRevenue['id'] }}" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalLabel" aria-hidden="true">
                                     <div class="modal-dialog" role="document">
                                         <div class="modal-content">
                                             <div class="modal-header">
                                                 <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn muốn
                                                     xác nhận?</h5>
                                                 <button class="close" type="button" data-dismiss="modal"
                                                     aria-label="Close">
                                                     <span aria-hidden="true">×</span>
                                                 </button>
                                             </div>
                                             <div class="modal-body">
                                                 <p>Mã CTV: {{ $user['code_branch'] }}-{{ $user['code_ordinal'] }} </p>
                                                 <p>Tên CTV: {{$addRevenue['user']['name']}}</p>
                                                 <p>Cộng doanh số: {{ number_format($addRevenue['price']) }}</p>
                                                 <p>Nội dung: {{ $addRevenue['content']}}</p>
                                             </div>
                                             <div class="modal-footer">
                                                 <form action="{{route('confirmadd',$addRevenue['id'])}}" method="post">
                                                    @csrf
                                                 <button class="btn btn-secondary" type="button"
                                                     data-dismiss="modal">Huỷ</button>
                                                 <button type="submit"><a class="btn btn-info" >Xác nhận</a></button>
                                                </form>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                                 

                                    <!-- delete Modal-->
                                    <div class="modal fade" id="delete{{ $addRevenue['id'] }}" tabindex="-1" role="dialog"
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
                                                <?php $id = $addRevenue['id']?>
                                                <div class="modal-body">
                                                    <p>Mã CTV: {{ $user['code_branch'] }}-{{ $user['code_ordinal'] }} </p>
                                                    <p>Tên CTV: {{$addRevenue['user']['name']}}</p>
                                                    <p>Doanh số: {{ number_format($addRevenue['price']) }}</p>
                                                    <p>Nội dung: {{ $addRevenue['content']}}</p>
                                                    {{-- <p>Giá mua: {{number_format($ctv['price']) }} Đ</p> --}}
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{route('deleteadd',$id)}}" method="get">
                                                        @csrf
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                        
                                                        <button type="submit"><a class="btn btn-danger" 
                                                      >Xoá</a></button>
                                                    </form>
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
