<?php $r = m('item_image'); ?>
<div id="image_viewer">
    <a href="<?php echo $r['reference_image_url_s']; ?>"><img class="reference_image" id="reference_image" src="<?php echo $r['front_thumbnail_url_s']; ?>"></a>
    <div id="viewer" style="width: 100%; height: 600px;"></div>
</div>
