<?php
use GuzzleHttp\Client;
$token = Cookie::get('tokenvn24h');
if (isset($token) && $token != null) {
    $client = new Client([
        'headers' => [
        'Authorization' => 'Bearer ' . $token,
        'Content-Type' => 'application/json',
        ],
    ]);
    $data = $client->get(\App\Models\BaseModel::URI_API . 'notify/list-notify');
    $response = json_decode($data->getBody()->getContents(), true);
    if($response['status']==1){
        $noti = $response['data'];
        $noty = $noti['count_notify'];
        
    }
    else{
        $noti = '';
        $noty = '';
    }

}
else{
        $noti = '';
        $noty = '';
    }

?>
<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="fa fa-bars"></i>
    </button>

   

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown no-arrow mx-1">
            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell fa-fw"></i>
                <!-- Counter - Alerts -->
                <span class="badge badge-danger badge-counter">{{$noty}}</span>
            </a>
            <!-- Dropdown - Alerts -->
            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="alertsDropdown" >
                <div style="height: 500px; width: 105%;
                overflow-x: auto;">
                <h6 class="dropdown-header">
                    Thông báo!
                </h6>
                @if(isset($noti) && $noti !=null)
                @foreach ($noti['list_notify']['data'] as $item)
                @php
                    if ($item['is_view'] == 1) {
                        $class = '';
                    } else {
                        $class = 'font-weight-bold';
                     }
                @endphp
                <form action="{{ route('notify') }}" method="post">
                    @csrf
                    <button class="dropdown-item d-flex align-items-center" type="submit">
                        <input type="hidden" value="{{ $item['id'] }}" name="notify_id" id="{{ $item['id'] }}">
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{$item['created_at']}}</div>
                            <span class="{{$class}}">{!!$item['content']!!}</span>
                        </div>
                    </button>
                </form>
                @endforeach
                @endif
                
                <a class="dropdown-item text-center small text-gray-500" href="{{asset('admin/thong-bao/page=1')}}">Xem thêm</a>
            </div>
        </div>
        </li>

     

        <div class="topbar-divider d-none d-sm-block"></div>

        <!-- Nav Item - User Information -->
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">@php $name = Cookie::get('name'); echo $name;@endphp</span>
                <img class="img-profile rounded-circle"
                    src="{{ asset('img/undraw_profile.svg') }} ">
            </a>
            <!-- Dropdown - User Information -->
            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ asset('admin/thong-tin-tai-khoan')}}">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Thông tin tài khoản
                </a>
                <a class="dropdown-item" href="{{route('viewUpdatePassword')}}">
                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                    Thay đổi mật khẩu
                </a>
               
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{route('logOut')}}" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Đăng xuất
                </a>
            </div>
        </li>

    </ul>

</nav>


    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Bạn có chắc chắn muốn đăng xuất?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="{{route('logOut')}}">Đăng xuất</a>
                </div>
            </div>
        </div>
    </div>
