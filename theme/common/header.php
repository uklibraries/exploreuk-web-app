<?php
$base_dir = dirname(__DIR__);
global $euk_base;
require_once("$base_dir/init.php");
global $theme_path;
$theme_name = Theme::getCurrentThemeName('public');
$theme_path = u("/themes/$theme_name");
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.15.1/mediaelementplayer.min.css">
</head>
<body>
<div id="main">
    <section id="top">
        <div class="container">
<?php if (euk_on_front_page()): ?>
<header>
<div class="row bg-wildcatblue">
    <div class="frontlogo">
<?php require_once("$base_dir/templates/sitetitle.php"); ?>
    </div>
</div>
</header>
<footer>
<?php require_once("$base_dir/templates/search.php"); ?>
<div class="row">
<?php require_once("$base_dir/templates/nav.php"); ?>
</div>
</footer>
<?php else: ?>
<?php require_once("$base_dir/templates/stickyheader.php"); ?>
<footer>
<?php require_once("$base_dir/templates/search.php"); ?>
</footer>
<?php endif; ?>
        </div>
    </section>
    <section>
        <div class="container">
            <header>
