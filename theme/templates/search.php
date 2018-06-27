<form action="<?php echo u('/catalog/'); ?>" method="get">
    <div class="form-group">
        <input class="q form-control" type="text" name="q" value="<?php echo q('q'); ?>">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" value="search">Search</button></span>
        &nbsp;<span  data-tooltip="Search for a specific phrase by surrounding it in quotation marks."><i class="fas fa-info-circle" id="app"></i></span>

    <div id="browse_facet_top_page_button"><span id="browse_facet_label"><?php echo get_theme_option('Browse Content Button Text'); ?></span></div>
    <div id="featured_collections"><span id="featured_collections_box"><div id="featured_collections_content">Featured Collections:<ul id="featured_collections_text">
<?php
foreach ($featured_collections as $s_id => $s_label):
?>
    <li>&odot;&nbsp;&nbsp;<a href="<?php echo $findaidurl . $s_id; ?>"><?php echo $s_label; ?></a></li>
<?php
endforeach;
?>
    </ul>

    </div></span></div>

    </div>

    <div id="featured_image_box"><p id="featured_image_text">Featured Image: <a href="<?php echo $random_collection['url']; ?>"><?php echo $random_collection['label']; ?></a></p>

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
