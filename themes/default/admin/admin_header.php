<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo html::title(); ?></title>
	<link rel="stylesheet" href="<?php echo BASEPATH.config::get('DEFAULT_CURRENT_THEME'); ?>admin/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo BASEPATH.config::get('DEFAULT_CURRENT_THEME'); ?>admin/css/admin.css">
	<?php echo Html::style(array('href'=>Config::get('DEFAULT_CURRENT_THEME') .'js/toastmessage/resources/css/jquery.toastmessage.css','media'=>'all','type'=>'text/css', 'rel'=>'stylesheet')); ?>

</head>
<body>



		<div id="header">
			<div class="wrapper">

				<a class="fr btn" href="<?php echo BASEPATH;?>users/logout">Logout</a>
				<a class="fr btn btn-green" title="Araçları, Donanımları ve Lokasyonu Gerçek Server'dan çeker. Daha önce var onları günceller" href="<?php echo BASEPATH;?>Cars/cronjobs">Robotları Gönder</a>

				<ul class="fr control_menu" style="margin-top: 9px">
					<li><?php echo html::link('Araçlar',array('href'=>'Cars/')); ?>
						<ul class="sub_menu">
							<li><?php echo html::link('Araçlar',array('href'=>'Cars/listAllCars')); ?></li>
							<li><?php echo html::link('Markalar',array('href'=>'Cars/listCarsMark')); ?></li>
							<li><?php echo html::link('Eksralar',array('href'=>'Cars/listCarExtras')); ?></li>
						</ul>
					</li>
						<li><?php echo html::link('Haberler',array('href'=>'News/allNews')); ?></li>
					<li><?php echo html::link('Sayfalar',array('href'=>'page')); ?></li>
					<li><?php echo html::link('Ayarlar',array('href'=>'Setting')); ?></li>
				</ul>


				<a href="<?php echo BASEPATH;?>">
					<img class="logo" src="<?php echo BASEPATH."images/logo_new.jpg" ?>" title="<?php echo config::get('SITE_NAME');?>" alt="<?php echo config::get('SITE_NAME');?>">
				</a>
			</div> <!-- end: wrapper -->
			<div class="clear"></div>
		</div> <!-- end: header -->

		<div id="container">
			<div class="wrapper">


