<div class="item-details">
<?php foreach ($euk_detail_field_order as $field):
        $content = meta($field);
        if ($content):
            print render_field($field, $content);
        endif;
      endforeach; ?>
</div>

<?php if (m('item_book')): ?>
<?php $r = m('item_book')['text']; ?>
<div class="item-text">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe id="text_frame" src="<?php echo $r['href']; ?>" width="100%" name="text"></iframe>
</div>
<?php endif; ?>
