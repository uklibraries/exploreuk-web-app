<div class="page-title bg-uklgray">
<?php if (m('downloadable')): ?>
    <?php require("download-menu.php"); ?>
<?php endif; ?>

<h2><?php echo meta('title_display'); ?></h2>
<?php foreach ($euk_title_fields as $field => $label): ?>
<?php $content = meta($field); if ($content): ?>
<h3><?php echo $label; ?></h3>
<p>
    <?php echo $content; ?>
</p>
<?php endif; ?>
<?php endforeach; ?>

</div>
