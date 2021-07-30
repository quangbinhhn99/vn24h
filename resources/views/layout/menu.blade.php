<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{asset('trang-chu')}}">
        <div class="">
            <img src="{{asset('img/logo.jpg')}}" alt="" height="70px" class="logo_cms">
        </div>
        <div class="sidebar-brand-text mx-3"></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">



    <!-- Divider -->
    <hr class="sidebar-divider">
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wallet"></i>
            <span>Gói Sữa</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{asset('goi-sua')}}">Danh sách gói sữa</a>
                <a class="collapse-item" href="{{asset('goi-mua-sua')}}">Danh sách mua gói sữa</a>  
            </div>
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-chart-bar"></i>
            <span>Doanh số cây hệ thống</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{asset('ctv-tuyen-duoi')}}">Mua hàng CTV tuyến dưới</a>
                <a class="collapse-item" href="{{asset('cong-doanh-so')}}">Danh sách cộng doanh số</a>
            </div>
        </div>
    </li>

    

    <!-- Divider -->
    <hr class="sidebar-divider">

    



    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>