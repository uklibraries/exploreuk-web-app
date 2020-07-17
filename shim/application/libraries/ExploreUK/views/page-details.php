<div class="tab-wrap">
<div class="tab-nav">
<ul id="item-view-tabs" class="tabs">
<li id="item-view-details" class="active"><a href="#item-details">Item Details</a></li>
<?php if (isset($m['item_book'])) : ?>
<li id="item-view-text"><a href="#item-text">Text</a></li>
<?php endif; ?>
</ul>
</div>

<div id="item-details" class="tab-content active">
<?php
foreach (EUK_DETAIL_FIELD_ORDER as $field) {
    if (isset($m['details'][$field])) {
        $content = $m['details'][$field];
        print $this->renderField($content);
    }
}
?>
</div>

<?php if (isset($m['item_book']) && isset($m['item_book']['text'])) : ?>
<?php $r = $m['item_book']['text']; ?>
<div id="item-text" class="tab-content hide">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe id="text_frame" src="<?= $r['href'] ?>" width="100%" height="300" name="text"></iframe>
</div>
</div>
<?php endif; ?>
