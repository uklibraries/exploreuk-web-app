<div class="tab-wrap">
<div class="tab-nav">
<ul id="item-view-tabs" class="tabs">
<li id="item-view-details" class="active"><a href="#item-details">Item Details</a></li>
<?php if (m('item_book')): ?>
<li id="item-view-text"><a href="#item-text">Text</a></li>
<?php endif; ?>
</ul>
</div>

<div id="item-details" class="tab-content active">
<?php foreach ($euk_detail_field_order as $field):
        $content = meta($field);
        if ($content):
            print render_field($field, $content);
        endif;
      endforeach; ?>
</div>

<?php if (m('item_book') && isset(m('item_book')['text'])): ?>
<?php $r = m('item_book')['text']; ?>
<div id="item-text" class="tab-content hide">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe id="text_frame" src="<?php echo $r['href']; ?>" width="100%" name="text"></iframe>
</div>
</div>
<?php endif; ?>
