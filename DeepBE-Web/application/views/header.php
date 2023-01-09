<!DOCTYPE html>
<html lang="en">
<head>
	<title>DeepBE</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<link href="<?=base_url("bootstrap/css/bootstrap.min.css")?>" rel="stylesheet" media="screen">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
	<script src="//ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
	<script src="<?=base_url("js/jquery.blockUI.js")?>"></script>
	<script src="<?=base_url("js/main.js")?>"></script>
	<script src="<?=base_url("js/jquery.tablesorter.js")?>"></script>
	<script src="<?=base_url("js/jquery.tablesorter.widgets.js")?>"></script>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

	<link href="<?=base_url("/css/theme.blue.css")?>" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Alef" rel="stylesheet" type="text/css">



        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-244317623-1"></script>
        <script>
                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());

                gtag('config', 'UA-244317623-1');
        </script>




	<style type="text/css">
		html, body { height: 100%; }
		label.error { color: #b94a48; }
		#wrap { min-height: 100%; height: auto !important; margin: auto; }
		#push, #footer { height: 60px; }
		#footer { background-color: #f5f5f5; }
		.container .credit { margin: 20px 0; }

	    #single tr{text-align:center; color:silver;}
	    #single tr:nth-of-type(1){text-align:center; color:black;}
	    #single tr:nth-of-type(2){text-align:center; color:black;}
	    #single tr:nth-of-type(3){text-align:center; color:black;}
	    #single tr:nth-of-type(4){text-align:center; color:black;}
	    #single td{width:15px; height:20px}

	</style>
</head>
<body>

<div id="wrap">
	
	<div class="navbar navbar-inverse navbar-static-top">
		<div class="navbar-inner">
			<div class="container">
				<ul class="nav">
					<li><a href="<?=base_url("page/home")?>"><i class="icon-home icon-white"></i>&nbsp;Home</a></li>
					<li><a href="<?=base_url("page/help")?>"><i class="icon-question-sign icon-white"></i>&nbsp;Help</a></li>
					<li><a href="//github.com/NahyeKim/DeepBE" target="_blank"><i class="icon-file icon-white"></i>&nbsp;Code</a></li>
					<li><a href="<?=base_url("page/about")?>"><i class="icon-user icon-white"></i>&nbsp;About</a></li>
				</ul>
			</div>
		</div>
	</div>
	
	<div class="container">
		<div class="page-header">
			<h1 style="font-family: 'Alef', sans-serif"><font size="6">
			DeepBE</font></h1>
		</div>
