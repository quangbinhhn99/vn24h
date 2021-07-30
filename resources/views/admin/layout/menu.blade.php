 <!-- Sidebar -->
 <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('login')}}">
       
        <div class="sidebar-brand-text mx-2"><img src="{{ asset('img/logo2.jpg') }}" alt="" width="100vw"> <sup></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">
  
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link" href="{{ asset('admin/san-pham/danh-sach/1')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Sản phẩm</span></a>
            
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Gói sữa</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{route('danh-sach-goi-sua')}}">Danh sách gói sữa</a>
                <a class="collapse-item" href="{{route('them-goi-sua')}}">Thêm mới gói sữa</a>
                <a class="collapse-item" href="{{asset('admin/mua-goi/danh-sach/1')}}">Danh sách mua gói</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
            aria-expanded="true" aria-controls="collapseThree">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cộng tác viên</span>
        </a>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{asset('admin/ctv/danh-sach/1')}}">Danh sách doanh số</a>
                <a class="collapse-item" href="{{asset('admin/ctv/danh-sach-cong-doanh-thu/1')}}">Danh sách cộng doanh số</a>
                <a class="collapse-item" href="{{asset('admin/ctv/danh-sach-dinh-danh')}}">Danh sách định danh</a>
                <a class="collapse-item" href="{{asset('admin/ctv/danh-sach-cay-he-thong')}}">Danh sách cây hệ thống</a>

                {{-- <a class="collapse-item" href="{{route('them-goi-sua')}}">Thêm mới gói sữa</a>
                <a class="collapse-item" href="{{asset('admin/mua-goi/danh-sach/1')}}">Danh sách mua gói</a> --}}
            </div>
        </div>
    </li>
   
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFour"
            aria-expanded="true" aria-controls="collapseFour">
            <i class="fas fa-fw fa-folder"></i>
            <span>Website giới thiệu</span>
        </a>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{asset('admin/website/chinh-sach-kinh-doanh')}}">Chính sách kinh doanh</a>
                <a class="collapse-item" href="{{asset('admin/website/su-kien/1')}}">Sự kiện</a>
                <a class="collapse-item" href="{{asset('admin/website/khuyen-mai')}}">Khuyến mãi</a>
                <a class="collapse-item" href="{{asset('admin/website/van-phong-tru-so')}}">Văn phòng trụ sở</a>
                {{-- <a class="collapse-item" href="{{asset('admin/ctv/danh-sach-dinh-danh')}}">Chăm sóc khách hàng</a> --}}
                <a class="collapse-item" href="{{asset('admin/website/danh-sach-banner')}}">Banner</a>
                <a class="collapse-item" href="{{asset('admin/website/tieu-de-banner')}}">Tiêu đề Banner</a>
                <a class="collapse-item" href="{{asset('admin/website/gioi-thieu')}}">Giới thiệu</a>
                <a class="collapse-item" href="{{asset('admin/website/cham-soc-khach-hang')}}">Chăm sóc khách hàng</a>


                {{-- <a class="collapse-item" href="{{route('them-goi-sua')}}">Thêm mới gói sữa</a>
                <a class="collapse-item" href="{{asset('admin/mua-goi/danh-sach/1')}}">Danh sách mua gói</a> --}}
            </div>
        </div>
    </li>


  


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    <!-- Sidebar Message -->
    
</ul>
<!-- End of Sidebar -->