<?php
$p = $m['pagination'];
if (!isset($pc)) {
    $pc = 0;
}
$pc++;
?>
<div class="row pagination">

<div class="rows-select">
<form action="/catalog" class="per_page" method="get">
<label for="per_page">Show <select class="pagination-rows" id="per_page_<?= $pc ?>" name="per_page" onchange="this.form.submit()" title="Number of results to display per page">
<?php
foreach (EUK_PER_PAGE_OPTS as $opt) {
    if ($this->q('rows') == $opt) {
        print "<option value=\"$opt\" selected=\"selected\">$opt</option>\n";
    } else {
        print "<option value=\"$opt\">$opt</option>\n";
    }
}
?>
</select> per page</label>
<input name="q" type="hidden" value="<?= htmlspecialchars($this->q('q')) ?>" />
<input name="offset" type="hidden" value="<?= htmlspecialchars($this->q('offset')) ?>" />
<?php foreach ($this->hiddenSearchFields() as $field) : ?>
    <input type="hidden" name="<?= $field['name'] ?>" value="<?= htmlspecialchars($field['value']) ?>"/>
<?php endforeach; ?>
    <noscript><input name="commit" type="submit" value="update" /></noscript>
</form>
</div>

<div class="page-navigation">
<p>
<?php if (isset($p['previous'])) : ?>
    <a href="<?= $p['previous'] ?>" class="prev_page">&laquo; Previous</a>
<?php else : ?>
    &laquo; Previous
<?php endif; ?> |
<?= '<strong>' . $p['first'] . '</strong> - <strong>' . $p['last'] . '</strong> of <strong>' . $p['count'] . '</strong>' ?> |
<?php if (isset($p['next'])) : ?>
    <a href="<?= $p['next'] ?>" class="next_page">Next &raquo;</a>
<?php else : ?>
    <span class="disabled next_page">Next &raquo;</span>
<?php endif; ?>
</p>
</div>

</div>
