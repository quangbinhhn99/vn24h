@php
    use GuzzleHttp\Client;
    $client = new Client([
        'headers' => [
        'Content-Type' => 'application/json',
        ],
    ]);

    $dataheadquarter = $client->get(\App\Models\BaseModel::URI_API . 'list-headquarter');
    $responseheadquarter = json_decode($dataheadquarter->getBody()->getContents(), true);

    if ($responseheadquarter['status'] == 1) {
        $listheadquarter = $responseheadquarter['data'];
    } else {
        alert()->warning($responseheadquarter['message']);
    }

@endphp
<div class="footer">
	<div class="container-fluid footer-bg">
		<div class="col-lg-5 col-md-5 col-sm-12">
			<div class="logo"><a href=""><img src="{{asset('img/logo2.jpg')}}" style="width: 30%"></a></div>
			<div class="content">
				<p style="font-size: 14px; font-weight: 700;">
					@if  ( empty($listheadquarter[0]['name']) ) chưa có name
                    @else {{ $listheadquarter[0]['name'] }}
                    @endif
				</p>
				<p style="font-size: 13px; font-weight: 500; color: black;">Địa chỉ: 
					@if  ( empty($listheadquarter[0]['address']) ) chưa có address 
					@else {{ $listheadquarter[0]['address'] }}
					@endif
				</p>
				<p style="font-size: 13px; font-weight: 500; color: black;">Số điện thoại: 
					@if  ( empty($listheadquarter[0]['phone']) ) chưa có phone 
					@else {{ $listheadquarter[0]['phone'] }}
					@endif
				</p>

			</div>
		</div>
		<div class="col-lg-3 col-md-3 col-sm-12">
			<div class="title">
				Về Chúng Tôi 
			</div>
			<div class="content">
				<ul>
					<li><a href="{{asset('san-pham/page=1')}}">Sản phẩm</a></li>
					<li><a href="{{asset('khuyen-mai')}}">Khuyến mại</a></li>
					<li><a href="{{asset('chinh-sach-kinh-doanh')}}">Chính sách kinh doanh</a></li>
					<li><a href="{{asset('su-kien/page=1')}}">Sự kiện</a></li>
				</ul>
			</div>
		</div>
        <div class="col-lg-4 col-md-4 col-sm-12">
			<div class="title">
				Theo dõi chúng tôi 
			</div>
			<div class="content">
				<ul>
					<li>
						<a href="#" target="_blank">
							<img src="{{asset('img/icon-fb.png')}}">
							<b style="color: black;">Facebook</b>
						</a>
					</li>
					
					<li>
						<a href="#" target="_blank">
							<img src="{{asset('img/icon-twitter.png')}}">
							<b style="color: black;">Twitter</b>
						</a>
					</li>

					<li>
						<a href="#" target="_blank">
							<img src="{{asset('img/icon-tiktok.png')}}">
							<b style="color: black;">Tiktok</b>
						</a>
					</li>
				</ul>
			</div>
		</div>	
	</div>
</div>