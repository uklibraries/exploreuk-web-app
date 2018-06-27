<?php if (!euk_on_front_page()):
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
<div style="width:100%;">
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
<li><a href="<?php echo $value['add_link']; ?>"><?php echo $value['value_label']; ?> (<?php echo $value['count']; ?>)</a></li>
<?php endforeach; ?>
</ul></details>
</article>
<?php endforeach; ?>
</div>
</div>
</div>
    </div>
<div id="resultsmain">
                   <div id="result_controls"><span id="result_controls_text"><span id="checkerbox"><span id="checker"><i class="fas fa-th"></i>&nbsp;&nbsp;&nbsp;<i class="fas fa-list"></i></span><span id="breadcrumb">&nbsp;you are here: <a href="https://exploreuk.org/omeuk/">home</a> / search results</span></span></span> </div>
        <div class="row">
        <div class="col-md-4">
<p>
<?php if (isset($p['previous'])): ?>
<a href="<?php echo $p['previous']; ?>" class="prev_page">&laquo; Previous</a>
<?php else: ?>
&laquo; Previous
<?php endif; ?>
</p>
        </div>
        <div class="col-md-4">
<p>
<?php echo $p['first'] . ' - ' . $p['last'] . ' of ' . $p['count']; ?>
</p>
        </div>
        <div class="col-md-4">
<p>
<?php if (isset($p['next'])): ?>
<a href="<?php echo $p['next']; ?>" class="next_page">Next &raquo;</a>
<?php else: ?>
<span class="disabled next_page">Next &raquo;</span>
<?php endif; ?>
</p>
        </div>
        </div>
<?php endif; ?>

<?php if (!euk_on_front_page()): ?>
<div class="row">
<?php foreach (m('results') as $r): ?>
<?php if (isset($r['link'])): ?>
<article class="item">
<a href="<?php echo $r['link']; ?>">
<?php if (isset($r['thumb'])): ?>
    <img class="image fit" src="<?php echo $r['thumb']; ?>"/>
<?php endif; ?>
<header>
<h3><?php echo $r['title']; ?></h3>
<dl class="defList">
<?php if (isset($r['source'])): ?>
    <dt class="blacklight-source_s">Collection:</dt>
    <dd class="blacklight-source_s"><?php echo $r['source']; ?></dd>
<?php endif; ?>
<?php if (isset($r['pubdate'])): ?>
    <dt class="blacklight-pubdate">Publication date:</dt>
    <dd class="blacklight-pubdate"><?php echo $r['pubdate']; ?></dd>
<?php endif; ?>
<?php if (isset($r['format'])): ?>
    <dt class="blacklight-format">Format:</dt>
    <dd class="blacklight-format"><?php echo $r['format']; ?></dd>
<?php endif; ?>
</dl>
</header>
</a>
</article>
<?php endif; ?>
<?php endforeach; ?>
</div>
<?php else: ?>
<div class="euk_front_section">
<?php echo get_theme_option('Front Browse Text'); ?>
</div>

<div class="euk_front_section">
<?php echo get_theme_option('Front Page Text'); ?>
</div>
<?php endif; ?>

<?php if (!euk_on_front_page()):
$p = m('pagination');
?>
        <div class="row">
        <div class="col-md-4">
<p>
<?php if (isset($p['previous'])): ?>
<a href="<?php echo $p['previous']; ?>" class="prev_page">&laquo; Previous</a>
<?php else: ?>
&laquo; Previous
<?php endif; ?>
</p>
        </div>
        <div class="col-md-4">
<p>
<?php echo $p['first'] . ' - ' . $p['last'] . ' of ' . $p['count']; ?>
</p>
        </div>
        <div class="col-md-4">
<p>
<?php if (isset($p['next'])): ?>
<a href="<?php echo $p['next']; ?>" class="next_page">Next &raquo;</a>
<?php else: ?>
<span class="disabled next_page">Next &raquo;</span>
<?php endif; ?>
</p>
        </div>
        </div>
        </div>
<?php endif; ?>
