<div class="page-title bg-uklgray">
<?php
if (isset($m['downloadable'])) {
    require('download-menu.php');
}
if (isset($m['item_audio'])) {
    require('audio-video-player.php');
}
?>
<h2><?= $m['flat']['title_display'] ?></h2>
<?php
foreach (EUK_TITLE_FIELD_ORDER as $field) {
    if (($field === 'collection_url') && (!isset($m['details']['finding_aid_url_s']))) {
        continue;
    }
    if (isset($m['details'][$field])) {
        $content = $m['details'][$field];
        print $this->renderField($content);
    }
}
?>
</div>
