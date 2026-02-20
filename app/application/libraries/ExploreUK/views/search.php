<div class="slab-series">
    <!-- TWIG INCLUDE : @limestone/split-page-header.twig" -->
    <div class="slab slab--light-gray page-header page-header--split"  >
        <!-- TWIG INCLUDE : atoms-image" -->
        <!-- TWIG INCLUDE : @limestone/image.twig" -->
            <img src="<?= $m['featured_image']['image'] ?>" alt="<?= htmlspecialchars((string)$m['featured_image']['label']) ?>" />
        <!-- END TWIG INCLUDE : @limestone/image.twig" -->
        <!-- END TWIG INCLUDE : atoms-image" -->
        <div class="slab__wrapper">
            <div class="slab-series__next">
                <a href="<?= $m['featured_image']['url'] ?>" class="link--fancy"><?= $m['featured_image']['label'] ?></a>
            </div>
            <div class="page-header__content">
                <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->	
                <h1 id="headline-group660c465ae69fa" class="headline-group ">
                    <span class="headline-group__head ">
                        ExploreUK
                    </span>
                </h1>
                <p>Search 530,000+ digitized collections, prints, photographs, maps, manuscripts, streaming video, and more.</p>
                <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
                <?php require('search-form.php'); ?>
            </div>
        </div>
    <!-- END TWIG INCLUDE : @limestone/split-page-header.twig" -->
</div>
