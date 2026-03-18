<div class="tab-wrap js-tabs js-tabs--white">
<div>
<ul id="item-view-tabs" class="tabs js-tablist">
<li id="item-view-details" class="js-tablist__item"><a href="#item-details" class="js-tablist__link">Item Details</a></li>
<?php if (isset($m['item_book'])) : ?>
<li id="item-view-text" class="js-tablist__item"><a href="#item-text" class="js-tablist__link">Text</a></li>
<?php endif; ?>
</ul>
</div>

<div id="item-details" class="js-tabcontent">
<?php
$rows = '';
foreach (EUK_DETAIL_FIELD_ORDER as $field) {
    if (isset($m['details'][$field])) {
        $content = $m['details'][$field];
        if ($field === 'usage_display') {
            if ($rows) {
                echo '<table class="contact-table">' . $rows . '</table>';
                $rows = '';
            }
            print $this->renderField($content);
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

<?php if (isset($m['item_book']) && isset($m['item_book']['text'])) : ?>
    <?php $r = $m['item_book']['text']; ?>
<div id="item-text" class="js-tabcontent">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe id="text_frame" src="<?= $r['href'] ?>" width="100%" height="300" name="text"></iframe>
</div>
</div>
<?php endif; ?>
