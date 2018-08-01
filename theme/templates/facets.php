<?php if (count(m('active_facets')) > 0): ?>
<div id="active_facets" class="row">
<ul>
<?php foreach (m('active_facets') as $active): ?>
<li>
    <a aria-label="Remove <?php echo $active['value_label']; ?> filter" href="<?php echo $active['remove_link']; ?>">
        <i class="fas fa-times"></i>
        <?php echo $active['field_label']; ?>: <?php echo $active['value_label']; ?> <span class="facet-count">(<?php echo $active['count']; ?>)</span>
    </a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
<div id="facets" class="row">
<?php foreach (m('facets') as $facet): ?>
<article><details open><summary>
<?php echo $facet['field_label']; ?></summary><br/>
<ul>
<?php foreach ($facet['values'] as $value): ?>
<li><a href="<?php echo $value['add_link']; ?>"><?php echo euk_brevity($value['value_label'], 40); ?> <span class="facet-count">(<?php echo $value['count']; ?>)</span></a></li>
<?php endforeach; ?>
</ul></details>
</article>
<?php endforeach; ?>
</div>
