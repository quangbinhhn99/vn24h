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
                    <h2>Thông tin sản phẩm:</h2>
                    <table class="table table-responsive" boder="none">
                        <tr>
                            <th class="text-center" style="width:20%">Tên sản phẩm: </th>
                            <td class="">{{ $product['name']}}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Ảnh: </th>
                            <td class="products"><img src="{{ $product['image'] }}" alt="" style="margin:0px"></td>
                        </tr>
                        <tr>
                            <th class="text-center">Mô tả: </th>
                            <td>{!! $product['description'] !!}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Tầm nhìn chiến lược: </th>
                            <td>{!! $product['strategic_vision'] !!}</td>
                        </tr>
                        <tr>
                            <th class="text-center">Cảm nhận sản phẩm: </th>
                      
                            <td>
                                <div class="form-row">
                                  
                                    @foreach($product['product_feel'] as $key=>$feel)
                                    @if($key<3)
                                    <div class="col-md-1" >
                                        <img src="{{ $feel['avatar'] }}" alt="" style="max-width: 50px; ">
                                    </div>
                                    <div class="col-md-11">
                                            <p><b>{{$feel['name']}}</b></p>
                                            <p style="margin-top:-20px">{{ $feel['content']}}</p>
                                    </div>
                                    @endif
                                    @endforeach
                                   
                                    <a href="{{asset('admin/san-pham/cam-nhan-san-pham/'.$product['id'])}}">Xem thêm...</a>
                                  
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th class="text-center">Sản phẩm liên quan</th>
                            <td>@if($product['related_product'] != null) 
                                <table>
                                    @foreach ($product['related_product'] as $key=>$item)
                                   
                                    <tr class="products">
                                        <td><span>{{ $item['product']['name']}}</span></td>
                                        <td><img src="{{$item['product']['image']}}" alt=""></td>
                                    </tr>
                                    
                                    @endforeach
                                </table>
                                 @endif
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
                            <a href="{{route('viewUpdateProduct', ['id'=> $product['id']])}}">
                
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