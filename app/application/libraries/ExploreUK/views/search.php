<!-- TWIG INCLUDE : @limestone/split-page-header.twig" -->
<div class="slab slab--light-gray page-header page-header--split"  >
    <div class="page-header--split__hero">
    <!-- TWIG INCLUDE : atoms-image" -->
    <!-- TWIG INCLUDE : @limestone/image.twig" -->
        <img src="<?= $m['featured_image']['image'] ?>" alt="<?= htmlspecialchars((string)$m['featured_image']['label']) ?>" />
    <!-- END TWIG INCLUDE : @limestone/image.twig" -->
    <!-- END TWIG INCLUDE : atoms-image" -->
    </div>
    <div class="slab__wrapper">
        <div class="page-header__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->	
            <h1 id="headline-group660c465ae69fa" class="headline-group ">
                <span class="headline-group__head ">
                    ExploreUK's Collections
                </span>
            </h1>
            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
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
        </div>
    </div>
</div>
<!-- END TWIG INCLUDE : @limestone/split-page-header.twig" -->
