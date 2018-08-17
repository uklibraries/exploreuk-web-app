<div class="page-title bg-uklgray">
<?php
if (m('downloadable')) {
    require('download-menu.php');
}
if (m('item_audio')) {
    require('audio-video-player.php');
}
?>
<h2><?= meta('title_display') ?></h2>
<?php
foreach ($euk_title_field_order as $field) {
    if (($field === 'collection_url') && (!meta('finding_aid_url_s'))) {
        continue;
    }
    $content = meta($field);
    if ($content) {
        print render_field($field, $content);
    }
}
?>
</div>
