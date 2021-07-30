<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class AdminController extends ControllerBase
{
    public function backPage()
    {
        return redirect()->back();
    }

    public function checkToken()
    {
        try {
            //code...

            $token = Cookie::get('tokenvn24h');
            // dd($token);
            if (isset($token) && $token != null) {
                $dashboard = AdminController::dashboard();
                return view('admin.index', compact('dashboard'));
            } else {
                return view('admin.includes.login');
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function removeToken()
    {
        try {
            Cookie::queue(Cookie::forget('tokenvn24h'));
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function checkLogin(Request $request)
    {
        try {
            $body = [
                'phone' => $request->phone,
                'password' => $request->password,
                'device_id' => $request->device_id,
            ];
            $input = json_encode($body);
            $url = $this->urlAPI() . 'admin/login-admin';
            $client = new Client([
                'headers' => ['Content-Type' => 'application/json'],
            ]);
            $req = $client->post(
                $url,
                ['body' => $input]
            );

            $response = json_decode($req->getBody()->getContents(), true);
            if ($response['status'] == 1) {
                Cookie::queue("tokenvn24h", $response['data']['token'], 1440);
                Cookie::queue("name", $response['data']['user']['name'], 1440);
                alert()->success($response['message']);
                return redirect()->route('trang-chu');
            } else {
                alert()->error($response['message'], '');
                return back();
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function logOut(Response $response)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            $client = new Client();
            $data = $client->get($this->urlAPI() . 'admin/logout', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $response = json_decode($data->getBody()->getContents(), true);
            if ($response['status'] == 1) {
                Cookie::queue(Cookie::forget('tokenvn24h'));
                return redirect()->route('login');
            }

            return redirect()->route('trang-chu');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function getInfoAdmin()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/get-user-infomation', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $infor = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return $infor;
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewInfo()
    {
        try {
            $infor = AdminController::getInfoAdmin();
            return view('admin.includes.infoAdmin', compact('infor'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }


    public function viewUpdateInfo()
    {
        try {
            $infor = AdminController::getInfoAdmin();
            return view('admin.includes.updateInfo', compact('infor'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateInfo(Request $request)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            $body = [
                'name'    => $request->name,
                'phone'   => $request->phone,
                'email'   => $request->email,
                'cmt'     => $request->cmt,
                'address' => $request->address,
            ];
            $input = json_encode($body);

            $url = $this->urlAPI() . 'ctv/update-ctv';
            // dd($input);
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
            ]);
            $req = $client->put(
                $url,
                ['body' => $input]
            );

            $response = json_decode($req->getBody()->getContents(), true);
            //   dd($response);
            if ($response['status'] == 1) {

                alert()->success($response['message']);
                return redirect()->route('getInfoAdmin');
            } else {
                if ($response['code'] == 502) {
                    alert()->warning($response['message']);
                    AdminController::removeToken();
                }

                return redirect()->route('trang-chu');
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updatePassword(Request $request)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            $body = [
                'current_password'        => $request->current_password,
                'password'                => $request->password,
                'password_confirmation'   => $request->password_confirmation,


            ];
            $input = json_encode($body);

            $url = $this->urlAPI() . 'admin/change-password';
            // dd($input);
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
            ]);
            $req = $client->put(
                $url,
                ['body' => $input]
            );

            $response = json_decode($req->getBody()->getContents(), true);
            if ($response['status'] == 1) {

                alert()->success($response['message']);
                return redirect()->route('trang-chu');
            } else {
                if ($response['code'] == 502) {
                    alert()->warning($response['message']);
                    AdminController::removeToken();
                }

                return redirect()->route('trang-chu');
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function notify(Request $request)
    {
        try {
            $token = $request->cookie('tokenvn24h');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
            ]);
            $body = [
                'notify_id' => $request->notify_id,

            ];
            $input = json_encode($body);

            $url = $this->urlAPI() . "notify/confirm-view-notify";
            $req = $client->put(
                $url,
                ['body' => $input]
            );
            $response = json_decode($req->getBody()->getContents(), true);
            if ($response['status'] == 1 && $response['data']['type'] == 1) {
                $url = redirect()->route('infoBuyPacket', ['id' => $response['data']['object_id']])->getTargetUrl();
                return redirect($url);
            } elseif ($response['status'] == 1 && $response['data']['type'] == 2) {
                $url = redirect()->route('listAddRevenue', ['i' => $response['data']['object_id']])->getTargetUrl();
                return redirect($url);
            } elseif ($response['status'] == 1 && $response['data']['type'] == 3) {
                $url = redirect()->route('listTree')->getTargetUrl();
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
            $token = $request->cookie('tokenvn24h');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json',
                ],
            ]);

            $data = $client->get($this->urlAPI() . "notify/list-notify?page=" . $i);
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];

            $datainfor = $client->get($this->urlAPI() . "ctv/get-user-infomation");
            $responseinfor = json_decode($datainfor->getBody()->getContents(), true);
            $infor = $responseinfor['data'];

            return view('admin.includes.notify', compact('listdata', 'infor'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function dashboard()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'list-dashboard', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $dashboard = $response['data']['admin'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('login');
                }
                // dd($infor);
                return $dashboard;
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
