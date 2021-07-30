<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script>
      window.OneSignal = window.OneSignal || [];
      OneSignal.push(function() {
        OneSignal.init({
          appId: "5c9ef5c1-8046-462e-8f18-a0a2e0ca3016",
        });
        (async function(){
        var deviceID = await OneSignal.getUserId();
        // document.getElementById("device_id").value = deviceID;
       
        })()
      });
    </script>
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
   <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
   <link href="{{ asset('css/admin.min.css') }}" rel="stylesheet">
   <link href="{{ asset('js/sweet-alert.js') }}" rel="stylesheet">

</head>