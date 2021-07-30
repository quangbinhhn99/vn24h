<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="icon" href="{{ asset('img/logo1.jpg') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/circular-std/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/libs/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/fontawesome/css/fontawesome-all.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/chartist-bundle/chartist.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/morris-bundle/morris.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/charts/c3charts/c3.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/fonts/flag-icon-css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/vinh.css')}}">
    <title>Sửa tin tức</title>
</head>

<body>    
    @include('includes/admin/layout/menu')


    <div id="page-wrapper" style="width:80%; margin-left:20%; margin-top:2%; padding-right:5%">
        <form action="" method="POST" role="form">
            <legend>Sửa tin liên quan</legend>
    
            <div class="form-group">
                <label for="username">Title <span style="color: red;">*</span></label>
                <input type="text" id="username" required class="form-control" name="username" value="">
            </div>

            <div class="form-group">
                <label for="username">Content <span style="color: red;">*</span></label>
                <input type="text" id="" required class="form-control" name="" value="">
            </div>
    
            <div class="form-group">
                <label for="img">Ảnh<span style="color: red;">*</span></label>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Ảnh hiện tại</th>
                            <th>Ảnh cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><img style="width: 200px; margin: 0px auto;" src="{{asset('img/rectangle2.png')}}" alt="#"></td>
                            <td><input type="file" name="avatar" class="form-control" ></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <button type="submit" name="update" class="btn btn-success" style="margin: 30px 0px;">
                Cập nhật
            </button>
        </form>
    
    </div>
    
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
</body>
 
</html>