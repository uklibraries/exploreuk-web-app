<form action="<?= $this->path('/catalog/') ?>" method="get" id="search-brief">
    <div class="bg-uklblack form-group-brief">
        <input aria-label="Search" class="q form-control" type="text" name="q" value="<?= htmlspecialchars((string) $this->q('q')) ?>">
        <span class="input-group-btn"></span><button type="submit" class="btn btn-default" value="search">Search</button>
    </div>
<?php foreach ($this->hiddenSearchFields() as $field) : ?>
    <input type="hidden" name="<?= $field['name'] ?>" value="<?= htmlspecialchars((string) $field['value']) ?>"/>
<?php endforeach; ?>
</form>
