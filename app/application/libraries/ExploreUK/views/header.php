<!DOCTYPE html>
<html lang="en">

<head>
    <title><?= $m['page_title'] ?></title>
    <meta charset="utf-8" />
    <meta name="description" content="<?= $m['page_description'] ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="<?= $this->assetPath('icons/favicon.ico') ?>?v=2" sizes="any">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $this->assetPath('icons/favicon-32x32.png') ?>?v=2">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $this->assetPath('icons/favicon-16x16.png') ?>?v=2">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $this->assetPath('icons/apple-touch-icon.png') ?>?v=2">
    <link rel="manifest" href="<?= $this->assetPath('icons/site.webmanifest') ?>?v=2">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <!-- Limestone is imported by styles.css into a cascade layer; preloaded here because that @import blocks render -->
    <link rel="preload" href="https://webcdn.uky.edu/limestone/1.0.0/css/style.css" as="style">
    <link rel="stylesheet" href="<?= $this->assetPath('css/styles.min.css') ?>?<?= $this->subresourceIntegrity('css/styles.min.css') ?>" />
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.2.0/jquery.magnific-popup.min.js"></script>
    <script defer src="https://webcdn.uky.edu/limestone/1.0.0/js/lib/jquery-accessible-tabs-aria.js"></script>
    <script defer src="https://webcdn.uky.edu/limestone/1.0.0/js/toggle-button.js"></script>
    <script defer src="https://webcdn.uky.edu/limestone/1.0.0/js/modals.js"></script>
    <meta name="theme-color" content="#005dab">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FPRYLHP028"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', 'G-FPRYLHP028', {
            'anonymize_ip': true
        });
    </script>
</head>

<body>
    <?php require('archive-notice.html'); ?>
    <?php require('universal-header.php'); ?>
    <div id="main">
        <?php if ($m['front_page']) : ?>
            <section id="top">
                <div>
                    <?php require('global-header.php'); ?>
                    <?php require('search.php'); ?>
                    <div class="row"></div>
        <?php else : ?>
                    <section class="bg-uklblack" id="top2">
                        <div>
                            <?php require('global-header.php'); ?>
                            <div id="top2_bottom">
                                <?php require('search-brief.php'); ?>
                            </div>
        <?php endif; ?>
                        </div>
                    </section>
