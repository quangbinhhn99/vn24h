<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;
use Response;
class CTVController extends ControllerBase
{
    public function setCookie($token){
        $minutes = 60;
        $response = new Response('Set Cookie');
        $response->withCookie(cookie('token', $token, $minutes));
        return $response;
     }
     public function getCookie(Request $request){
        $value = $request->cookie('token');
        return $value;
     }
    //  public function checkToken(Request $request)
    // {
    //     $token = $request->cookie('token');
    //     if (isset($token) && $token != null) {
    //         return view('includes.index');
    //     } else {
    //         return view('welcome');
    //     }
    // }
   public function register(Request $request)
   {
        $body = [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'cmt'           => $request->cmt,
            'address'       => $request->address,
            'password'      => $request->password,
            'password_confirmation' => $request->password_confirmation,
            'key'           => $request->key,
        ];
        $input = json_encode($body);
        
        $url = $this->urlAPI() . '/ctv/register-ctv';
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $req = $client->post($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);

        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        else {
            $url = redirect()->route('trang-chu')->getTargetUrl();
            return redirect($url)->withCookie(cookie('token', $response['data']['token'], 1440));
        }
   }
   public function login(Request $request)
   {
        $body = [
            
            'phone' => $request->phone,
            'password' => $request->password,

        ];
        $input = json_encode($body);
        
        $url = $this->urlAPI() . '/ctv/login-ctv';
        $client = new Client([
            'headers' => [
                'Content-Type' => 'application/json'
            ],
        ]);
        $req = $client->post($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);

        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        else {
            alert()->success($response['message']);
            $url = redirect()->route('trang-chu')->getTargetUrl();
            return redirect($url)->withCookie(cookie('token', $response['data']['token'], 1440));
        }
   }
   public function getUserInfo(Request $request)
    {
        $token = $request->cookie('token');
        if(isset($token)&& $token != null){
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $data = $client->get($this->urlAPI() . '/ctv/get-user-infomation', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $response = json_decode($data->getBody()->getContents(), true);
            $infor = $response['data'];
            
            $dashboard = $client->get($this->urlAPI() . "/list-dashboard", [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $responsedashboard = json_decode($dashboard->getBody()->getContents(), true);
            $dashboard = $responsedashboard['data'];

            $databuy = $client->get($this->urlAPI() . "/ctv/packet/list-buy-packet");
            $responsebuy = json_decode($databuy->getBody()->getContents(), true);
            $buy = $responsebuy['data'];

            return view('includes.index', compact('infor','dashboard','buy'));
        }
        else{
            return view('welcome');
        }
        
    }
    public function logout(Request $request)
    {
        $token = $request->cookie('token');
        $client = new Client();
        $data = $client->get($this->urlAPI() . '/admin/logout', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
        ]);
        $response = json_decode($data->getBody()->getContents(), true);
        // dd($response);

        if ($response['status'] == 1) {
            Cookie::queue(Cookie::forget('token'));
            return redirect()->route('dang-nhap');
        }

        return redirect()->route('trang-chu');
    }
    public function updateCTV(Request $request)
    {
        $token = $request->cookie('token');
        $body = [
            'name'          => $request->name,
            'phone'         => $request->phone,
            'cmt'           => $request->cmt,
            'address'       => $request->address,
        ];
        $input = json_encode($body);
        
        $url = $this->urlAPI() . '/ctv/update-ctv';
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ],
        ]);
        $req = $client->put($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);

        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        else {
            alert()->success($response['message']);
            $url = redirect()->route('trang-chu')->getTargetUrl();
            return redirect($url);
        }
    }
    public function PassCTV(Request $request)
    {
        $token = $request->cookie('token');
        $body = [
            'current_password'      => $request->current_password,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];
        $input = json_encode($body);
        
        $url = $this->urlAPI() . '/admin/change-password';
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ],
        ]);
        $req = $client->put($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);

        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        else {
            alert()->success($response['message']);
            $url = redirect()->route('trang-chu')->getTargetUrl();
            return redirect($url);
        }
    }

    public function Packet(Request $request)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/packet/list-packet");
            $response = json_decode($data->getBody()->getContents(), true);
            $packet = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.milk_package', compact('packet','infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function Packetdetail(Request $request,$id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/packet/packet-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $packetdetail = $response['data'];
            
            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];
            
            return view('includes.package_detail', compact('packetdetail','infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function Order(Request $request,$id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/packet/packet-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $packetdetail = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];
            
            return view('includes.order', compact('packetdetail','infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function comfirmOrder(Request $request)
    {
        $token = $request->cookie('token');
        $price = (int)str_replace([',','.',':', '\\', '/', '*'],'',$request->price);
        $body = [
            'name'              => $request->name,
            'phone'             => $request->phone,
            'price'             => $price,
            'packet_id'         => $request->packet_id,
            'content'           => $request->content,
            'address'           => $request->address,
            'code_ctv'          => $request->code_ctv,
            'content_payment'   => $request->content_payment,
        ];
        $input = json_encode($body);
        
        $url = $this->urlAPI() . '/ctv/packet/buy-packet';
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ],
        ]);
        $req = $client->post($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);
        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        else {
            alert()->success($response['message']);
            $url = redirect()->route('goi-mua-sua')->getTargetUrl();
            return redirect($url);
        }
    }
    public function buyPacket(Request $request)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            $status      = '';
            $form_date  = '';
            $to_date    = '';
            if($request->status){
                $status = $request->status;
            }
            if($request->form_date){
                $form_date = date('Y-m-d', strtotime($request->form_date));
            }
            if($request->to_date){
                $to_date = date('Y-m-d', strtotime($request->to_date));
            }
            $data = $client->get($this->urlAPI() . "/ctv/packet/list-buy-packet?status=$status&form_date=$form_date&to_date=$to_date");
            $response = json_decode($data->getBody()->getContents(), true);
            $buy = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.milk.buyPacket', compact('buy','infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function buyPacketDetail(Request $request,$id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/packet/buy-packet-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $buydetail = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.milk.detail-buy-packet', compact('buydetail','infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function deleteBuyPacket(Request $request,$id)
    {
        // try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->delete($this->urlAPI() . "/ctv/packet/cancel-buy-packet/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            if ($response['status'] == 1) {
                alert()->success($response['message']);
            } else {
                alert()->warning($response['message']);
            }
            return back();
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }
    public function CTVrevenue(Request $request)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            $name       = '';
            $phone      = '';
            $from_date  = '';
            $to_date    = '';
            if($request->name){
                $name = $request->name;
            }
            if($request->phone){
                $phone = $request->phone;
            }
            if($request->from_date){
                $from_date = date('Y-m-d', strtotime($request->from_date));
            }
            if($request->to_date){
                $to_date = date('Y-m-d', strtotime($request->to_date));
            }
            $data = $client->get($this->urlAPI() . "/ctv/revenue/list-revenue-ctv?name=$name&phone=$phone&from_date=$from_date&to_date=$to_date");
            $response = json_decode($data->getBody()->getContents(), true);
            $revenue = $response['data'];
            

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.revenue.ctvrevenue', compact('revenue','infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function CTVrevenueDetail(Request $request, $id)
    {
        // try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            $data = $client->get($this->urlAPI() . "/ctv/revenue/revenue-ctv-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $revenueDetail = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.revenue.ctvrevenue-detail', compact('revenueDetail', 'infor'));
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }
    public function CTVcalculator(Request $request)
    {
        // try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);
            $status      = '';
            $name       = '';
            $phone      = '';
            $from_date  = '';
            $to_date    = '';
            if($request->status){
                $status = $request->status;
            }
            if($request->name){
                $name = $request->name;
            }
            if($request->phone){
                $phone = $request->phone;
            }
            if($request->from_date){
                $from_date = date('Y-m-d', strtotime($request->from_date));
            }
            if($request->to_date){
                $to_date = date('Y-m-d', strtotime($request->to_date));
            }

            $data = $client->get($this->urlAPI() . "/ctv/revenue/list-add-revenue?name=$name&phone=$phone&from_date=$from_date&to_date=$to_date&status=$status");
            $response = json_decode($data->getBody()->getContents(), true);
            $calculator = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.addrevenue.list-add-revenue', compact('calculator', 'infor'));
        // } catch (\Throwable $th) {
        //     alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }
    public function CTVcalculatorDetail(Request $request, $id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ],
            ]);

            $data = $client->get($this->urlAPI() . "/ctv/revenue/add-revenue-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $addrevenueDetail = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.addrevenue.detail-add-revenue', compact('addrevenueDetail', 'infor'));
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function updateADD(Request $request,$id)
    {
        try {
            $token = $request->cookie('token');
            $body = [
                'user_id'           => $request->user_id,
                'price'             => preg_replace('/[^0-9\-]/', '', $request->price),
                'content'           => $request->content,
            ];
            $input = json_encode($body);
            $url = $this->urlAPI() . "/ctv/revenue/update-add-revenue/$id";
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
            ]);
            $req = $client->put($url,
                ['body' => $input]
            );
            
            $response = json_decode($req->getBody()->getContents(), true);
            if ($response['status'] == 1) {
                alert()->success($response['message']);
            } else {
                alert()->warning($response['message']);
            }
            return back();
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function deleteADD(Request $request,$id)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
            ]);
            $req = $client->delete($this->urlAPI() . "/ctv/revenue/delete-add-revenue/$id");
            
            $response = json_decode($req->getBody()->getContents(), true);
            if ($response['status'] == 1) {
                alert()->success($response['message']);
            } else {
                alert()->warning($response['message']);
            }
            return back();
        } catch (\Throwable $th) {
            alert()->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function notify(Request $request)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json',
            ],
            ]);
            $body = [
                   'notify_id' =>$request->notify_id, 
                    
                ];
            $input = json_encode($body);
            
            $url = $this->urlAPI()."/notify/confirm-view-notify";
            $req = $client->put($url,
                        ['body' => $input]
                );
            $response = json_decode($req->getBody()->getContents(), true);
            if($response['status'] == 1 && $response['data']['type']==1){
                $url = redirect()->route('chi-tiet-goi-mua',['id'=>$response['data']['object_id']])->getTargetUrl();
                return redirect($url);
            }
            elseif($response['status'] == 1 && $response['data']['type']==2){
                $url = redirect()->route('chi-tiet-cong-doanh-so',['id'=>$response['data']['object_id']])->getTargetUrl();
                return redirect($url);
            }
            elseif($response['status'] == 1 && $response['data']['type']==3){
                $url = redirect()->route('cong-doanh-so')->getTargetUrl();
                return redirect($url);
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
         
    }
    public function notifyy(Request $request, $i)
    {
        try {
            $token = $request->cookie('token');
            $client = new Client([
                'headers' => [
                'Authorization' => 'Bearer '.$token,
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "/notify/list-notify?page=" . $i);
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "/ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('includes.notify', compact('listdata','infor'));
            
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function comfirmDddrevenue(Request $request)
    {
        $token = $request->cookie('token');
        $price = (int)str_replace([',','.',':', '\\', '/', '*'],'',$request->price);
        $body = [
            'user_id'           => $request->user_id,
            'price'             => $price,
            'content'           => $request->content,
        ];
        $input = json_encode($body);
        
        $url = $this->urlAPI() . '/ctv/revenue/add-revenue';
        $client = new Client([
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Content-Type' => 'application/json'
            ],
        ]);
        $req = $client->post($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);
        if ($response['status'] == 0) {
            alert()->warning($response['message']);
            return back();
        }
        else {
            alert()->success($response['message']);
            $url = redirect()->route('ctv-tuyen-duoi')->getTargetUrl();
            return redirect($url);
        }
    }
}
