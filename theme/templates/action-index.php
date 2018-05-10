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
<?php echo get_theme_option('Front Page Text'); ?>
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
<?php endif; ?>
