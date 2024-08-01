    </section>
    </div>

    <div id="footer">
        <script src="https://lib.uky.edu/webparts/ukhdr/prod/css/global_header_footer.min.css"></script>
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
                $(function() {
                    function resize_window() {
                        if (OpenSeadragon.isFullScreen()) {
                            $('#viewer').height($(window).height());
                        } else {
                            var min_height = 150;
                            var max_height = Math.round(0.6 * $(window).height());

                            var image_width = <?= $r['reference_image_width_s'] ?>;
                            var image_height = <?= $r['reference_image_height_s'] ?>;
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
                        } else {
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

                    $(window).resize(function() {
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