<?php
$p = $m['pagination'];
if (!isset($pc)) {
    $pc = 0;
}
$pc++;
?>
<div class="pagination">

    <div class="rows-select">
        <form action="/catalog" class="per_page" method="get">
            <label for="per_page">Show
                <select class="pagination-rows" id="per_page_<?= $pc ?>" name="per_page" onchange="this.form.submit()" title="Number of results to display per page">
            <?php
                foreach (EUK_PER_PAGE_OPTS as $opt) {
                    if ($this->q('rows') == $opt) {
                        print "<option value=\"$opt\" selected=\"selected\">$opt</option>\n";
                    } else {
                        print "<option value=\"$opt\">$opt</option>\n";
                    }
                }
            ?>
        </select>
            per page
        </label>
        <input name="q" type="hidden" value="<?= htmlspecialchars((string) $this->q('q')) ?>" />
        <input name="offset" type="hidden" value="<?= htmlspecialchars((string) $this->q('offset')) ?>" />
        <?php foreach ($this->hiddenSearchFields() as $field) : ?>
            <input type="hidden" name="<?= $field['name'] ?>" value="<?= htmlspecialchars((string) $field['value']) ?>"/>
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

<?php if (!empty($p['pages'])): ?>
<div class="pagination">
    <ul>
        <?php if ($p['current_page'] > 1): ?>
            <li class="first"><a href="<?= $p['first_page'] ?>">First</a></li>
            <li class="previous"><a href="<?= $p['previous'] ?>">Previous</a></li>
        <?php endif; ?>
        <?php foreach ($p['pages'] as $page): ?>
            <li<?php if ($page['current']): ?> class="current"<?php endif; ?>><a href="<?= $page['link'] ?>"><?= $page['number'] ?></a></li>
        <?php endforeach; ?>
        <?php if ($p['current_page'] < $p['total_pages']): ?>
            <li class="next"><a href="<?= $p['next'] ?>">Next</a></li>
            <li class="last"><a href="<?= $p['last_page'] ?>">Last</a></li>
        <?php endif; ?>
    </ul>
</div>
<?php endif; ?>
