<div class="search-and-item-control-row bg-uklgray">
<div class="search-and-item-control-container">

<div class="back-to-search">
    <?= link_to_home_page('Home') ?> |
    <a href="<?= m('back_to_search') ?>"><?= $euk_back_to_search_text ?></a>
</div>


<?php
$ui = q('ui');
if (!isset($ui) || !$ui) {
    $ui = "1";
}
if (($ui === "2") && m('item_image')) : ?>
<?php $r = m('item_image'); ?>
<div class="image-controls">
    <a href="<?= $r['reference_image_url_s'] ?>" target="_blank" rel="noopener">Open fullsize image</a> |
    <a href="<?= u('/catalog/' . $r['id'] . '/zoom' . euk_link_to_query($euk_query)) ?>" target="_blank" rel="noopener">Zooom!</a>
</div>
<?php endif; ?>

</div>
</div>

<div class="item-container">
<main class="item-presentation">
<?php if (m('item_image')) : ?>
    <?php require("image-viewer.php"); ?>
<?php endif; ?>

<?php if (m('item_book')) : ?>
    <?php require("book-reader.php"); ?>
<?php endif; ?>
</main>

<?php require("page-title.php"); ?>

<?php require("page-details.php"); ?>
</div>
