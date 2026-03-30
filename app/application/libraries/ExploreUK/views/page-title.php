<div class="item-details">
<div class="grid--major-left">
<div class="grid__column grid__column--major">
<h1 class="heading__text"><?= $m['flat']['title_display'] ?></h1>
<?php
$rows = '';
foreach (EUK_TITLE_FIELD_ORDER as $field) {
    if (($field === 'collection_url') && (!isset($m['details']['finding_aid_url_s']))) {
        continue;
    } elseif (($field === 'source_s') && (isset($m['details']['finding_aid_url_s']))) {
        continue;
    }
    if (isset($m['details'][$field])) {
        $content = $m['details'][$field];
        if (in_array($field, ['scopecontent_s', 'description_display'])) {
            if ($rows) {
                echo '<dl>' . $rows . '</dl>';
                $rows = '';
            }
            print $this->renderField($content);
        } elseif ($field === 'collection_url') {
            if (strlen((string) $content['value']['source_s']) > 0) {
                $collection_label = EUK_LOCALE['en']['open_collection_guide'];
                $link = "/?f%5Bsource_s%5D%5B%5D=";
                $link_label = EUK_LOCALE['en']['more_items'];
                $dd = implode('', [
                    $content['value']['source_s'],
                    ' | ',
                    $this->renderLink(['href' => $this->path("/catalog/{$content['value']['base_id']}"), 'content' => $collection_label, 'open_new_tab' => true]),
                    ' | ',
                    $this->renderLink(['href' => $this->path($link . urlencode((string) $content['value']['source_s'])), 'content' => $link_label, 'open_new_tab' => true]),
                ]);
                $rows .= '<dt>' . EUK_LOCALE['en']['source_s'] . '</dt><dd>' . $dd . "</dd>\n";
            }
        } else {
            $label = EUK_LOCALE['en'][$field] ?? 'Unknown';
            if (is_array($content['value'])) {
                $dds = array_map(fn($item) => '<dd>' . $this->renderHelper($field, $item) . '</dd>', $content['value']);
                $rows .= '<dt>' . $label . '</dt>' . implode('', $dds) . "\n";
            } else {
                $rows .= '<dt>' . $label . '</dt><dd>' . $this->renderHelper($field, $content['value']) . "</dd>\n";
            }
        }
    }
}
if ($rows) {
    echo '<dl>' . $rows . '</dl>';
}
?>
</div>
<?php if (isset($m['downloadable'])) : ?>
<div class="grid__column grid__column--minor">
    <?php require('download-menu.php'); ?>
</div>
<?php endif; ?>
</div>
</div>
