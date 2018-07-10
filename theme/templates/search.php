<form action="<?php echo u('/catalog/'); ?>" method="get" id="search">
    <div class="form-group">
        <span><?php echo get_theme_option('Search Items Count Text'); ?></span>
        <span><input aria-label="Search" class="q form-control" type="text" name="q" value="<?php echo q('q'); ?>">
        <span class="input-group-btn"><button type="submit" class="btn btn-default bg-uklblue" value="search">Search</button></span></span>
    </div>

    <div id="featured_image_box"><p id="featured_image_text"><a href="<?php echo $featured_image['url']; ?>"><?php echo $featured_image['label']; ?></a></p>

    </div>
</form>

    <div id="mySidenav" class="sidenav">
  <span class="closebtn">&times;</span>
<div id="facet_group">
<div id="facet_group_left">

<?php if (count(m('active_facets')) > 0): ?>
<div id="active_facets" class="row">
<?php foreach (m('active_facets') as $active): ?>
<article class="4u 12u$(mobile)">
<details><summary><?php echo $active['field_label']; ?></summary><br/>
<ul>
<li><?php echo $active['value_label']; ?> (<?php echo $active['count']; ?>) <a href="<?php echo $active['remove_link']; ?>">[remove]</a></li>
</ul></details>
</article>
<?php endforeach; ?>
</div>
<?php endif; ?>
<div id="facets" class="row">
<?php foreach (m('facets') as $facet): ?>
<article class="4u 12u$(mobile)"><details><summary>
<?php echo $facet['field_label']; ?></summary><br/>
<ul>
<?php foreach ($facet['values'] as $value): ?>
<li><a href="<?php echo $value['add_link']; ?>"><?php echo $value['value_label']; ?> (<?php echo $value['count']; ?>)</a></li>
<?php endforeach; ?>
</ul></details>
</article>
<?php endforeach; ?>
</div>

</div>
</div>
</div>
