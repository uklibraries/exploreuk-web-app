<?php
if (!isset($pc)) {
    $pc = 0;
}
$pc++;
?>
<div class="result-amount">
    <div class="rows-select">
        <form action="/catalog" class="per_page" method="get">
            <label for="per_page_<?= $pc ?>">Show
                <select class="pagination-rows" id="per_page_<?= $pc ?>" name="per_page" onchange="this.form.submit()" title="Number of results to display per page">
                <?php foreach (EUK_PER_PAGE_OPTS as $opt) : ?>
                    <option value="<?= $opt ?>"<?php if ($this->q('rows') == $opt) :
                        ?> selected="selected"<?php
                                   endif; ?>><?= $opt ?></option>
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
