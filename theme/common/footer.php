<?php
$base_dir = dirname(__DIR__);
global $euk_base;
require_once("$base_dir/init.php");
global $theme_path;
$theme_name = Theme::getCurrentThemeName('public');
$theme_path = u("/themes/$theme_name");
require_once("$base_dir/euk/euk.php");
?>
            </header>

            <footer>
            </footer>
        </div>
    </section>
</div>

<div id="footer">
<?php
$footer = get_theme_option('Footer Text');
if (strpos($footer, '{{LOGO}}') !== false) {
    $link = link_to_home_page(theme_logo());
    $footer = str_replace('{{LOGO}}', $link, $footer);
}
if (strpos($footer, '{{FOOTER}}') !== false) {
    $footer_addition = <<<FOOTER
<div class="bg-uklwhite"><span id="inner_footer_funders"><a href="https://www.imls.gov/"><img id="footer_funder_image" src="$theme_path/images/imls-n.png" /></a>&nbsp;&nbsp;<a href="https://www.clir.org/"><img id="footer_funder_image" src="$theme_path/images/clir-n.png" /></a>&nbsp;&nbsp;<a href="https://www.neh.org/"><img id="footer_funder_image" src="$theme_path/images/neh-n.jpg" /></a>&nbsp;&nbsp;<a href="https://www.archives.gov/nhprc"><img id="footer_funder_image" src="$theme_path/images/nhprc-n.jpg" /></a>&nbsp;&nbsp;<a href="https://libraries.uky.edu/page.php?lweb_id=1114"><img id="footer_funder_image" src="$theme_path/images/heyburn-n.png" /></a></span></div>
<div class="row bg-uklblack"><span id="copyright">Copyright © 2018 UK Libraries. For questions or comments about this website, contact <a href="mailto:sarah.dorpinghaus@uky.edu" target="_top">Sarah Dorpinghaus</a>.</span><span id="govlinks"><a href="https://www.gpo.gov/"><img class="euk-logo-small" src="$theme_path/images/gpo_fst.jpg" /></a>&nbsp;&nbsp;<a href="https://www.fdlp.gov/"><img class="euk-logo-small" src="$theme_path/images/fdlp.png" /></a></span>
FOOTER;
    $footer = str_replace('{{FOOTER}}', $footer_addition, $footer);
}
echo $footer;
?>
</div>

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha256-KM512VNnjElC30ehFwehXjx1YCHPiQkOPmqnrWtpccM=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" integrity="sha256-0rguYS0qgS6L4qVzANq4kjxPLtvnp5nn2nB5G1lWRv4=" crossorigin="anonymous"></script>
<script src="<?php echo $theme_path; ?>/assets/js/jquery.scrolly.min.js"></script>
<script src="<?php echo $theme_path; ?>/assets/js/jquery.scrollzer.min.js"></script>
<script src="<?php echo $theme_path; ?>/assets/js/skel.min.js"></script>
<script src="<?php echo $theme_path; ?>/assets/js/util.js"></script>
<!--[if lte IE 8]><script src="<?php echo $theme_path; ?>/assets/js/ie/respond.min.js"></script><![endif]-->
<script src="<?php echo $theme_path; ?>/assets/js/main.js"></script>
<script type="text/javascript" src="<?php echo "$theme_path/openseadragon/openseadragon.js"; ?>"></script>
<script type="text/javascript" src="<?php echo "$theme_path/javascripts/mediaelementplayer.min.js"; ?>"></script>
<?php if (m('script_media')): ?>
<script type="text/javascript">
$('.click-to-play-audio').click(function () {                                                                    var href_id = $(this).attr('data-id');
  var href = $(this).attr('data-href');
  $(this).after('<audio id="' + href_id + '" src="' + href  + '" style="display:block, width: 305px; height: 30px;" width="305" height="30"></audio>');
  $('#' + href_id).mediaelementplayer();
  var player = new MediaElement(href_id);
  player.pause();
  player.setSrc(href);
  player.play();
  $(this).remove();
});
$('.click-to-play-video').click(function () {
  var href_id = $(this).attr('data-id');
  var href = $(this).attr('data-href');
  $(this).after('<video id="' + href_id + '" src="' + href  + '" style="display:block, width: 360px; height: 240px;" width="360" height="240"></audio>');
  $('#' + href_id).mediaelementplayer();
  var player = new MediaElement(href_id);
  player.pause();
  player.setSrc(href);
  player.play();
  $(this).remove();
});
</script>
<?php endif; ?>
<?php if (m('script_image')): ?>
<?php $s = m('script_image'); ?>
<?php $r = m('item_image'); ?>
<script type="text/javascript">
var id = '<?php echo $s['osd_id']; ?>';
var osd_viewer = OpenSeadragon({
    id: id,
    prefixUrl: "<?php echo $s['prefix_url']; ?>",
    tileSources: {
        type: 'image',
        url: '<?php echo $r['reference_image_url_s']; ?>'
    }
});
$(osd_viewer.element).find('.openseadragon-canvas').css('background-color', 'black');
$('#<?php echo $s['ref_id']; ?>').hide();
</script>
<?php endif; ?>
<script src="<?php echo $theme_path; ?>/javascripts/back_to_top.js"></script>
<script src="<?php echo $theme_path; ?>/javascripts/main.js"></script>
	</body>
</html>
