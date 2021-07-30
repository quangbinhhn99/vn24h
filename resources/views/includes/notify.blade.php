<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Trang chủ</title>


    @include('layout/libcss')

</head>
<body id="page-top">

    <div id="wrapper">
        @include('layout/menu')
        <div id="content-wrapper" class="d-flex flex-column">

            <div id="content">
               
                @include('layout/header')

                <div class="container">
                   
                <h6 class="dropdown-header">
                    Thông báo!
                </h6>
                @foreach ($listdata['list_notify']['data'] as $item)
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
                <br>
                @endforeach
                
            </div>

                    @php
                    if (isset($listdata)) {
                        $page = $listdata['list_notify']['current_page'];
                    } else {
                        $page = $listdata['list_notify']['current_page'];
                    }
                @endphp
        
                
        </div>
        <ul class="pagination mt-4 mr-3" >
        
            @if ($page > 1)
                <li class="page-item mr-2"><a style="color: #4e73df" class="page-link"
                        href="{{ asset('thong-bao/page=' . ($page - 1)) }}">
                        <i class="fas fa-angle-left"></i></a>
                </li>
            @endif
            @for ($i = $page - 1; $i <= $page + 1; $i++)

                @if ($i > 0 && $i <= $listdata['list_notify']['last_page']) <li class="page-item mr-2"><a href="{{ asset('thong-bao/page=' . $i) }}"
                                            class="page-link         @if ($page==$i)
                {{ 'pagActive' }} @else {{ 'pagNoActive' }} @endif"
                    href="#">{{ $i }}</a></li>
            @endif

            @endfor
            @if ($page < $listdata['list_notify']['last_page'])
                <li class="page-item mr-2"><a style="color: #4e73df" class="page-link"
                        href="{{ asset('thong-bao/page=' . ($page + 1)) }}">
                        <i class="fas fa-angle-right"></i></a>
                </li>
            @endif

        </ul>
      
    @include('layout/footer')

    </div>



    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @include('layout/libjs')

</body>

</html>
