<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $m['page_title'] ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?= $m['page_description'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="/favicon.ico">
</head>
<body>
<a href="#0" class="cd-top js-cd-top">Top</a>
<div id="main">
<?php if ($m['front_page']) : ?>
    <section id="top">
        <div>
<?php require('stickyheader.php'); ?>
<?php require('search.php'); ?>
<div class="row"></div>
<?php else : ?>
    <section class="bg-uklblack" id="top2">
        <div>
<?php require('stickyheader.php'); ?>
<div id="top2_bottom">
<?php require('search-brief.php'); ?>
        </div>
<?php endif; ?>
        </div>
    </section>
    <section>
