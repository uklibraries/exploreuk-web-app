<div class="page-title bg-uklgray">
<?php if (m('downloadable')): ?>
    <?php require("download-menu.php"); ?>
<?php endif; ?>

<h2><?php echo meta('title_display'); ?></h2>
<?php foreach ($euk_title_field_order as $field):
        $content = meta($field);
        if ($content):
            print render_field($field, $content);
        endif;
      endforeach; ?>

</div>
