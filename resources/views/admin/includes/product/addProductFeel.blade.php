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

    <!-- Custom styles for this template-->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">
    <link href="{{ asset('js/sweet-alert.js') }}" rel="stylesheet">

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
                    <div class="row">
                        <h2 class="text-left col-md-10 col-12">Thêm mới cảm nhận sản phẩm: </h2>
                    </div>

                    <form action="{{route('addProductFeel', ['id'=>$id])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6 col-12">
                                <label for="name">Tên khách hàng: </label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Tên khách hàng ..." required value="@if(isset($request->name)) {{$request->name}} @endif">
                            </div>
                            <div class="form-group col-md-6 col-12">
                                <label>Ảnh avatar:</label>
                                  <div class="image-input">
                                      <input type="file" accept="image/*" id="imageInput" name="image">
                                      <img src="" class="image-preview" style="max-width:100px">
                                     
                                  </div>
                              </div>
                        </div>
                        <div class="form-group">
                            <label for="content">Cảm nhận sản phẩm: </label><br>
                            <textarea name="post_content" class="form-control" id="content" cols="100%" rows="3"
                                placeholder="Cảm nhận sản phẩm..."></textarea>
                        </div>
                     

                        <div class="form-group">
                            <label for="video">Link video: </label><br>
                            <input type="text" class="form-control" id="video" name="video" placeholder="Link video cảm nhận ..." value="">
                        </div>
                       
                        <button type="submit" class="btn btn-secondary">Quay lại</button>
                        <a href="{{route('addProductFeel', ['id'=>$id])}}"><button type="submit" class="btn btn-primary">Thêm mới</button></a>
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
    {{-- <script src="{{ asset('js/jquery.min.js') }} "></script> --}}

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/jquery.min.js') }} "></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/admin.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }} "></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('vendor/jquery-easing/jquery.easing.min.js') }}"></script>
    <script src="{{ asset('assets/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/sweetalert/sweetalert.all.js')}}"></script>
    @include('sweetalert::alert')


    <script type="text/javascript">
    CKEDITOR.replace('post_content');
        $(document).ready(function() {
            $('#example-dropUp').multiselect({
                enableFiltering: true,
                includeSelectAllOption: true,
                maxHeight: 500,
                dropUp: true
            });
        });
        $('#imageInput').on('change', function() {
            $input = $(this);
            if ($input.val().length > 0) {
                fileReader = new FileReader();
                fileReader.onload = function(data) {
                    $('.image-preview').attr('src', data.target.result);
                }
                fileReader.readAsDataURL($input.prop('files')[0]);
                $('.image-button').css('display', 'none');
                $('.image-preview').css('display', 'block');
                $('.change-image').css('display', 'block');
            }
        });

        $('.change-image').on('click', function() {
            $control = $(this);
            $('#imageInput').val('');
            $preview = $('.image-preview');
            $preview.attr('src', '');
            $preview.css('display', 'none');
            $control.css('display', 'none');
            $('.image-button').css('display', 'block');
        });

    </script>


</body>

</html>
