<div class="slab-series hero">
    <!-- TWIG INCLUDE : @limestone/split-page-header.twig" -->
    <div class="slab slab--light-gray page-header page-header--split"  >
        <!-- TWIG INCLUDE : atoms-image" -->
        <!-- TWIG INCLUDE : @limestone/image.twig" -->
            <figure class="slab">
                <img class="featured-image" src="<?= $m['featured_image']['image'] ?>" alt="<?= htmlspecialchars((string)$m['featured_image']['label']) ?>" />
                <figcaption class="featured-text slab--dark-blue">
                    <a href="<?= $m['featured_image']['url'] ?>" class="link--fancy"><?= $m['featured_image']['label'] ?></a>
                </figcaption>
            </figure>
        <div class="slab__wrapper">
            <div class="page-header__content">
                <!-- TWIG INCLUDE : @limestone/headline-group.twig" --> 
                <h1 id="headline-group660c465ae69fa" class="headline-group ">
                    <span class="headline-group__head ">
                        ExploreUK
                    </span>
                </h1>
                <p>Search archived collections, prints, photographs, maps, manuscripts, streaming video, and more from <a href="https://libraries.uky.edu/locations/special-collections-research-center">UK Special Collections Research Center</a> and <a href="https://libraries.uky.edu/">UK Libraries</a></p>
                <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
                <?php require('search-form.php'); ?>
            </div>
        </div>
    <!-- END TWIG INCLUDE : @limestone/split-page-header.twig" -->
</div>
