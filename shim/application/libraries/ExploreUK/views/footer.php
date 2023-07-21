    </section>
</div>

<div id="footer">
    <div id="outer_footer_funders" class="row bg-uklwhite">
        <span>Content made available with the support of:</span>
        <ul id="inner_footer_funders">
            <li><a href="https://www.imls.gov/" target="_blank" rel="noopener"><img id="footer_funder_image" class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/imls-n.png') ?>" alt="Institute of Museum and Library Services" width="231" height="83"/></a></li>
            <li><a href="https://www.clir.org/" target="_blank" rel="noopener"><img class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/clir-n.png') ?>" alt="Council on Library and Information Resources" width="167" height="76"/></a></li>
            <li><a href="https://www.neh.gov/" target="_blank" rel="noopener"><img class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/neh-n.jpg') ?>" alt="National Endowment for the Humanities" width="214" height="99"/></a></li>
            <li><a href="https://www.archives.gov/nhprc" target="_blank" rel="noopener"><img class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/nhprc-n.jpg') ?>" alt="National Archives - National Historical Publications and Records Commission" width="117" height="147"/></a></li>
            <li><a href="https://heyburncollections.org/" target="_blank" rel="noopener"><img class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/heyburn-n.png') ?>" alt="The John G. Heyburn II Initiative for Excellence in the Federal Judiciary" width="118" height="89"/></a></li>
        </ul>
    </div>
    <div id="copyright-bar" class="row bg-uklblack">
        <span id="copyright">Copyright © UK Libraries</span>
        <ul>
            <li><a aria-label="Special Collections Research Center on Facebook" href="https://www.facebook.com/ukscrc/" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
            <li><a aria-label="University of Kentucky Libraries on Twitter" href="https://twitter.com/UKLibraries" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li>
            <li><a aria-label="University of Kentucky Libraries on Instagram" href="https://www.instagram.com/uklibraries/" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
            <li><a aria-label="University of Kentucky Archives on YouTube" href="https://www.youtube.com/channel/UCxgb2cJ2hpO-0QOTnmxgfKw" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a></li>
            <li><a aria-label="Curiosities and Wonders" href="https://ukyarchives.blogspot.com/" target="_blank" rel="noopener"><i class="fab fa-blogger"></i></a></li>
        </ul>
        <ul>
            <li><a href="https://libraries.uky.edu/SC" target="_blank" rel="noopener"><img class="euk-logo-small lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/scrc_logo.png') ?>" alt="UK Special Collections Research Center" width="134" height="34"/></a></li>
            <li><a href="https://www.gpo.gov/" target="_blank" rel="noopener"><img class="euk-logo-small lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/gpo_fst.jpg') ?>" alt="US Government Publishing Office" width="74" height="34"/></a></li>
            <li><a href="https://www.fdlp.gov/" target="_blank" rel="noopener"><img class="euk-logo-small lazy" src="<?= $this->themePath('images/middlegray.png') ?>" data-src="<?= $this->themePath('images/fdlp.png') ?>" alt="Federal Depository Library Program" width="46" height="34"/></a></li>
        </ul>
    </div>
</div>

<!-- CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.0/css/all.css" integrity="sha384-X5iGjkVST5r3jLDsMntiITKVTkgf0v7xH26P7RqdeTvlbV9P11Azs27mXs7Kht/E" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.css" integrity="sha256-0SZxASYAglrmIuTx+ZYHE3hzTnCZWB7XLu+iA8AG0Z0=" crossorigin="anonymous" />
<link rel="stylesheet" href="<?= $this->themePath('assets/css/main.min.css') ?>?<?= $this->subresourceIntegrity('assets/css/main.min.css') ?>" />

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" integrity="sha256-0rguYS0qgS6L4qVzANq4kjxPLtvnp5nn2nB5G1lWRv4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js" integrity="sha256-3VzI8FuSG20IfvIDKRptBR+1d4T6G57eDIf6ZEO13iY=" crossorigin="anonymous"></script>
<script src="<?= $this->themePath('assets/js/resize.js') ?>"></script>
<?php if (isset($m['script_image'])) : ?>
<?php $s = $m['script_image']; ?>
<?php $r = $m['item_image']; ?>
<?php
$ui = $this->q('ui');
if (!isset($ui) || !$ui) {
    $ui = "1";
}
if ($ui === "1") : ?>
<script type="text/javascript" src="<?= $this->themePath('openseadragon/openseadragon.min.js') ?>"></script>
<script type="text/javascript">
$(function () {
    function resize_window() {
        if (OpenSeadragon.isFullScreen()) {
            $('#viewer').height($(window).height());
        }
        else {
            var min_height = 150;
            var max_height = Math.round(0.6 * $(window).height());

            var image_width = <?= $r['reference_image_width_s'] ?>;
            var image_height  = <?= $r['reference_image_height_s'] ?>;
            var current_width = $('#viewer').width();

            var target_height = Math.round(current_width * image_height / image_width);
            if (target_height > max_height) {
                target_height = max_height;
            }
            if (target_height < min_height) {
                target_height = min_height;
            }

            $('#viewer').height(target_height);

            /* display_viewer(); */
        }
    }

    function display_viewer() {
        var width = $('#viewer').width();
        if (width <= 400) {
            $('#<?= $s['osd_id'] ?>').hide();
            $('#<?= $s['ref_id'] ?>').show();
        }
        else {
            $('#<?= $s['osd_id'] ?>').show();
            $('#<?= $s['ref_id'] ?>').hide();
        }
    }

    function initialize_osd() {
        var id = '<?= $s['osd_id'] ?>';
        var osd_viewer = OpenSeadragon({
            id: id,
            prefixUrl: "<?= $s['prefix_url'] ?>",
            tileSources: {
                type: 'image',
                url: '<?= $r['reference_image_url_s'] ?>'
            }
        });
        $(osd_viewer.element).find('.openseadragon-canvas').css('background-color', 'black');
        /* display_viewer(); */
        $('#<?= $s['ref_id'] ?>').hide();
    }

    $(window).resize(function () {
        resize_window();
    });

    resize_window();
    initialize_osd();
});
</script>
<?php endif; ?>
<?php endif; ?>
<script src="<?= $this->themePath('javascripts/back_to_top.js') ?>"></script>
<script src="<?= $this->themePath('javascripts/main.js') ?>"></script>
<script src="<?= $this->themePath('javascripts/jsbin-tabs.js') ?>"></script>
<script src="<?= $this->themePath('assets/js/lazyload.js') ?>"></script>
    </body>
</html>
