<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $m['page_title'] ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>
<body>
<div class="item-container-zoom">
<main class="item-presentation-zoom">
<?php
if (isset($m['item_image'])) {
    require('image-viewer.php');
}

if (isset($m['item_book'])) {
    require('book-reader.php');
}
?>
</main>
</div>
    </section>
</div>

<!-- CSS -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.0/css/all.css" integrity="sha384-X5iGjkVST5r3jLDsMntiITKVTkgf0v7xH26P7RqdeTvlbV9P11Azs27mXs7Kht/E" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.css" integrity="sha256-0SZxASYAglrmIuTx+ZYHE3hzTnCZWB7XLu+iA8AG0Z0=" crossorigin="anonymous" />
<link rel="stylesheet" href="<?= $this->themePath('assets/css/main.min.css') ?>" />

<!-- Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" integrity="sha256-0rguYS0qgS6L4qVzANq4kjxPLtvnp5nn2nB5G1lWRv4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lity/2.3.1/lity.min.js" integrity="sha256-3VzI8FuSG20IfvIDKRptBR+1d4T6G57eDIf6ZEO13iY=" crossorigin="anonymous"></script>
<script src="<?= $this->themePath('assets/js/resize.js') ?>"></script>
<?php if (isset($m['script_media'])) : ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/2.15.1/mediaelementplayer.min.css" integrity="sha256-6DWOIEAEFJqhgMTt7B/BzbsUfdGFD9DUdubbfI2t/eo=" crossorigin="anonymous" />
<script type="text/javascript" src="<?= $this->themePath('javascripts/mediaelementplayer.min.js') ?>" ?>"></script>
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
<?php if (isset($m['script_image'])) : ?>
<?php $s = $m['script_image']; ?>
<?php $r = $m['item_image']; ?>
<script type="text/javascript" src="<?= $this->themePath('openseadragon/openseadragon.min.js') ?>"></script>
<script type="text/javascript">
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
$('#<?= $s['ref_id'] ?>').hide();
</script>
<?php endif; ?>
<script src="<?= $this->themePath('javascripts/back_to_top.js') ?>"></script>
<script src="<?= $this->themePath('javascripts/main.js') ?>"></script>
<script src="<?= $this->themePath('assets/js/lazyload.js') ?>"></script>
    </body>
</html>
