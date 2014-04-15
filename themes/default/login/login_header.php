<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo html::title(); ?></title>
	<style>
		*{padding: 0; margin: 0;}
		body{font-size: 12px !important; font-family: arial !important; color: #444;}
		.wrapper{margin: 0 auto; width: 80%; }
		#header{border-bottom: 1px solid #ddd; padding: 15px 0; box-shadow: 0px 1px 10px #ddd;}
		a.btn, button.btn{
			text-decoration: none;
			font-size: 14px;
			font-weight: bold;
			color: #fff;
			background: #3F8844;
			display: inline-block;
			padding: 5px 10px;
			border-radius: 3px;
			overflow: hidden;
			margin-top: 8px;
			border: 0;
		}
		.fl{float: left;}
		.fr{float: right;}
		#header a:hover{background: #C93D3D;}

		#footer{ color: #999; font-style: italic; padding: 15px 0; text-align: center;}
		input.form_el{
			padding: 10px;
			border: 1px solid #ddd;
			border-radius: 5px;
			width: 95.5%;
			display: block;
			margin: 10px 0;
			color: #555;
			font-size: 16px;
		}

		label{font-size: 13px; font-weight: bold; color: #999; }
		form button{padding: 10px 20px !important; width: 100%; cursor: pointer;}
		form{
			background: #FDFDFD;
			margin: 50px auto;
		}
		form .wrapper{
			width: 40%;
		}
		form a{
			display: block;
			text-align: center;
			color: #999;
			margin-top: 30px;

		}
	</style>
	<?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'js/toastmessage/resources/css/jquery.toastmessage.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>
</head>
<body>



		<div id="header">
			<div class="wrapper">
				<a class="fr btn" style="background : #C93D3D !important" href="<?php echo BASEPATH;?>">Cancel</a>
				<img class="logo"  src="<?php echo BASEPATH."images/logo.png" ?>" title="<?php echo config::get('SITE_NAME');?>" alt="<?php echo config::get('SITE_NAME');?>">
			</div> <!-- end: wrapper -->


		<div class="clear"></div>
		</div> <!-- end: header -->

		<div id="container">


