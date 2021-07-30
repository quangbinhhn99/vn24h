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
    <script src="{{ asset('js/jquery-2.2.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-multiselect.js') }}"></script> <!-- Custom fonts for this template-->
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/sweet-alert.js') }}" rel="stylesheet">

</head>

<body id="page-top">


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
                    <div class="row">
                        <h2 class="text-left col-md-10 col-12">Cập nhật thông tin CTV: </h2>
                    </div>

                    <form action="{{ asset('admin/ctv/cap-nhat-ctv/' . $ctv['id']) }}" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="name">Họ tên: </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Họ tên ..." value="{{ $ctv['name'] }}" required>
                                </div>

                                <div class="col-md-6">
                                    <label for="cmt">CMT: </label>

                                    <input type="number" class="form-control" id="cmt" name="cmt"
                                        placeholder="CMT/CCCD..." value="{{ $ctv['cmt'] }}" required>
                                    <span class="text-danger" id="checkCmt"></span>
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="form-row">
                                <div class="col-md-6">
                                    <label for="phone">Số điện thoại: </label>
                                    <input type="number" class="form-control" id="phone" name="phone" readonly
                                        value="{{ $ctv['phone'] }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Email: </label>
                                    <input type="email" class="form-control" id="name" name="email"
                                        placeholder="Email..." value="{{ $ctv['email'] }}">
                                </div>
                            </div>

                        </div>
                        <div class="form-group">

                            <div>
                                <label for="address">Địa chỉ: </label>
                                <input type="text" class="form-control" id="address" name="address"
                                    placeholder="Nhập địa chỉ..." value="{{ $ctv['address'] }}">
                            </div>

                        </div>



                        <div class="form-group">
                            <label for="name">CTV cấp trên: </label>
                            <select name="ctv_id" id="single" class="form-control">
                                <option value="">Hệ thống mới</option>
                                @foreach ($listCtv as $data)
                                    <option value="{{ $data['id'] }}" @if ($data['id'] == $ctv['user_introduce_id']) {{ 'selected' }} @endif>
                                        {{ $data['code_branch'] }}-{{ $data['code_ordinal'] }}
                                        {{ $data['name'] }}
                                    </option>
                                @endforeach

                            </select>

                        </div>
                        <button type="submit" class="btn btn-secondary">Quay lại</button>
                        <a href="{{ asset('admin/ctv/cap-nhat-ctv/' . $ctv['id']) }}"><button type="submit"
                                class="btn btn-primary">Cập nhật
                            </button></a>
                    </form>

                    </nav>
                </div>

                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->



            <!-- Footer -->
            @include('admin.layout.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>



    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
    @include('sweetalert::alert')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $("#single").select2({
            //   placeholder: "Select a programming language",
            allowClear: true
        });
        //   $("#multiple").select2({
        //       placeholder: "Select a programming language",
        //       allowClear: true
        //   });
        $("#cmt").keyup(function() {
            // alert(1);
            var cmt = $(this).val();
            var checkCmt = /^[0-9]{9}$/g;
            var checkCmt2 = /^[0-9]{12}$/g;
            if (cmt != '') {
                if (checkCmt.test(cmt) == true || checkCmt2.test(cmt) == true) {
                    jQuery("#submit").attr("disabled", false);
                    document.getElementById('checkCmt').innerHTML = '';

                } else {
                    jQuery("#submit").attr("disabled", true);
                    document.getElementById('checkCmt').innerHTML =
                        'Số CMT/CCCD có 9 hoặc 12 chữ số!';
                }

            }
        });

    </script>


</body>

</html>
