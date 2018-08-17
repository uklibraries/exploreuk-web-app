<form action="<?= u('/catalog/') ?>" method="get" id="search">
    <div class="form-group">
        <span><?= get_theme_option('Search Items Count Text') ?></span>
        <span><input aria-label="Search" class="q form-control" type="text" name="q" value="<?= q('q') ?>">
        <span class="input-group-btn"><button type="submit" class="btn btn-default bg-uklblue" value="search">Search</button></span></span>
    </div>

    <div id="featured_image_box"><p id="featured_image_text"><a href="<?= $featured_image['url'] ?>"><?= $featured_image['label'] ?></a></p>

    </div>
</form>
