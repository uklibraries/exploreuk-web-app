<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $m['page_title'] ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?= $m['page_description'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-touch-icon.png?v=m2LeKYRNPO">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png?v=m2LeKYRNPO">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png?v=m2LeKYRNPO">
    <link rel="manifest" href="/site.webmanifest?v=m2LeKYRNPO">
    <link rel="mask-icon" href="/safari-pinned-tab.svg?v=m2LeKYRNPO" color="#005dab">
    <link rel="shortcut icon" href="/favicon.ico?v=m2LeKYRNPO">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#005dab">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FPRYLHP028"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-FPRYLHP028', { 'anonymize_ip': true });
    </script>
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23584444-4"></script>
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
