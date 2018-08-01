<ul>
<li><a href="#item-details">Item Details</a></li>
<?php if (m('item_book')): ?>
<li><a href="#item-text">Text</a></li>
<?php endif; ?>
</ul>

<div id="item-details" class="item-details">
<?php foreach ($euk_detail_field_order as $field):
        $content = meta($field);
        if ($content):
            print render_field($field, $content);
        endif;
      endforeach; ?>
</div>

<?php if (m('item_book')): ?>
<?php $r = m('item_book')['text']; ?>
<div id="item-text" class="item-text">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe id="text_frame" src="<?php echo $r['href']; ?>" width="100%" name="text"></iframe>
</div>
<?php endif; ?>
