<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Cookie;

class ProductController extends ControllerBase
{

    public function listAllProduct()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/product/list-all-product', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $listAllProduct = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return $listAllProduct;
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function listProduct($i)
    {
        try {
            // dd($i);

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/product/list-product?page=' . $i, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $listProduct = $response['data']['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.product.listProduct', compact('listProduct', 'response'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function infoProduct($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/product/product-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $product = $response['data'];
                } else {

                    return back();
                }

                return $product;
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewInfoProduct($id)
    {
        try {
            $product = ProductController::infoProduct($id);
            // dd($product);
            // if (isset($product) && $product != null) {
            return view('admin.includes.product.infoProduct', compact('product'));
            // }else {
            //     return back();
            // }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deleteProduct($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/product/delete-product/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listProduct', ['i' => 1]);
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

    public function viewAddProduct(Request $request)
    {
        try {
            $listAllProduct = ProductController::listAllProduct();
            return view('admin.includes.product.addProduct', compact('listAllProduct'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addProduct(Request $request)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org  = $file_name->getClientOriginalName();
                }
                $related_product_id = ($request->related_product_id);
                // dd(($related_product_id));
                $product_id = array();

                if (isset($related_product_id) && $related_product_id != null) {
                    foreach ($related_product_id as $key => $data) {
                        $product_id[$key] = [
                            'name'   => 'related_product_id[]',
                            'contents' => $data,
                        ];
                    }
                }
                $length = count($product_id);
                // dd($length);
                $product_id[$length] = [
                    'name'     => 'name',
                    'contents' => $request->name,
                ];
                $product_id[$length + 1] = [
                    'name'     => 'description',
                    'contents' => $request->description,
                ];
                $product_id[$length + 2] =  [
                    'name'     => 'strategic_vision',
                    'contents' => $request->strategic_vision,
                ];
                $product_id[$length + 3] = [
                    'name'     => 'image',
                    'filename' => $image_org,
                    'Mime-Type' => $image_mime,
                    'contents' => fopen($image_path, 'r'),

                ];
                // dd($product_id);

                $url = $this->urlAPI() . 'admin/product/create-product';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->post(
                    $url,
                    [
                        'multipart' => $product_id


                    ],
                    // ['form_params']
                );

                $response = json_decode($req->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listProduct', ['i' => 1]);
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

    public function viewUpdateProduct($id)
    {
        try {
            $product = ProductController::infoProduct($id);
            $listAllProduct = ProductController::listAllProduct();

            return view('admin.includes.product.updateProduct', compact('product', 'listAllProduct'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateProduct(Request $request, $id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');

                $related_product_id = ($request->related_product_id);
                // dd(($related_product_id));
                $product_id = array();

                if (isset($related_product_id) && $related_product_id != null) {
                    foreach ($related_product_id as $key => $data) {

                        $product_id[$key] = [
                            'name'   => 'related_product_id[]',
                            'contents' => $data,
                        ];
                    }
                } else {
                    $product_id[0] = [
                        'name'   => 'related_product_id[]',
                        'contents' => '',
                    ];
                }

                $length = count($product_id);
                // dd($length);
                $product_id[$length] = [
                    'name'     => 'name',
                    'contents' => $request->name,
                ];
                $product_id[$length + 1] = [
                    'name'     => 'description',
                    'contents' => $request->description,
                ];
                $product_id[$length + 2] =  [
                    'name'     => 'strategic_vision',
                    'contents' => $request->strategic_vision,
                ];
                $product_id[$length + 3] = [
                    'name'  => '_method',
                    'contents' => 'put'
                ];

                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org  = $file_name->getClientOriginalName();
                    $product_id[$length + 4] = [
                        'name'     => 'image',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),

                    ];
                }

                // dd($product_id);

                $url = $this->urlAPI() . 'admin/product/update-product/' . $id;
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->post(
                    $url,
                    [
                        'multipart' => $product_id


                    ],
                    // ['form_params']
                );

                $response = json_decode($req->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('chi-tiet-san-pham', ['id' => $id]);
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

    // ============= Danh sách cảm nhận sản phẩm ============

    public function productFeel($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                $product = ProductController::infoProduct($id);

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/product/list-product-feel/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $productFeel = $response['data'];
                } else {

                    return back();
                }

                return view('admin.includes.product.productFeel', compact('product', 'productFeel'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deleteProductFeel($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/product/delete-product-feel/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    $url = redirect()->route('productFeel',  ['id' => $id])->getTargetUrl();
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

    public function viewUpdateProductFeel($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                $product = ProductController::infoProduct($id);

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/product/product-feel-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $productFeel = $response['data'];
                } else {

                    return back();
                }

                return view('admin.includes.product.updateProductFeel', compact('product', 'productFeel'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateProductFeel(Request $request, $id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                $body = [

                    [
                        'name'     => 'name',
                        'contents' => $request->name,

                    ],
                    [
                        'name'     => 'content',
                        'contents' => $request->post_content,

                    ],
                    [
                        'name'     => 'video',
                        'contents' => $request->video,
                    ],
                    [
                        'name'     => 'product_id',
                        'contents' => $id,
                    ],
                    [
                        'name'     => '_method',
                        'contents' => 'put',
                    ],


                ];
                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org  = $file_name->getClientOriginalName();
                    $image = [
                        'name'     => 'avatar',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),

                    ];
                    $body = [
                        $image,
                        [
                            'name'     => 'name',
                            'contents' => $request->name,

                        ],
                        [
                            'name'     => 'content',
                            'contents' => $request->post_content,

                        ],
                        [
                            'name'     => 'video',
                            'contents' => $request->video,
                        ],
                        [
                            'name'     => 'product_id',
                            'contents' => $id,
                        ],
                        [
                            'name'     => '_method',
                            'contents' => 'put',
                        ],

                    ];
                }


                $url = $this->urlAPI() . 'admin/product/update-product-feel/' . $id;
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->post(
                    $url,
                    [
                        'multipart' => $body

                    ],
                    // ['form_params']
                );

                $response = json_decode($req->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('productFeel', ['id' => $id]);
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
    // =============================================



    //  ========== Danh sách mua gói hàng ===============
    public function listBuyPacket($i)
    {
        try {
            // dd($i);

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/packet/list-buy-packet?page=' . $i, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $listBuyPacket = $response['data']['list_buy_packet']['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }

                return view('admin.includes.buy_packet.listBuyPacket', compact('listBuyPacket', 'response'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function infoBuyPacket($id)
    {
        try {
            // dd($id);

            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/packet/buy-packet-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    $ctv = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($ctv);
                return view('admin.includes.buy_packet.infoBuyPacket', compact('ctv', 'response'));
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function changeStatus(Request $request, $id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            $status = $request->status;
            // dd($status);
            if ($status == 2) {
                $url = $this->urlAPI() . "admin/packet/confirm-buy-packet/" . $id;
            } else if ($status == 3) {
                $url = $this->urlAPI() . "admin/packet/finish-buy-packet/" . $id;
            } else if ($status == 4) {
                $url = $this->urlAPI() . "admin/packet/cancel-buy-packet/" . $id;
            }

            $client = new Client([
                'headers' => [
                    'Authorization' => 'Bearer ' . $token,
                    'Accept' => 'application/json',
                ],
            ]);
            $req = $client->put($url);
            $response = json_decode($req->getBody()->getContents(), true);
            // dd($response);
            if ($response['status'] == 1) {
                alert()->success($response['message']);
                return back();
            } else {
                alert()->warning($response['message']);
                return back();
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deleteBuyPacket($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/packet/delete-buy-packet/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listBuyPacket',  ['i' => 1]);
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

    public function viewAddProductFeel($id)
    {
        return view('admin.includes.product.addProductFeel', compact('id'));
    }

    public function addProductFeel(Request $request, $id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org  = $file_name->getClientOriginalName();
                    $image = [
                        'name'     => 'avatar',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),

                    ];
                }


                $url = $this->urlAPI() . 'admin/product/create-product-feel';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                $req = $client->post(
                    $url,
                    [
                        'multipart' => [
                            $image,
                            [
                                'name'     => 'name',
                                'contents' => $request->name,

                            ],
                            [
                                'name'     => 'content',
                                'contents' => $request->post_content,

                            ],
                            [
                                'name'     => 'video',
                                'contents' => $request->video,
                            ],
                            [
                                'name'     => 'product_id',
                                'contents' => $id,
                            ],

                        ],

                    ],
                    // ['form_params']
                );

                $response = json_decode($req->getBody()->getContents(), true);

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('productFeel', ['id' => $id]);
                } else {
                    alert()->warning($response['message']);
                    return back();
                }

                return redirect()->back();
            }

            return view('admin.includes.login');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
