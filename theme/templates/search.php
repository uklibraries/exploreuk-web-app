<form action="<?php echo u('/catalog/'); ?>" method="get">
    <div class="form-group">
        <input class="q form-control" type="text" name="q" value="<?php echo q('q'); ?>">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" value="search">Search</button></span>
    </div>
</form>
<article>
<details>
<summary><?php echo get_theme_option('Refine Search Text'); ?></summary>
<?php if (count(m('active_facets')) > 0): ?>
<div id="active_facets" class="row">
<?php foreach (m('active_facets') as $active): ?>
<article class="4u 12u$(mobile)">
<h3><?php echo $active['field_label']; ?></h3>
<ul>
<li><?php echo $active['value_label']; ?> (<?php echo $active['count']; ?>) <a href="<?php echo $active['remove_link']; ?>">[remove]</a></li>
</ul>
</article>
<?php endforeach; ?>
</div>
<?php endif; ?>
<div id="facets" class="row">
<?php foreach (m('facets') as $facet): ?>
<article class="4u 12u$(mobile)">
<h3><?php echo $facet['field_label']; ?></h3>
<ul>
<?php foreach ($facet['values'] as $value): ?>
<li><a href="<?php echo $value['add_link']; ?>"><?php echo $value['value_label']; ?> (<?php echo $value['count']; ?>)</a></li>
<?php endforeach; ?>
</ul>
</article>
<?php endforeach; ?>
</div>
</details>
</article>
