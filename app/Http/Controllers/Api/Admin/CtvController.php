<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CtvController extends ControllerBase
{
    public function listCTV(Request $request, $i)
    {
        // dd(date('m/01/Y'));
        // dd(date('m/t/Y'));
        try {

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                if (isset($request->from_date)) {
                    $from_date = $request->from_date;
                } else {
                    $from_date = null;
                }

                if (isset($request->to_date)) {
                    $to_date = $request->to_date;
                } else {
                    $to_date = null;
                }

                if (isset($request->code_branch)) {
                    $code_branch = $request->code_branch;
                } else {
                    $code_branch = "";
                }

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/revenue/list-revenue-ctv?from_date=' . $from_date . '&to_date=' . $to_date . '&code_branch=' . $code_branch . '&page=' . $i, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                $data2 = $client->get($this->urlAPI() . 'admin/revenue/list-revenue-tree', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response2 = json_decode($data2->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1 && $response2['status'] == 1) {
                    $listCtv = $response['data']['list']['data'];
                    $listTree = $response2['data'];
                } else {
                    if ($response['code'] == 502 || $response2['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.listCtv', compact('listCtv', 'response', 'listTree', 'from_date', 'to_date', 'code_branch'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }


    public function deleteCtv($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/ctv/delete-ctv/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listCTV', ['i' => 1]);
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function listIdentifier()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/ctv-identifier/list-ctv-identifier', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $listIdentifier = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.listIdentifier', compact('listIdentifier'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addIdentifier(Request $request)
    {
        try {

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                $body = [
                    'name'         => $request->name,
                    'price'        => $request->price,
                    'share_number' => $request->share_number,
                    'money'        => $request->money
                ];
                $input = json_encode($body);

                $url = $this->urlAPI() . 'admin/ctv-identifier/create-ctv-identifier';
                // dd($input);
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->post(
                    $url,
                    ['body' => $input]
                );

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {

                    alert()->success($response['message']);
                    return redirect()->route('listIdentifier');
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
            }
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deleteIdentifier($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/ctv-identifier/delete-ctv-identifier/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listIdentifier');
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewUpdateIdentifier($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/ctv-identifier/ctv-identifier-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $identifier = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.updateIdentifier', compact('identifier'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateIdentifier(Request $request, $id)
    {
        try {

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                $body = [
                    'name'         => $request->name,
                    'price'        => $request->price,
                    'share_number' => $request->share_number,
                    'money'        => $request->money
                ];
                $input = json_encode($body);

                $url = $this->urlAPI() . 'admin/ctv-identifier/update-ctv-identifier/' . $id;
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
                    return redirect()->route('listIdentifier');
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
            }
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewAddCtv()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/ctv/list-ctv', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $listCtv = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.addCtv', compact('listCtv'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addCtv(Request $request)
    {
        try {

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                $body = [
                    'name'         => $request->name,
                    'phone'        => $request->phone,
                    'email' => $request->email,
                    'address'        => $request->address,
                    'cmt' => $request->cmt,
                    'password' => $request->password,
                    'password_confirmation' => $request->repassword,
                    'ctv_id' => $request->ctv_id
                ];
                $input = json_encode($body);

                $url = $this->urlAPI() . 'admin/ctv/create-ctv';

                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
               
                $req = $client->post(
                    $url,
                    ['body' => $input]
                );

                $response = json_decode($req->getBody()->getContents(), true);
                
                if ($response['status'] == 1) {

                    alert()->success($response['message']);
                    return redirect()->route('viewAddCtv');
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }
                    alert()->warning($response['message']);
                    return redirect()->route('viewAddCtv',);
                }
            }
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function infoPacket($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/packet/packet-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $infoPacket = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }
                    alert()->warning($response['message']);
                    return redirect()->route('trang-chu');
                }

                return $infoPacket;
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function detailCtv($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/ctv/ctv-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $ctv = $response['data'];

                    return $ctv;
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function infoCtv($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'ctv/revenue/revenue-ctv-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $listBuyPacket = $response['data']['list_buy_packet'];
                    $listCtv = $response['data']['list_ctv'];
                    $detailCtv = CtvController::detailCtv($id);
                    $user = $response['data']['user'];
                    // dd($listCtv);
                    for ($i = 0; $i < count($listBuyPacket); $i++) {
                        $infoPacket = CtvController::infoPacket($listBuyPacket[$i]['packet_id']);
                        $listBuyPacket[$i]['namePacket'] = $infoPacket['name'];
                    }
                    // dd($listBuyPacket);
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.infoCtv', compact('listCtv', 'listBuyPacket', 'id', 'detailCtv', 'user'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function delete($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/ctv/delete-ctv/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listCTV', ['i' => 1]);
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function resetPassword($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->put($this->urlAPI() . 'admin/ctv/reset-password-ctv/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('infoCtv',  ['id' => $id]);
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }


    public function viewUpdateCtv($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $ctv = CtvController::detailCtv($id);

                $client = new Client();

                // } catch (\Throwable $th) {$client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/ctv/list-ctv', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);

                if ($response['status'] == 1) {
                    $listCtv = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                return view('admin.includes.ctv.updateCtv', compact('ctv', 'listCtv'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateCtv(Request $request, $id)
    {
        try {

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                $body = [
                    'name'   => $request->name,
                    'cmt'    => $request->cmt,
                    'email'  => $request->email,
                    'address' => $request->address,
                    'ctv_id' => $request->ctv_id
                ];

                $input = json_encode($body);

                $url = $this->urlAPI() . 'admin/ctv/update-ctv/' . $id;
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
                    return redirect()->route('infoCtv',  ['id' => $id]);
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
            }
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }


    public function listAddRevenue($i)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {


                $client = new Client();
                $data = $client->get($this->urlAPI() . 'ctv/revenue/list-add-revenue?page=' . $i, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    $listAddRevenue = $response['data']['list_add_revenue']['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.listAddRevenue', compact('listAddRevenue', 'response'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function confirmadd($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {


                $url = $this->urlAPI() . 'ctv/revenue/confirm-add-revenue/' . $id;
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->put(
                    $url,
                );

                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {

                    alert()->success($response['message']);
                    return redirect()->route('listAddRevenue',  ['i' => '1']);
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
            }
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function deleteadd($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {


                $url = $this->urlAPI() . 'ctv/revenue/confirm-delete-add-revenue/' . $id;
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->delete(
                    $url,
                );

                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {

                    alert()->success($response['message']);
                    return redirect()->route('listAddRevenue',  ['i' => '1']);
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
            }
            return redirect()->route('login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function listTree(Request $request)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $from_date  = '';
                $to_date    = '';

                if ($request->from_date) {
                    $from_date = date('Y-m-d', strtotime($request->from_date));
                }
                if ($request->to_date) {
                    $to_date = date('Y-m-d', strtotime($request->to_date));
                }

                $client = new Client();
                $data = $client->get($this->urlAPI() . "admin/revenue/list-revenue-tree?from_date=$from_date&to_date=$to_date", [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);

                if ($response['status'] == 1) {

                    $listTree = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.ctv.listTree', compact('listTree'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
