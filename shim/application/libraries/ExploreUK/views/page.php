<?php require('header.php'); ?>

<div class="search-and-item-control-row bg-uklgray">
<div class="search-and-item-control-container">

<div class="back-to-search">
    <a href="<?= $this->path('') ?>">Home</a> |
    <a href="<?= $m['back_to_search'] ?>"><?= $m['back_to_search_text'] ?></a>
</div>


<?php
$ui = $this->q('ui');
if (!isset($ui) || !$ui) {
    $ui = "1";
}
if (($ui === "2") && $m['item_image']) : ?>
<?php $r = $m['item_image']; ?>
<div class="image-controls">
    <a href="<?= $r['reference_image_url_s'] ?>" target="_blank" rel="noopener">Open fullsize image</a> |
    <a href="<?= $this->path('/catalog/' . $r['id'] . '/zoom' . $m['query']->link()) ?>" target="_blank" rel="noopener">Zooom!</a>
</div>
<?php endif; ?>

</div>
</div>

<div class="item-container">
<main class="item-presentation">
<?php
if (isset($m['item_image'])) {
    require('image-viewer.php');
}

if (isset($m['item_book'])) {
    require('book-reader.php');
}

if (isset($m['item_videolike'])) {
    require('videolike-player.php');
}
?>
</main>

<?php require('page-title.php'); ?>

<?php require('page-details.php'); ?>
</div>

<?php require('footer.php'); ?>
