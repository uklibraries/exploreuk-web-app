<form action="<?= $this->path('/catalog/') ?>" method="get" id="search">
    <div class="form-group">
        <span><?= $m['search_items_count_text'] ?></span>
        <span><input aria-label="Search" class="q form-control" type="text" name="q" value="<?= htmlspecialchars((string) $this->q('q')) ?>">
        <span class="input-group-btn"><button type="submit" class="btn btn-default bg-uklblue" value="search">Search</button></span></span>
    </div>

    <div id="featured_image_box"><p id="featured_image_text"><a href="<?= $m['featured_image']['url'] ?>"><?= $m['featured_image']['label'] ?></a></p>

    </div>
</form>
