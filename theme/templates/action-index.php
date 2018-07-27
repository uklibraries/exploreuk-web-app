<?php
$p = m('pagination');
?>
<div id="facet_group_mobile">
    <div id="facet_group_mobile_top">
<div class="bg-uklblue" id="facet_group_mobile_container"><span id="facet_group_mobile_head">Limit Your Search</span></div>
<?php if (count(m('active_facets')) > 0): ?>
<div id="active_facets" class="row">
<?php foreach (m('active_facets') as $active): ?>
<article class="4u 12u$(mobile)">
<details><summary><?php echo $active['field_label']; ?></summary>
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
<div class="results">
    <div id="resultsfacets">
<div id="facet_group">
<div id="facet_group_left">
<div class="bg-uklblue" id="facet_group_left_container"><span id="facet_group_left_head">Limit Your Search</span></div>
<?php if (count(m('active_facets')) > 0): ?>
<div id="active_facets" class="row">
<?php foreach (m('active_facets') as $active): ?>
<article class="4u 12u$(mobile)">
<details><summary><?php echo $active['field_label']; ?></summary>
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
<li><a href="<?php echo $value['add_link']; ?>"><?php echo $value['value_label']; ?> <span class="facet-count">(<?php echo $value['count']; ?>)</span></a></li>
<?php endforeach; ?>
</ul></details>
</article>
<?php endforeach; ?>
</div>
</div>
</div>
    </div>
<div id="resultsmain">
<?php require("pagination.php"); ?>

<div class="row">
<ul>
<?php foreach (m('results') as $r): ?>
<li class="result-item">
    <?php if (isset($r['thumb'])): ?>
    <a class="image-placeholder" href="<?php echo $r['link']; ?>">
        <img src="<?php echo $r['thumb']; ?>" title="<?php echo $r['title']; ?>">
    </a>
    <?php else: ?>
    <div class="image-placeholder"></div>
    <?php endif; ?>
    <div class="result-summary">
        <h3><?php echo $r['number']; ?>. <a href="<?php echo $r['link']; ?>"><?php echo euk_brevity($r['title']); ?></a></h3>
        <ul class="result-metadata">
            <?php if (isset($r['source'])): ?>
                <li><span class="result-metadata-label">Collection:</span>
                <?php echo $r['source']; ?></li>
            <?php endif; ?>

            <?php if (isset($r['pubdate'])): ?>
                <li><span class="result-metadata-label">Publication date:</span>
                <?php echo $r['pubdate']; ?></li>
            <?php endif; ?>

            <?php if (isset($r['format'])): ?>
                <li><span class="result-metadata-label">Format:</span>
                <?php echo $r['format']; ?></li>
            <?php endif; ?>
        </ul>
    </div>
</li>
<?php endforeach; ?>
</ul>
</div>

<?php require("pagination.php"); ?>
        </div>
