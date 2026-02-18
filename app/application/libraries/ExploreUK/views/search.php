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
            <?php require('search-form.php'); ?>
        </div>
    </div>
</div>
<!-- END TWIG INCLUDE : @limestone/split-page-header.twig" -->
