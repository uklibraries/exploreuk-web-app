<?php require('header.php'); ?>

<?php
$q = $m['query']->q('q');
$m['back_to_search'] = $this->path('/catalog/' . $m['query']->link());
$m['back_to_search_text'] = !empty($q)
    ? 'Search results for &ldquo;' . htmlspecialchars((string) $q) . '&rdquo;'
    : 'All Items';
if (isset($m['flat']['title_display'])) {
    $m['current_page_title'] = $m['flat']['title_display'];
}
?>

<div class="slab slab--thin">
    <div class="slab__wrapper">
        <?php require('breadcrumbs.php') ?>
    </div>
</div>

<?php
$ui = $this->q('ui');
if (!isset($ui) || !$ui) {
    $ui = "1";
}
if (($ui === "2") && $m['item_image']) : ?>
    <div class="search-and-item-control-row bg-uklgray">
        <div class="search-and-item-control-container">
            <?php $r = $m['item_image']; ?>
            <div class="image-controls">
                <a href="<?= $r['reference_image_url_s'] ?>" target="_blank" rel="noopener">Open fullsize image</a> |
                <a href="<?= $this->path('/catalog/' . $r['id'] . '/zoom' . $m['query']->link()) ?>" target="_blank" rel="noopener">Zooom!</a>
            </div>
        </div>
    </div>
<?php endif; ?>

<div class="slab">
    <div class="slab__wrapper">
        <h1 class="headline-group">
            <span class="headline-group__head"><?= $m['flat']['title_display'] ?></span>
        </h1>

        <main id="main-content" class="item-container">
            <div class="item-presentation">
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
            </div>

            <?php require('page-title.php'); ?>

            <?php require('page-harmful-language-statement.php'); ?>

            <?php require('page-details.php'); ?>
        </main>
    </div>
</div>

<?php require('global-footer.html'); ?>
<?php require('universal-footer.php'); ?>
