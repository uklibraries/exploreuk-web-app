<div class="tab-wrap js-tabs js-tabs--white item-details">
<div class="">
<ul id="item-view-tabs no-decoration" class="tabs js-tablist">
<li id="item-view-details" class="js-tablist__item"><a href="#item-details" class="js-tablist__link">Item Details</a></li>
<?php if (isset($m['item_book'])) : ?>
<li id="item-view-text" class="js-tablist__item"><a href="#item-text" class="js-tablist__link">Text</a></li>
<?php endif; ?>
</ul>
</div>

<div id="item-details" class="js-tabcontent table-content">
<?php
$rows = '';
foreach (EUK_DETAIL_FIELD_ORDER as $field) {
    if (isset($m['details'][$field])) {
        $content = $m['details'][$field];
        if ($field === 'usage_display') {
            if ($rows) {
                echo '<dl>' . $rows . '</dl>';
                $rows = '';
            }
            print $this->renderField($content);
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

<?php if (isset($m['item_book']) && isset($m['item_book']['text'])) : ?>
    <?php $r = $m['item_book']['text']; ?>
<div id="item-text" class="js-tabcontent table-content">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe class="editorial" id="text_frame" src="<?= $r['href'] ?>" width="100%" height="300" name="text"></iframe>
</div>
</div>
<?php endif; ?>
