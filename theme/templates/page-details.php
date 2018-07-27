<div class="item-details">
<?php $id = meta('id'); if ($id): ?>
<?php $url = "https://exploreuk.uky.edu/catalog/$id"; ?>
<h3>Permalink</h3>
<p><a href="<?php echo $url; ?>" target="_blank" rel="nooopener"><?php echo $url; ?></a></p>
<?php endif; ?>

<?php foreach ($euk_detail_fields as $field => $label): ?>
<?php $content = meta($field); ?>
<?php if ($content): ?>
<h3><?php echo $label; ?></h3>
    <?php if (is_array($content)): ?>
<ul>
        <?php foreach ($content as $item): ?>
            <?php if (strpos($item, 'http') === 0): ?>
<li><a href="<?php echo $item; ?>" target="_blank" rel="noopener"><?php echo $item; ?></a></li>
            <?php elseif (isset($euk_detail_search[$field])): ?>
<li><a href="<?php echo u($euk_detail_search[$field] . urlencode($item)); ?>"><?php echo $item; ?></a></li>
            <?php else: ?>
<li><?php echo $item; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
</ul>
    <?php elseif (strpos($content, 'http') === 0): ?>
<p><a href="<?php echo $content; ?>" target="_blank" rel="noopener"><?php echo $content; ?></a></p>
    <?php elseif (isset($euk_detail_search[$field])): ?>
<p><a href="<?php echo u($euk_detail_search[$field] . urlencode($content)); ?>"><?php echo $content; ?></a></p>
    <?php else: ?>
<p><?php echo $content; ?></p>
    <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
</div>

<?php if (m('item_book')): ?>
<?php $r = m('item_book')['text']; ?>
<div class="item-text">
    <p>The text may or may not be an accurate representation of the original.</p>
    <iframe id="text_frame" src="<?php echo $r['href']; ?>" width="100%" name="text"></iframe>
</div>
<?php endif; ?>
