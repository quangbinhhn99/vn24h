<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use Illuminate\Http\Response;

class ProductsController extends ControllerBase
{
    public function list_products($i){
        // try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "list-product?page=" . $i);
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.product.danhSachSanPham', compact('listdata'));
            
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function products_detail($id){
        try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "product-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.product.sanPham', compact('listdata'));
            
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function list_products_index(){
        // try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "list-product");
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            
            $datapolicy = $client->get($this->urlAPI() . "list-policy");
            $responsepolicy = json_decode($datapolicy->getBody()->getContents(), true);
            $listpolicy = $responsepolicy['data'];

            $dataevent = $client->get($this->urlAPI() . "list-event?page=1");
            $responseevent = json_decode($dataevent->getBody()->getContents(), true);
            $listevent = $responseevent['data'];

            $dataintroduce = $client->get($this->urlAPI() . 'list-introduce');
            $responseintroduce = json_decode($dataintroduce->getBody()->getContents(), true);
            $listintroduce = $responseintroduce['data'];

            $dataheadquarter = $client->get($this->urlAPI() . 'list-headquarter');
            $responseheadquarter = json_decode($dataheadquarter->getBody()->getContents(), true);
            $listheadquarter = $responseheadquarter['data'];

            return view('index', compact('listdata','listpolicy','listevent','listintroduce','listheadquarter'));
            
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function list_policy(){
        // try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "list-policy");
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.policy', compact('listdata'));
            
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function list_event($i){
        // try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "list-event?page=" . $i);
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.event.event', compact('listdata'));
            
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function event_detail($id){
        // try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "detail-event/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.event.event-detail', compact('listdata'));
            
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function CSKH(Request $request)
    {
        $body = [
            'phone' => $request->phone,
            'email' => $request->email,
        ];
        $input = json_encode($body);
        $url = $this->urlAPI() . 'create-contact';
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json'],
        ]);
        $req = $client->post($url,
            ['body' => $input]
        );
        $response = json_decode($req->getBody()->getContents(), true);
        if ($response['status'] == 1) {
            alert()->success($response['message']);
            return back();
        } else {
            alert()->error($response['message']);
            return back();
        }
    }

    public function list_promotion(){
        // try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
           
            $data = $client->get($this->urlAPI() . "list-promotion");
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.promotion.promotion', compact('listdata'));
            
        // } catch (\Throwable $th) {
        //     alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
        //     return back();
        // }
    }

    public function promotion_detail($id){
        try {
            $client = new Client([
                'headers' => [
                'Content-Type' => 'application/json',
            ],
            ]);
            $data = $client->get($this->urlAPI() . "promotion-detail/$id");
            $response = json_decode($data->getBody()->getContents(), true);
            $listdata = $response['data'];
            return view('includes.promotion.promotion-details', compact('listdata'));
            
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

}
