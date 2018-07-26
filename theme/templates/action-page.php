<div class="back-to-search bg-uklgray">
    <?php echo link_to_home_page('Home'); ?> |
    <a href="<?php echo m('back_to_search'); ?>"><?php echo $euk_back_to_search_text; ?></a>
</div>

<div class="item-container">
<main class="item-presentation">
<?php if (m('item_audio')): ?>
    <?php require("audio-video-player.php"); ?>
<?php endif; ?>

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
