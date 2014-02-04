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
    <body class="dashboard index-load">
        <script> 
            var boxtest = localStorage.getItem('boxed'); 
            if (boxtest === 'true') {document.body.className+=' boxed-layout';} 
        </script>
        @include('layouts.header')
        <!-- Start: Main -->
        <div id="main" style="display:block"> 
            @include('layouts.sidebar')
            <section id="content">
                <div id="topbar">
                    <ol class="breadcrumb">
                        <li><a href="{{ URL::to('/') }}"><i class="fa fa-home"></i></a></li>
                        @yield('topbar')
                    </ol>
                </div>
                <div class="container">
                    @yield('content')
                </div>
            </section>
        </div>
        <!-- End: Main -->
        <!-- Begin: Front Page Loading Animation --> 
       <!-- <div id="page-loader"><span class="glyphicon glyphicon-cog fa-spin cog-1"></span></div>-->
        <!-- End: Front Page Loading Animation --> 
        
        <!-- Core Javascript - via CDN -->
        <script src="{{ URL::asset('assets/plugins/jquery/jquery.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/jqueryui/jquery-ui.min.js') }}"></script>
        <script src="{{ URL::asset('assets/plugins/bootstrap/bootstrap.min.js') }}"></script>

        <!-- Plugins - Via CDN -->
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/flot/jquery.flot.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/calendar/fullcalendar.min.js') }}"></script>
        
        <!-- Plugins -->
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/calendar/gcal.js') }}"></script><!-- Calendar Addon -->
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/flot/jquery.flot.resize.min.js') }}"></script><!-- Flot Charts Addon -->
        <script type="text/javascript" src="{{ URL::asset('assets/plugins/datatables.js') }}"></script><!-- Datatable Bootstrap Addon -->

        <!-- Theme Javascript -->
        <script type="text/javascript" src="{{ URL::asset('assets/js/uniform.min.js') }}"></script>
        <script type="text/javascript" src="{{ URL::asset('assets/js/main.js') }}"></script>
        <!--<script type="text/javascript" src="js/plugins.js"></script>-->
        <script type="text/javascript" src="{{ URL::asset('assets/js/custom.js') }}"></script>
    
       <script type="text/javascript">
        jQuery(document).ready(function() {
	  
	// Init Theme Core 	  
	Core.init();
	//$('header').css("display", "block");

       
        /* // Create an example page animation. Really
	// not suitable for production enviroments
	var headerAnimate = setTimeout(function() {
		// Animate Header from Top
		$('header').css("display", "block").addClass('animated bounceInDown');
	},300);
	
	// Add an aditional delay to hide the loading spinner
	// and animate body content from bottom of page
	var bodyAnimate = setTimeout(function() {
		// hide spinner
		$('#page-loader').css("display", "none");
		
		// show body and animate from bottom. At end of animation 
		// add several css properties because the animation will bug 
		// existing psuedo backgrounds(:after)
		$('#main').css("display", "block").addClass('animated animated-short bounceInUp').one('webkitAnimationEnd oanimationend msAnimationEnd animationend', function(){
			$('header').removeClass('animated bounceInDown');
			$('#main').removeClass('animated animated-short bounceInUp')
			$('body').css({background: "#FFFFFF", overflow: "visible"});
			$('#content, #sidebar').addClass('refresh');
			// Init sparkline animations
			sparkload();
		});				
	 },1150);*/
	
	
	
		
	
     

			  

});
</script>

    </body>
</html>