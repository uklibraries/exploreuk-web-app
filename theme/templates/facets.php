<?php
if (!isset($fc)) {
    $fc = 0;
}
$fc++;
?>
<?php if (count(m('active_facets')) > 0) : ?>
<div id="active_facets_<?= $fc ?>" class="active_facets row">
<ul>
<?php foreach (m('active_facets') as $active) : ?>
<li>
    <a aria-label="Remove <?= $active['value_label'] ?> filter" href="<?= $active['remove_link'] ?>">
        <i class="fas fa-times"></i>
        <?= $active['field_label'] ?>: <?= $active['value_label'] ?> <span class="facet-count">(<?= $active['count'] ?>)</span>
    </a>
</li>
<?php endforeach; ?>
</ul>
</div>
<?php endif; ?>
<div id="facets_<?= $fc ?>" class="facets row">
<?php foreach (m('facets') as $facet) : ?>
<article><details open><summary>
<?= $facet['field_label'] ?></summary><br/>
<ul>
<?php foreach ($facet['values'] as $value) : ?>
<li><a href="<?= $value['add_link'] ?>"><?= euk_brevity($value['value_label'], 40) ?> <span class="facet-count">(<?= $value['count'] ?>)</span></a></li>
<?php endforeach; ?>
</ul>
<p class="more-facets-button">
    <a class="btn" href="#inlinefacets-<?= $facet['field_raw'] ?>" data-lity>More <i class="fas fa-plus-circle"></i></a>
</p>
</details>
</article>
<?php endforeach; ?>
</div>
