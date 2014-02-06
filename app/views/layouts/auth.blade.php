<!DOCTYPE html>
<html>
    <head>
<!-- Meta, title, CSS, favicons, etc. -->
<meta charset="utf-8">
<title>Out Ticket</title>
<meta name="author" content="Sarah Merbouche">

<!-- Font CSS  -->
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,700">

<!-- Core CSS  -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/bootstrap/bootstrap.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/fonts/glyphicons.min.css') }}">

<!-- Plugin CSS -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/calendar/fullcalendar.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/plugins/datatables/datatables.min.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/animate.css') }}">

<!-- Theme CSS -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/theme.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/pages.css') }}">
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/responsive.css') }}">

<!-- Boxed-Layout CSS -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/boxed.css') }}">

<!-- My Custom CSS -->
<link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/custom.css') }}">

<!-- Favicon -->
<link rel="shortcut icon" href="images/favicon.ico">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
<![endif]-->

</head>
    <body class="login-page">
        <script> 
            var boxtest = localStorage.getItem('boxed'); 
            if (boxtest === 'true') {document.body.className+=' boxed-layout';} 
        </script>
       <!-- Start: Main -->
<div id="main">
  <div class="container">
    <div class="row">
      <div id="page-logo"></div>
    </div>
      @if($errors->has('error'))
      <div class="alert alert-danger">
          {{ $errors->getMessageBag()->first() }}
      </div>
      @endif
    <div class="row">
      <div class="panel">
        <div class="panel-heading">
          <div class="panel-title"> <i class="fa fa-lock"></i>{{ trans('auth.login')}}</div>
        </div>

        <form class="cmxform" id="altForm" method="post" action="{{URL::to('/login')}}">
          <div class="panel-body">
            <div class="login-avatar"> <img src="{{ URL::asset('assets/images/logo.png') }}" alt="avatar"> </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-user"></i> </span>
                <input type="text" name="username" class="form-control phone" maxlength="10" autocomplete="off" placeholder="{{ trans('auth.username')}}">
              </div>
            </div>
            <div class="form-group">
              <div class="input-group"> <span class="input-group-addon"><i class="fa fa-key"></i> </span>
                  <input type="password" name="password" class="form-control product" maxlength="10" autocomplete="off" placeholder="{{ trans('auth.password')}}">
              </div>
            </div>
           
          </div>
          <div class="panel-footer"> <span class="panel-title-sm pull-left" style="padding-top: 7px;"><a>{{ trans('auth.forgotpwd')}}</a></span>
            <div class="form-group margin-bottom-none">
              <input class="btn btn-primary pull-right" type="submit" value="{{ trans('auth.login')}}" />
              <div class="clearfix"></div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- End: Main --> 
        <!-- Core Javascript - via CDN -->
        <script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/jqueryui/jquery-ui.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>
       
    </body>
</html>