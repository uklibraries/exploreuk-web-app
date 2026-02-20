 <form action="<?= $this->path('/catalog/') ?>" method="get" id="search">
    <div class="control-group">
        <!--<span><?= $m['search_items_count_text'] ?></span>-->
        <input aria-label="Search" class="q form-control" type="text" name="q" value="<?= htmlspecialchars((string) $this->q('q')) ?>" placeholder="Search ExploreUK">
        <button type="submit" class="icon-only" value="search">
            <!-- TWIG INCLUDE : @atoms/icon-label.html.twig" -->
            <!-- COMPONENT: @atoms/icon-label.html.twig -->
            <span class="icon-label ">
                <span class="ic ic--magnify" aria-hidden="true"></span>
                <span class="label ">search</span>
            </span>
            <!-- END TWIG INCLUDE : @atoms/icon-label.html.twig" -->                    
        </button>
    </div>
</form>