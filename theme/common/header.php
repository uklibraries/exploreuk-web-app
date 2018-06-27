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
    <!--[if lte IE 8]><link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/ie8.css" /><![endif]-->
    <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/ie9.css" /><![endif]-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.theme.css" integrity="sha256-mEMD30TTg+vIEGUmHHgcgSOgm0FBfLipyQ97Jr0TTH8=" crossorigin="anonymous" />
    <!-- lity -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.0/lity.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.0/lity.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.15.1/mediaelementplayer.min.css">
    <link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/main.css" />
</head>
<body>
<a href="#0" class="cd-top js-cd-top">Top</a>
<div id="main">
<style type="text/css">
#top > div {
    background-image:url(<?php echo $random_collection['background-image']; ?>);
    height: 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}
</style>

    <section id="top">
        <div class="container">
<?php require_once("$base_dir/templates/stickyheader.php"); ?>
<?php require_once("$base_dir/templates/search.php"); ?>
<div class="row">
<?php require_once("$base_dir/templates/nav.php"); ?>
</div>
<?php else: ?>
    <section class="bg-uklblack" id="top2">
        <div class="container">
<?php require_once("$base_dir/templates/stickyheader.php"); ?>
<div id="top2_bottom">
<?php require_once("$base_dir/templates/search-brief.php"); ?>
        </div>
<?php endif; ?>
        </div>
    </section>
    <section>
        <div class="container">
            <header>
