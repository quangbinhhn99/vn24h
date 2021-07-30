<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class PacketMilkController extends ControllerBase
{
    public function listPacket()
    {
        try {
            //code...

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/packet/list-packet', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $listPacket = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.packet_milk.list_packet', compact('listPacket'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    public function detailPacket($id)
    {
        // try {

        $token = Cookie::get('tokenvn24h');

        if (isset($token) && $token != null) {
            # code...

            $client = new Client();
            $data = $client->get($this->urlAPI() . 'admin/packet/packet-detail/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $response = json_decode($data->getBody()->getContents(), true);
          
            if ($response['status'] == 1) {
                $detailpacket = $response['data'];
            } else {

                return back();
            }

            return view('admin.includes.packet_milk.packet-detail', compact('detailpacket'));
        }

        return view('admin.includes.login');
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }
    public function updatePacket($id)
    {
        // try {

        $token = Cookie::get('tokenvn24h');
        if (isset($token) && $token != null) {
            # code...

            $client = new Client();
            $data = $client->get($this->urlAPI() . 'admin/packet/packet-detail/' . $id, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $response = json_decode($data->getBody()->getContents(), true);
          
            if ($response['status'] == 1) {
                $detailpacket = $response['data'];
            } else {

                return back();
            }

            return view('admin.includes.packet_milk.updatePacket', compact('detailpacket'));
        }

        return view('admin.includes.login');
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }
    }
    
    public function deleteSP(Request $request,$id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Content-Type' => 'application/json'
                ],
            ]);
            $req = $client->delete($this->urlAPI() . "admin/packet/delete-packet/$id");
            
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
}
