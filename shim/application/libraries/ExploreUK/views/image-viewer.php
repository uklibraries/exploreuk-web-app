<?php $r = $m['item_image']; ?>

<?php if ($m['action'] === 'zoom') : ?>
<div id="image_viewer">
    <a href="<?= $r['reference_image_url_s'] ?>" aria-label="<?= $r['title_display'] ?>"><img class="reference_image" id="reference_image" src="<?= $r['front_thumbnail_url_s'] ?>" alt="<?= $r['title_display'] ?>" title="<?= $r['title_display'] ?>"></a>
    <div id="viewer" class="full-viewport"></div>
</div>
<?php else : ?>
    <?php
    $ui = $this->q('ui');
    if (!isset($ui) || !$ui) {
        $ui = "1";
    }
    if ($ui === "1") : ?>
<div id="image_viewer">
    <a href="<?= $r['reference_image_url_s'] ?>" aria-label="<?= $r['title_display'] ?>"><img class="reference_image" id="reference_image" src="<?= $r['front_thumbnail_url_s'] ?>" alt="<?= $r['title_display'] ?>" title="<?= $r['title_display'] ?>"></a>
    <div id="viewer" style="width: 100%; height: 600px;"></div>
</div>
    <?php elseif ($ui === "2") : ?>
<div id="image_viewer">
    <a href="<?= $r['reference_image_url_s'] ?>" target="_blank" rel="noopener"><img class="reference_image static-thumb" id="reference_image" src="<?= $r['front_thumbnail_url_s'] ?>" srcset="<?= $r['front_thumbnail_url_s'] ?> 400w, <?= $r['reference_image_url_s'] ?> <?= $r['reference_image_width_s'] ?>w" sizes="(max-width: 800px) 400px, <?= $r['reference_image_width_s'] ?>px" alt="<?= $r['title_display'] ?>" title="<?= $r['title_display'] ?>"></a>
</div>
    <?php endif; ?>
<?php endif; ?>
