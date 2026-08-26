<?php

$r = $m['item_image']; ?>
<div id="image_viewer">
    <a href="<?= $r['reference_image_url_s'] ?>" aria-label="<?= $r['title_display'] ?>"><img width="<?= $r['reference_image_width_s'] ?>" height="<?= $r['reference_image_height_s'] ?>" class="reference_image" id="reference_image" src="<?= $r['front_thumbnail_url_s'] ?>" alt="<?= $r['title_display'] ?>" title="<?= $r['title_display'] ?>"></a>
    <div id="viewer" style="width: 100%; height: 600px;"></div>
</div>
