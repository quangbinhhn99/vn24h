<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ControllerBase;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class WebsiteController extends ControllerBase
{

    public function listPolicy()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/policy/list-policy', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $listPolicy = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.listPolicy', compact('listPolicy'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deletePolicy($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/policy/delete-policy/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listPolicy');
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

    public function addPolicy(Request $request)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                $icon      = $request->file('icon');
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

                if (isset($icon) && $icon != null) {
                    $icon_path = $icon->getPathname();
                    $icon_mime = $icon->getmimeType();
                    $icon_org  = $icon->getClientOriginalName();
                    $icon = [
                        'name'     => 'icon',
                        'filename' => $icon_org,
                        'Mime-Type' => $icon_mime,
                        'contents' => fopen($icon_path, 'r'),

                    ];
                }
                // dd($request->post_content);
                // $body = [
                //     $image,
                //     $icon,
                //     [
                //         'name'     => 'title',
                //         'contents' => $request->title,

                //     ],
                //     [
                //         'name'     => 'content',
                //         'contents' => $request->post_content,
                //     ],

                // ];
                // dd($body);
                $url = $this->urlAPI() . 'admin/policy/create-policy';
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
                            $icon,
                            [
                                'name'     => 'title',
                                'contents' => $request->title,

                            ],
                            [
                                'name'     => 'content',
                                'contents' => $request->post_content,
                            ],

                        ],

                    ],
                );

                $response = json_decode($req->getBody()->getContents(), true);

                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listPolicy');
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

    public function viewUpdatePolicy($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/policy/policy-detail/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $policy = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listPolicy');
                }
                // dd($infor);
                return view('admin.includes.website.updatePolicy', compact('policy'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updatePolicy(Request $request, $id)
    {
        try {
            //  dd(1);
            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {

                $file_name = $request->file('image');
                $icon      = $request->file('icon');
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
                            'name'     => '_method',
                            'contents' => 'put'
                        ]
                    ];
                }

                if (isset($icon) && $icon != null) {
                    $icon_path = $icon->getPathname();
                    $icon_mime = $icon->getmimeType();
                    $icon_org  = $icon->getClientOriginalName();
                    $icon = [
                        'name'     => 'icon',
                        'filename' => $icon_org,
                        'Mime-Type' => $icon_mime,
                        'contents' => fopen($icon_path, 'r'),

                    ];
                    $body = [
                        $icon,
                        [
                            'name'     => 'title',
                            'contents' => $request->title,
                        ],
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

                if ($icon != null && $file_name != null) {
                    $body = [
                        $image,
                        $icon,
                        [
                            'name'     => 'title',
                            'contents' => $request->title,
                        ],
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



                $url = $this->urlAPI() . 'admin/policy/update-policy/' . $id;
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

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listPolicy');
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

    public function listEvent($i)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/event/list-event?page= ' . $i, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $listEvent = $response['data']['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.listEvent', compact('listEvent', 'response'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addEvent(Request $request)
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

                // dd($image);

                $url = $this->urlAPI() . 'admin/event/create-event';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                //  dd($request->isHot);
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
                                'name'     => 'isHot',
                                'contents' => $request->isHot
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
                    return redirect()->route('listEvent', ['i' => 1]);
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

    public function detailEvent($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/event/detail-event/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $event = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listEvent', ['i' => 1]);
                }
                // dd($infor);
                return $event;
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewDetailEvent($id)
    {
        try {
            $event = WebsiteController::detailEvent($id);
            return view('admin.includes.website.detailEvent', compact('event'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewUpdateEvent($id)
    {
        try {
            $event = WebsiteController::detailEvent($id);
            return view('admin.includes.website.updateEvent', compact('event'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateEvent(Request $request, $id)
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
                        'name'     => 'isHot',
                        'contents' => $request->isHot
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
                            'name'     => 'isHot',
                            'contents' => $request->isHot
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




                $url = $this->urlAPI() . 'admin/event/update-event/' . $id;
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

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listEvent', ['i' => 1]);
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

    public function deleteEvent($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/event/delete-event/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listEvent', ['i' => 1]);
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

    public function listBanner()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/banner/list-banner', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $listBanner = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.listBanner', compact('listBanner'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function deleteBanner($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/banner/delete-banner/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listBanner');
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

    public function addBanner(Request $request)
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

                $url = $this->urlAPI() . 'admin/banner/create-banner';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'application/json'
                    ],
                ]);
                //  dd($request->isHot);
                $req = $client->post(
                    $url,
                    [
                        'multipart' => [
                            $image,
                        ],

                    ],
                );
                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listBanner');
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

    public function viewUpdateBanner($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/banner/banner-detail/' . $id, [
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

                    return redirect()->route('listBanner');
                }
                // dd($infor);
                return view('admin.includes.website.updateBanner', compact('banner'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateBanner(Request $request, $id)
    {
        try {
            //  dd(1);
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
                    $body = [
                        $image,
                        [
                            'name'     => '_method',
                            'contents' => 'put'
                        ]
                    ];
                }




                $url = $this->urlAPI() . 'admin/banner/update-banner/' . $id;
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

                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listBanner');
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


    public function listHeadquarter()
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/headquarter/list-headquarter', [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $listHeadquarter = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('trang-chu');
                }
                // dd($infor);
                return view('admin.includes.website.listHeadquarter', compact('listHeadquarter'));
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function addHeadquarter(Request $request)
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

                // dd($image);

                $url = $this->urlAPI() . 'admin/headquarter/add-headquarter';
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'multipart/form-data'
                    ],
                ]);
                //  dd($request->isHot);
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
                                'name'     => 'email',
                                'contents' => $request->email
                            ],
                            [
                                'name'     => 'phone',
                                'contents' => $request->phone
                            ],
                            [
                                'name'     => 'address',
                                'contents' => $request->address
                            ],
                            [
                                'name'     => 'link_map',
                                'contents' => $request->link_map
                            ],


                        ],

                    ],
                );
                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listHeadquarter');
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

    public function detailHeadquarter($id)
    {
        try {
            $token = Cookie::get('tokenvn24h');
            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->get($this->urlAPI() . 'admin/headquarter/detail-headquarter/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    $headquarter = $response['data'];
                } else {
                    if ($response['code'] == 502) {
                        alert()->warning($response['message']);
                        AdminController::removeToken();
                    }

                    return redirect()->route('listHeadquarter');
                }
                // dd($infor);
                return $headquarter;
            }
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function infoHeadquarter($id)
    {
        try {
            $headquarter = WebsiteController::detailHeadquarter($id);
            return view('admin.includes.website.detailHeadquarter', compact('headquarter'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function viewUpdateHeadquarter($id)
    {
        try {
            $headquarter = WebsiteController::detailHeadquarter($id);
            return view('admin.includes.website.updateHeadquarter', compact('headquarter'));
        } catch (\Throwable $th) {
            alert($th)->error('Hệ thống đang được bảo trì. Vui lòng thử lại sau!');
            return back();
        }
    }

    public function updateHeadquarter(Request $request, $id)
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

                // dd($image);

                $url = $this->urlAPI() . 'admin/headquarter/update-headquarter/' . $id;
                $client = new Client([
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Content-Type' => 'multipart/form-data'
                    ],
                ]);
                //  dd($request->isHot);
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
                                'name'     => 'email',
                                'contents' => $request->email
                            ],
                            [
                                'name'     => 'phone',
                                'contents' => $request->phone
                            ],
                            [
                                'name'     => 'address',
                                'contents' => $request->address
                            ],
                            [
                                'name'     => 'link_map',
                                'contents' => $request->link_map
                            ],
                            [
                                'name'     => '_method',
                                'contents' => 'put',
                            ]


                        ],

                    ],
                );
                $response = json_decode($req->getBody()->getContents(), true);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listHeadquarter');
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

    public function deleteHeadquarter($id)
    {
        try {

            $token = Cookie::get('tokenvn24h');

            if (isset($token) && $token != null) {
                # code...

                $client = new Client();
                $data = $client->delete($this->urlAPI() . 'admin/headquarter/delete-headquarter/' . $id, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $token,
                        'Accept' => 'application/json',
                    ],
                ]);
                $response = json_decode($data->getBody()->getContents(), true);
                // dd($response);
                if ($response['status'] == 1) {
                    alert()->success($response['message']);
                    return redirect()->route('listHeadquarter');
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
}
