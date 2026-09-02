<div class="slab-series hero">
    <div class="slab slab--light-gray page-header page-header--split"  >
            <figure class="slab">
                <img class="featured-image" src="<?= $m['featured_image']['image'] ?>" alt="<?= htmlspecialchars((string)$m['featured_image']['label']) ?>" />
                <figcaption class="featured-text slab--dark-blue">
                    <?= $this->renderLink([
                        'href' => $m['featured_image']['url'],
                        'content' => $m['featured_image']['label'],
                        'classes' => 'link--fancy',
                    ]) ?>
                </figcaption>
            </figure>
        <div class="slab__wrapper">
            <div class="page-header__content">
                <h1 id="headline-group660c465ae69fa" class="headline-group ">
                    <span class="headline-group__head ">
                        ExploreUK
                    </span>
                </h1>
                <p>
                  Search archived collections, prints, photographs, maps, manuscripts, streaming video, and more from
                  <?= $this->renderLink(['href' => 'https://libraries.uky.edu/locations/special-collections-research-center', 'content' => 'UK Special Collections Research Center', 'external' => true]) ?>
                  and
                  <?= $this->renderLink(['href' => 'https://libraries.uky.edu/', 'content' => 'UK Libraries', 'external' => true]) ?>
                </p>
                <?php require('search-form.php'); ?>
            </div>
        </div>
</div>
