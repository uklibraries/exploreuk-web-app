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

    <div class="slab slab--wildcat-white page-header page-header--text">
        <div class="slab__wrapper">
            <h1 class="headline-group">
                <span class="headline-group__head">
                    <?= $m['flat']['title_display'] ?>
                </span>
            </h1>
        </div>
    </div>

    <?php require('breadcrumbs.php'); ?>

<main id="main-content" class="item-container">
    <div class="slab">
        <div class="slab__wrapper">

        <?php
        $ui = $this->q('ui');
        if (!isset($ui) || !$ui) {
            $ui = "1";
        }
        if (($ui === "2") && $m['item_image']) : ?>
            <div class="editorial">
                <?php $r = $m['item_image']; ?>
                <a href="<?= $r['reference_image_url_s'] ?>" target="_blank" rel="noopener">Open fullsize image</a> |
                <a href="<?= $this->path('/catalog/' . $r['id'] . '/zoom' . $m['query']->link()) ?>" target="_blank" rel="noopener">Zooom!</a>
            </div>
        <?php endif; ?>

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
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>

<?php require('global-footer.html'); ?>
<?php require('universal-footer.php'); ?>
