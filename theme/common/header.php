<?php
$base_dir = dirname(__DIR__);
require_once("$base_dir/init.php");
global $euk_base;
$euk_base = get_theme_option('euk_base');
$theme_path = u('/themes/omeukaprologue');
require_once("$base_dir/euk/euk.php");
?>
<!DOCTYPE HTML>
<!--
	Prologue by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title><?php echo m('site_title'); ?></title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="<?php echo $theme_path; ?>/assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/main.css" />
<?php queue_js_file('vendor/jquery'); ?>
<?php queue_js_file('vendor/jquery-ui'); ?>
<?php echo head_js(); ?>
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/ie8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/ie9.css" /><![endif]-->
<!-- lity -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.0/lity.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.0/lity.js"></script>
<!-- mediaelement -->
<!--
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.9/mediaelementplayer.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.9/mediaelement.min.js"></script>
-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.15.1/mediaelementplayer.min.css">
	</head>
	<body>
		<!-- Header -->
			<div id="header">
				<div class="top">
					<!-- Logo -->
						<div id="logo">
                            <?php require_once("$base_dir/templates/logo.php"); ?>
						</div>

					<!-- Nav -->
						<nav id="nav">
<h2><?php echo get_theme_option('Special Pages Label'); ?></h2>
<?php echo public_nav_main(); ?>
<?php require_once("$base_dir/templates/facets.php"); ?>
						</nav>
				</div>

				<div class="bottom">
                    <!-- anything here? -->
				</div>

			</div>

		<!-- Main -->
			<div id="main">
				<!-- Intro -->
					<section id="top">
						<div class="container">
							<header>
<?php echo get_theme_option('Header Text'); ?>
                            </header>
                            <footer>
<?php require_once("$base_dir/templates/search.php"); ?>
                            </footer>
                        </div>
                    </section>
					<section>
						<div class="container">
							<header>
