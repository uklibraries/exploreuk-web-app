<?php
$base_dir = dirname(__DIR__);
global $euk_base;
require_once("$base_dir/init.php");
global $theme_path;
$theme_name = Theme::getCurrentThemeName('public');
$theme_path = u("/themes/$theme_name");
global $findaidurl;
global $featured_image;
require_once("$base_dir/euk/euk.php");
?>
<!DOCTYPE html>
<!--
    Prologue by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="en">
<head>
    <title><?= m('page_title') ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?= m('page_description') ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
<a href="#0" class="cd-top js-cd-top">Top</a>
<div id="main">
<?php if (euk_on_front_page()) : ?>
    <section id="top">
        <div>
<?php require_once("$base_dir/templates/stickyheader.php"); ?>
<?php require_once("$base_dir/templates/search.php"); ?>
<div class="row">
<?php require_once("$base_dir/templates/nav.php"); ?>
</div>
<?php else : ?>
    <section class="bg-uklblack" id="top2">
        <div>
<?php require_once("$base_dir/templates/stickyheader.php"); ?>
<div id="top2_bottom">
<?php require_once("$base_dir/templates/search-brief.php"); ?>
        </div>
<?php endif; ?>
        </div>
    </section>
    <section>
