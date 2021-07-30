<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class PromotionController extends ControllerBase
{
    public function listPromotion(Request $request)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/promotion/list-promotion', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $listPromotion = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.promotion.listPromotion', compact('listPromotion'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function addPromotion(Request $request)
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
                        'name'     => 'image',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),

                    ];
                }

                $url = $this->urlAPI() . 'admin/promotion/create-promotion';
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
                                'name'     => 'title',
                                'contents' => $request->title,

                            ],
                            [
                                'name'     => 'content',
                                'contents' => $request->post_content,
                            ],
                            [
                                'name'     => 'video',
                                'contents' => $request->video
                            ]


                        ],

                    ],
                );

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listPromotion');
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
    public function viewUpdatePromotion($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/promotion/promotion-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $promotion = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listPromotion');
                }
                // dd($infor);
                return view('admin.includes.website.promotion.updatePromotion', compact('promotion'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function viewDetailPromotion($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/promotion/promotion-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $promotion = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listPromotion');
                }
                return view('admin.includes.website.promotion.detailPromotion', compact('promotion'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function updatePromotion(Request $request, $id)
    {
        try {
            //  dd(1);
            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                $body = [
                    [
                        'name'     => 'title',
                        'contents' => $request->title,

                    ],
                    [
                        'name'     => 'content',
                        'contents' => $request->post_content,
                    ],
                    [
                        'name'     => 'video',
                        'contents' => $request->video
                    ],
                    [
                        'name'     => '_method',
                        'contents' => 'put'
                    ]


                ];
                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org  = $file_name->getClientOriginalName();
                    $image = [
                        'name'     => 'image',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),

                    ];
                    $body = [
                        $image,

                        [
                            'name'     => 'title',
                            'contents' => $request->title,

                        ],
                        [
                            'name'     => 'content',
                            'contents' => $request->post_content,
                        ],
                        [
                            'name'     => 'video',
                            'contents' => $request->video
                        ],
                        [
                            'name'     => '_method',
                            'contents' => 'put'
                        ]


                    ];
                }


                $url = $this->urlAPI() . 'admin/promotion/update-promotion/' . $id;
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
                );


                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listPromotion');
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
    public function deletePromotion($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/promotion/delete-promotion/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listPromotion');
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

    public function titleBanner()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-titlebanner', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $titlebanner = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.banner.listTitlebanner', compact('titlebanner'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function DetailtitleBanner()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-titlebanner', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $banner = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listPromotion');
                }
                return view('admin.includes.website.banner.detail', compact('banner'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function viewUpdateTitlebanner()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-titlebanner', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $banner = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listPromotion');
                }
                return view('admin.includes.website.banner.updatebanner', compact('banner'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function updatetitlebanner($id, Request $request)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                $body = [
                    'title'        => $request->title,
                    'content'      => $request->post_content

                ];
                $input = json_encode($body);

                $url = $this->urlAPI() . 'admin/update-titlebanner/' . $id;
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
                    return redirect()->route('titleBanner');
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
    public function listIntro()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-introduce', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $introduce = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.introduce.listIntroduce', compact('introduce'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function Detailintro()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-introduce', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $introduce = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                return view('admin.includes.website.introduce.detail', compact('introduce'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function viewUpdateIntro()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-introduce', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $introduce = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                return view('admin.includes.website.introduce.updateintroduce', compact('introduce'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
    public function updateIntro(Request $request, $id)
    {
        try {
            //  dd(1);
            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                $body = [

                    [
                        'name'     => 'content',
                        'contents' => $request->post_content,
                    ],
                    [
                        'name'     => '_method',
                        'contents' => 'put'
                    ]


                ];
                if (isset($file_name) && $file_name != null) {
                    $image_path = $file_name->getPathname();
                    $image_mime = $file_name->getmimeType();
                    $image_org  = $file_name->getClientOriginalName();
                    $image = [
                        'name'     => 'image',
                        'filename' => $image_org,
                        'Mime-Type' => $image_mime,
                        'contents' => fopen($image_path, 'r'),

                    ];
                    $body = [
                        $image,


                        [
                            'name'     => 'content',
                            'contents' => $request->post_content,
                        ],

                        [
                            'name'     => '_method',
                            'contents' => 'put'
                        ]


                    ];
                }


                $url = $this->urlAPI() . 'admin/update-introduce/' . $id;
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
                );


                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listIntro');
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
    public function listCus()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/list-contact', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $cus = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.listCus', compact('cus'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }
}
