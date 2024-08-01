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
    <meta name="msapplication-TileColor" content="#2d89ef">
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
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23584444-4"></script>
    <!-- universal header/footer files start -->
    <link id="ukl-header-styles" rel="stylesheet" href="https://lib.uky.edu/webparts/ukhdr/prod/css/global_header_footer.min.css" media="all" />
    <script id="ukl-header-script" type="module" src="https://lib.uky.edu/webparts/ukhdr/prod/js/universalheader.min.js" onerror="
			(() => {
				// Remove this script
				old_script = document.querySelector('#ukl-header-script');
				old_script.remove();

				// Use the fallback css
				const styles = document.querySelector('#ukl-header-styles');
				styles.href='https://cdn.jsdelivr.net/gh/uklibraries/UKL_HeaderFooter@dev/css/global_header_footer.css'
				
				// Create a new script and use fallback js
				const script = document.createElement('script');
				script.id = 'ukl-header-script';
				script.type = 'module';
				script.src = 'https://cdn.jsdelivr.net/gh/uklibraries/UKL_HeaderFooter@dev/js/universalheader.js';
				script.dataset.base_path = 'libcal';
				document.head.appendChild(script);

				// Remove footer script
				old_footer=document.querySelector('#ukl-footer-script')
				old_footer.remove();
				
				// Create a new footer script and use fallback js
				const footer_script = document.createElement('script');
				footer_script.src='https://cdn.jsdelivr.net/gh/uklibraries/UKL_HeaderFooter@dev/js/combofootershared.js';
				document.body.appendChild(footer_script);
			})();
			" data-base_path="exploreuk"></script>
</head>

<body>
    <a href="#0" class="cd-top js-cd-top">Top</a>
    <div id="main">
        <?php if ($m['front_page']) : ?>
            <section id="top">
                <div>
                    <!-- <?php require('stickyheader.php'); ?> -->
                    <?php require('search.php'); ?>
                    <div class="row"></div>
                <?php else : ?>
                    <section class="bg-uklblack" id="top2">
                        <div>
                            <!-- <?php require('stickyheader.php'); ?> -->
                            <div id="top2_bottom">
                                <?php require('search-brief.php'); ?>
                            </div>
                        <?php endif; ?>
                        </div>
                    </section>
                    <section>