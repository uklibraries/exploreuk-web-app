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
echo $footer;
?>
</div>

<!-- Scripts -->
<script src="<?php echo $theme_path; ?>/assets/js/jquery.min.js"></script>
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
	</body>
</html>
