<form action="<?= $this->path('/catalog/') ?>" method="get" id="search-brief">
    <div class="bg-uklblack form-group-brief">
        <input aria-label="Search" class="q form-control" type="text" name="q" value="<?= $this->q('q') ?>">
        <span class="input-group-btn"></span><button type="submit" class="btn btn-default" value="search">Search</button>
    </div>
</form>
