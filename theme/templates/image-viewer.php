<?php $r = m('item_image'); ?>

<?php if (m('action') === 'zoom'): ?>
<div id="image_viewer">
    <a href="<?php echo $r['reference_image_url_s']; ?>"><img class="reference_image" id="reference_image" src="<?php echo $r['front_thumbnail_url_s']; ?>"></a>
    <div id="viewer" class="full-viewport"></div>
</div>
<?php else: ?>
    <?php $ui = q('ui'); if (!isset($ui) || !$ui) { $ui = "1"; }?>
    <?php if ($ui === "1"): ?>
<div id="image_viewer">
    <a href="<?php echo $r['reference_image_url_s']; ?>"><img class="reference_image" id="reference_image" src="<?php echo $r['front_thumbnail_url_s']; ?>"></a>
    <div id="viewer" style="width: 100%; height: 600px;"></div>
</div>
    <?php elseif ($ui === "2"): ?>
<div id="image_viewer">
    <a href="<?php echo $r['reference_image_url_s']; ?>" target="_blank" rel="noopener"><img class="reference_image static-thumb" id="reference_image" src="<?php echo $r['front_thumbnail_url_s']; ?>" srcset="<?php echo $r['front_thumbnail_url_s']; ?> 400w, <?php echo $r['reference_image_url_s']; ?> <?php echo $r['reference_image_width_s']; ?>w" sizes="(max-width: 800px) 400px, <?php echo $r['reference_image_width_s']; ?>px"></a>
</div>
    <?php endif; ?>
<?php endif; ?>
