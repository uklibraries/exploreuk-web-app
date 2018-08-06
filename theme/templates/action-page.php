<div class="search-and-item-control-row bg-uklgray">
<div class="search-and-item-control-container">

<div class="back-to-search">
    <?php echo link_to_home_page('Home'); ?> |
    <a href="<?php echo m('back_to_search'); ?>"><?php echo $euk_back_to_search_text; ?></a>
</div>


<?php $ui = q('ui'); if (!isset($ui) || !$ui) { $ui = "1"; }?>
<?php if (($ui === "2") && m('item_image')): ?>
<?php $r = m('item_image'); ?>
<div class="image-controls">
    <a href="<?php echo $r['reference_image_url_s']; ?>" target="_blank" rel="noopener">Open fullsize image</a> |
    <a href="<?php echo u('/catalog/' . $r['id'] . '/zoom' . euk_link_to_query($euk_query)); ?>" target="_blank" rel="noopener">Zooom!</a>
</div>
<?php endif; ?>

</div>
</div>

<div class="item-container">
<main class="item-presentation">
<?php if (m('item_image')): ?>
    <?php require("image-viewer.php"); ?>
<?php endif; ?>

<?php if (m('item_book')): ?>
    <?php require("book-reader.php"); ?>
<?php endif; ?>
</main>

<?php require("page-title.php"); ?>

<?php require("page-details.php"); ?>
</div>
