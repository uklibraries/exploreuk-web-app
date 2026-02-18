<!-- TWIG INCLUDE : @limestone/cta-group.twig" -->
<div class="cta-group">
    <!-- TWIG INCLUDE : @limestone/search-form.twig" -->
    <form method="get" action="<?= $this->path('/catalog/') ?>" id="search" class="search-form">
        <label for="search-keywords660c465ba79a9">Search ExploreUK</label>
        <div class="control-group">
            <input type="text"
                id="search-keywords660c465ba79a9"
                name="q"
                class="input-text"
                value="<?= htmlspecialchars((string) $this->q('q')) ?>"
            />
            <button class="icon-only">
                <!-- TWIG INCLUDE : @limestone/icon-label.twig" -->
                <span class="icon-label">
                    <span class="ic ic--magnify" aria-hidden="true"></span>
                    <span class="label">search</span>
                </span>
                <!-- END TWIG INCLUDE : @limestone/icon-label.twig" -->
            </button>
        </div>
    </form>
    <!-- END TWIG INCLUDE : @limestone/search-form.twig" -->
</div>
<!-- END TWIG INCLUDE : @limestone/cta-group.twig" -->

