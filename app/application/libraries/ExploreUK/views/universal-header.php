<!-- universal header/footer files start -->
<link rel="stylesheet" href="https://lib.uky.edu/webparts/ukhdr/2024/css/global_header_footer.css" media="all">
    <link rel="stylesheet" id="ukl-header-styles" href="https://lib.uky.edu/webparts/ukhdr/prod/css/global_header_footer.css" media="all" />
    <script
        id="ukl-header-script"
        type="module"
        src="https://lib.uky.edu/webparts/ukhdr/prod/js/universalHeader.js"
        onerror="
        (() => {
            // Remove this script
            old_script = document.querySelector('#ukl-header-script');
            old_script.remove();

            // Use the fallback css
            const styles = document.querySelector('#ukl-header-styles');
            styles.href='https://cdn.jsdelivr.net/gh/uklibraries/UKL_HeaderFooter@main/css/global_header_footer.css'
            
            // Create a new script and use fallback js
            const script = document.createElement('script');
            script.id = 'ukl-header-script';
            script.type = 'module';
            script.src = 'https://cdn.jsdelivr.net/gh/uklibraries/UKL_HeaderFooter@main/js/universalHeader.js';
            script.dataset.base_path = 'exploreuk';
            document.head.appendChild(script);

            // Remove footer script
            old_footer=document.querySelector('#ukl-footer-script')
            old_footer.remove();
            
            // Create a new footer script and use fallback js
            const footer_script = document.createElement('script');
            footer_script.src='https://cdn.jsdelivr.net/gh/uklibraries/UKL_HeaderFooter@main/js/comboFooterShared.js';
            document.body.appendChild(footer_script);
        })();
        "
        data-base_path="exploreuk"
    ></script>
<!-- universal header/footer files end -->