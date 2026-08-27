 <form action="<?= $this->path('/catalog/') ?>" method="get" id="search" class="search-form">
    <div class="control-group">
        <input aria-label="Search" class="q form-control" type="text" name="q" value="<?= htmlspecialchars((string) $this->q('q')) ?>" placeholder="Search ExploreUK">
        <button type="submit" class="icon-only" value="search">
            <span class="icon-label">
                <span class="ic ic--magnify" aria-hidden="true"></span>
                <span class="label ">search</span>
            </span>
        </button>
    </div>
</form>
