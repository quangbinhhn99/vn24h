<?php $token = Cookie::get('tokenvn24h'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{ asset('img/logo1.jpg') }}" type="image/x-icon">

    <title>Admin</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">



</head>

<body id="page-top">
    @include('sweetalert::alert')

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin/layout/menu')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin/layout/header')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <h2>Chỉnh sửa gói sữa: </h2>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="form-group">
                                        <label for="">Tên gói sữa</label>
                                        <input type="text" class="form-control form-control-user" id="name" name="name"
                                            value="{{ $detailpacket['name'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="upload-photo-goi">Ảnh</label>
                                        <div class="nhan-than" style="background: #ffffff; width:100%;">
                                            <img class="text" style="margin: 10px auto; height:100px;"
                                                src="{{ $detailpacket['image'] }}" id="nt" class="imgDownload">
                                            <input multiple="multiple" type="file" name="image" id="upload-photo-goi"
                                                class="form-control-user" accept="image/*"/>
                                        </div>

                                    </div>

                                    <div class="form-group">
                                        <label for="">Giá min</label>
                                        <input type="text" class="form-control form-control-user" id="fee_min"
                                            value="{{ number_format($detailpacket['price_from']) }}" name="price_from">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Giá max</label>
                                        <input type="text" class="form-control form-control-user" id="fee_max" name="price_to"
                                            value="{{ number_format($detailpacket['price_to']) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Nội dung gói</label>
                                        <textarea name="content" id="contentup" rows="5"
                                            class="form-control" name="content">{!! $detailpacket['content'] !!}</textarea>
                                    </div>

                                    <input type="hidden" id="token" value="{{ $token }}">
                                    <input type="hidden" id="id1" value="{{ $detailpacket['id'] }}">
                                    <div class="modal-footer">

                                        <button class="btn btn-primary"><a data-toggle="modal"
                                                data-target="#upatepac">Chỉnh
                                                sửa</a></button>
                                    </div>
                                    <div class="modal fade" id="upatepac" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Bạn có chắn chắn muốn
                                                        cập nhật?</h5>
                                                    <button class="close" type="button" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-secondary" type="button"
                                                        data-dismiss="modal">Huỷ</button>
                                                    <button class="btn btn-primary" onclick="updateconfirm();">Cập nhật</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
</body>

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.18.0/dist/sweetalert2.all.js"></script>

    <script>
        let image = []

        function readURL1(input) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#nt').attr('src', e.target.result);
                }
                image = input.files[0];
                reader.readAsDataURL(input.files[0]); // convert to base64 string
            }
        }



        $("#upload-photo-goi").change(function() {
            readURL1(this);
        });
        function CallApi1(path, method, body, Authorization) {
            return axios({
                method: method,
                url: path,
                data: body,
                headers: {
                    Authorization: "Bearer " + Authorization,
                    "Content-Type": "application/json",
                    "Access-Control-Allow-Origin": "*",
                    "Access-Control-Allow-Credentials": true,
                    "Access-Control-Allow-Methods": "GET, POST, PUT, DELETE, OPTIONS, HEAD",
                    "Access-Control-Allow-Headers": "Access-Control-*, Origin, X-Requested-With, Content-Type, Accept",
                },
            }).catch((error) => {
                console.log(error.response);
            });
        };

        function updateconfirm() {

        let name = document.getElementById("name").value;

        let content = $("#contentup").val();
        let str = document.getElementById("fee_min").value;
        let price_from = str.replaceAll(",", "");
        let strr = document.getElementById("fee_max").value;
        let price_to = strr.replaceAll(",", "");
        
        let id = document.getElementById("id1").value;
        let token = document.getElementById("token").value;
        let file = new FormData();
        file.append("name", document.getElementById("name").value)
        file.append("content", content)
        file.append("price_from", price_from)
        file.append("price_to", price_to)
        file.append("image", image)
        file.append("_method", 'put')

        CallApi1(
            `http://103.226.249.210:8010/api/admin/packet/update-packet/${id}`,
            "POST",
            file,
            token
        ).then((res) => {
            console.log(res.data);
            if (res.data.status === 1) {
                window.location.reload()
                swal(res.data.message)
                


            } else {
                swal(res.data.message)
            }
            })
        }
    </script>

        

        </html>
