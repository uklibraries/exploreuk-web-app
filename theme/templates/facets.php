<h2> Limit your search</h2>

<ul>
<li><a href="<?php echo m('back_to_search'); ?>">Back to search</a></li>
<li><a href="<?php echo u('/catalog/'); ?>">Start over</a></li>
</ul>

<?php foreach (m('active_facets') as $active): ?>
<h3><?php echo $active['field_label']; ?></h3>
<ul>
<li><?php echo $active['value_label']; ?> (<?php echo $active['count']; ?>) <a href="<?php echo $active['remove_link']; ?>">[remove]</a></li>
</ul>
<?php endforeach; ?>

<?php foreach (m('facets') as $facet): ?>
<h3><?php echo $facet['field_label']; ?></h3>
<ul>
<?php foreach ($facet['values'] as $value): ?>
<li><a href="<?php echo $value['add_link']; ?>"><?php echo $value['value_label']; ?> (<?php echo $value['count']; ?>)</a></li>
<?php endforeach; ?>
</ul>
<?php endforeach; ?>
