<?php foreach (m('facet_full_lists') as $list): ?>
<div id="inlinefacets-<?= $list['field_raw'] ?>" class="more-facets lity-hide">

<h1><?= $list['field_label'] ?></h1>

<div class="tab-wrap">
<div class="tab-nav">

<ul class="tabs" id="more-facets-tabs-<?= $list['field_raw'] ?>">
<li id="more-facets-option-<?= $list['field_raw'] ?>-by-count" class="tab-option active"><a href="#more-facets-list-<?= $list['field_raw'] ?>-by-count">Sort by Relevance</a></li>
<li id="more-facets-option-<?= $list['field_raw'] ?>-by-index" class="tab-option"><a href="#more-facets-list-<?= $list['field_raw'] ?>-by-index">Sort by <?= $list['field_label'] ?></a></li>
</ul>

<?php
$manners = array('by-count', 'by-index');
foreach ($manners as $manner):
?>
<div id="more-facets-list-<?= $list['field_raw'] ?>-<?= $manner ?>" class="tab-content <?= ($manner == 'by-count') ? 'active' : 'hide' ?>">
<ul class="more-facets-list" id="more-facets-<?= $list['field_raw'] ?>-<?= $manner ?>">
<?php foreach ($list[$manner] as $value): ?>
    <li><a href="<?= $value['add_link'] ?>"><?= euk_brevity($value['value_label'], 40); ?> <span class="facet-count">(<?= $value['count'] ?>)</span></a></li>
<?php endforeach; ?>
</ul>
</div>
<?php endforeach; ?>
</div>
</div>
<?php endforeach; ?>
