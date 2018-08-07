<?php
$base_dir = dirname(__DIR__);
global $euk_base;
require_once("$base_dir/init.php");
global $theme_path;
$theme_name = Theme::getCurrentThemeName('public');
$theme_path = u("/themes/$theme_name");
require_once("$base_dir/euk/euk.php");
?>
    </section>
</div>

<div id="footer">
    <div id="outer_footer_funders" class="row bg-uklwhite">
        <span>Content made available with the support of:</span>
        <ul id="inner_footer_funders">
            <li><a href="https://www.imls.gov/" target="_blank" rel="noopener"><img id="footer_funder_image" class="lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/imls-n.png" alt="Institute of Museum and Library Services" width="231" height="83"/></a></li>
            <li><a href="https://www.clir.org/" target="_blank" rel="noopener"><img class="lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/clir-n.png" alt="Council on Library and Information Resources" width="167" height="76"/></a></li>
            <li><a href="https://www.neh.gov/" target="_blank" rel="noopener"><img class="lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/neh-n.jpg" alt="National Endowment for the Humanities" width="214" height="99"/></a></li>
            <li><a href="https://www.archives.gov/nhprc" target="_blank" rel="noopener"><img class="lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/nhprc-n.jpg" alt="National Archives - National Historical Publications and Records Commission" width="117" height="147"/></a></li>
            <li><a href="https://libraries.uky.edu/page.php?lweb_id=1114" target="_blank" rel="noopener"><img class="lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/heyburn-n.png" alt="The John G. Heyburn II Initiative for Excellence in the Federal Judiciary" width="118" height="89"/></a></li>
        </ul>
    </div>
    <div id="copyright-bar" class="row bg-uklblack">
        <span id="copyright">Copyright © 2018 UK Libraries. For questions or comments about this website, contact <a href="mailto:sarah.dorpinghaus@uky.edu">Sarah Dorpinghaus</a>.</span>
        <ul>
            <li><a aria-label="Special Collections Research Center on Facebook" href="https://www.facebook.com/ukscrc/" target="_blank" rel="noopener"><i class="fab fa-facebook-f"></i></a></li>
            <li><a aria-label="University of Kentucky Libraries on Twitter" href="https://twitter.com/UKLibraries" target="_blank" rel="noopener"><i class="fab fa-twitter"></i></a></li>
            <li><a aria-label="University of Kentucky Libraries on Instagram" href="https://www.instagram.com/uklibraries/" target="_blank" rel="noopener"><i class="fab fa-instagram"></i></a></li>
            <li><a aria-label="University of Kentucky Archives on YouTube" href="https://www.youtube.com/channel/UCxgb2cJ2hpO-0QOTnmxgfKw" target="_blank" rel="noopener"><i class="fab fa-youtube"></i></a></li>
            <li><a aria-label="Curiosities and Wonders" href="https://ukyarchives.blogspot.com/" target="_blank" rel="noopener"><i class="fab fa-blogger"></i></a></li>
        </ul>
        <ul>
            <li><a href="https://libraries.uky.edu/SC" target="_blank" rel="noopener"><img class="euk-logo-small lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/scrc_logo.png" alt="UK Special Collections Research Center" width="134" height="34"/></a></li>
            <li><a href="https://www.gpo.gov/" target="_blank" rel="noopener"><img class="euk-logo-small lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/gpo_fst.jpg" alt="US Government Publishing Office" width="74" height="34"/></a></li>
            <li><a href="https://www.fdlp.gov/" target="_blank" rel="noopener"><img class="euk-logo-small lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $theme_path; ?>/images/fdlp.png" alt="Federal Depository Library Program" width="46" height="34"/></a></li>
        </ul>
    </div>
</div>

<!-- CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.css" integrity="sha256-0SZxASYAglrmIuTx+ZYHE3hzTnCZWB7XLu+iA8AG0Z0=" crossorigin="anonymous" />
<link rel="stylesheet" href="<?php echo $theme_path; ?>/assets/css/main.min.css" />

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" integrity="sha256-0rguYS0qgS6L4qVzANq4kjxPLtvnp5nn2nB5G1lWRv4=" crossorigin="anonymous"></script>
<!--[if lte IE 8]><script src="<?php echo $theme_path; ?>/assets/js/ie/respond.min.js"></script><![endif]-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js" integrity="sha256-3VzI8FuSG20IfvIDKRptBR+1d4T6G57eDIf6ZEO13iY=" crossorigin="anonymous"></script>
<script src="<?php echo $theme_path; ?>/assets/js/resize.js"></script>
<?php if (m('script_media')): ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.15.1/mediaelementplayer.min.css" integrity="sha256-6DWOIEAEFJqhgMTt7B/BzbsUfdGFD9DUdubbfI2t/eo=" crossorigin="anonymous" />
<script type="text/javascript" src="<?php echo "$theme_path/javascripts/mediaelementplayer.min.js"; ?>"></script>
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
<?php $ui = q('ui'); if (!isset($ui) || !$ui) { $ui = "1"; }?>
<?php if ($ui === "1"): ?>
<script type="text/javascript" src="<?php echo "$theme_path/openseadragon/openseadragon.min.js"; ?>"></script>
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
<?php endif; ?>
<script src="<?php echo $theme_path; ?>/javascripts/back_to_top.js"></script>
<script src="<?php echo $theme_path; ?>/javascripts/main.js"></script>
<script src="<?php echo $theme_path; ?>/javascripts/jsbin-tabs.js"></script>
<script src="<?php echo $theme_path; ?>/assets/js/lazyload.js"></script>
	</body>
</html>
