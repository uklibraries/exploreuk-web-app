<div class="page-title bg-uklgray">
<?php
if (isset($m['downloadable'])) {
    require('download-menu.php');
}
?>
<h2 class="heading__text"><?= $m['flat']['title_display'] ?></h2>
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
                echo '<table class="contact-table">' . $rows . '</table>';
                $rows = '';
            }
            print $this->renderField($content);
        } elseif ($field === 'collection_url') {
            if (strlen((string) $content['value']['source_s']) > 0) {
                $collection_label = EUK_LOCALE['en']['open_collection_guide'];
                $link = "/?f%5Bsource_s%5D%5B%5D=";
                $link_label = EUK_LOCALE['en']['more_items'];
                $td = implode('', [
                    $content['value']['source_s'],
                    ' | ',
                    $this->renderLink($this->path("/catalog/{$content['value']['base_id']}"), $collection_label, true),
                    ' | ',
                    $this->renderLink($this->path($link . urlencode((string) $content['value']['source_s'])), $link_label, true),
                ]);
                $rows .= '<tr><th scope="row">' . EUK_LOCALE['en']['source_s'] . '</th><td>' . $td . "</td></tr>\n";
            }
        } else {
            $label = EUK_LOCALE['en'][$field] ?? 'Unknown';
            if (is_array($content['value'])) {
                $items = array_map(fn($item) => '<li>' . $this->renderHelper($field, $item) . '</li>', $content['value']);
                $td = '<ul class="no-decoration">' . implode('', $items) . '</ul>';
            } else {
                $td = $this->renderHelper($field, $content['value']);
            }
            $rows .= '<tr><th scope="row">' . $label . '</th><td>' . $td . "</td></tr>\n";
        }
    }
}
if ($rows) {
    echo '<table class="contact-table">' . $rows . '</table>';
}
?>
</div>
