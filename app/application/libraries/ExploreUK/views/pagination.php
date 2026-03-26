<?php
$p = $m['pagination'];
if (!isset($pc)) {
    $pc = 0;
}
$pc++;
?>
<div class="grid grid--major-right search-nav">
    <?php if (!empty($p['pages'])): ?>
    <div class="pagination grid__column--major">
        <nav aria-label="Pagination">
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
        </nav>
    </div>
    <?php endif; ?>
    <div class="result-amount grid__column--minor">
        <div class="rows-select">
            <form action="/catalog" class="per_page" method="get">
                <label for="per_page_<?= $pc ?>">Show
                    <select class="pagination-rows" id="per_page_<?= $pc ?>" name="per_page" onchange="this.form.submit()" title="Number of results to display per page">
                    <?php foreach (EUK_PER_PAGE_OPTS as $opt) : ?>
                        <option value="<?= $opt ?>"<?php if ($this->q('rows') == $opt) : ?> selected="selected"<?php endif; ?>><?= $opt ?></option>
                    <?php endforeach; ?>
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
    </div>
</div>

