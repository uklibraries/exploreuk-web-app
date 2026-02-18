<?php require('header.php'); ?>
<div class="resources-section bg-uklblack">

<!-- TWIG INCLUDE : @limestone/grid.twig" -->
<div class="slab "  >
    <div class="slab__wrapper">
        <div class="editorial">
            <!-- TWIG INCLUDE : molecules-headline-group" -->
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h2 id="headline-group660c465a3fe75" class="headline-group ">
                <span class="headline-group__super">Special Collections Resources Center</span>
                <span class="headline-group__head ">
                    <!-- TWIG INCLUDE : @limestone/link.twig" -->
                    <span class="underline-link">Popular Resources</span>
                    <!-- END TWIG INCLUDE : @limestone/link.twig" -->
                </span>
                <span class="headline-group__sub">view by format</span>
            </h2>
            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <!-- END TWIG INCLUDE : molecules-headline-group" -->
        </div>
        <ul class="grid grid--4-up ">
            <?php foreach ($m['popular_resources'] as $index => $resource) : ?>
                <li class="grid__column">
                    <a
                        aria-label="<?= $resource['label'] ?>"
                        id="popular-resource-<?= $index ?>"
                        href="<?= $resource['url'] ?>"
                        target="_blank"
                        rel="noopener"
                    >
                        <img
                            class="lazy"
                            src="<?= $this->themePath('images/middlegray.png') ?>"
                            data-src="<?= $resource['image'] ?>"
                            title="<?= $resource['label'] ?>"
                            alt="<?= htmlspecialchars((string)$resource['label']) ?>"
                        >
                            <span class="popular-card__label"><?= htmlspecialchars((string)$resource['label']) ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<!-- END TWIG INCLUDE : @limestone/grid.twig" -->
<div class="slab slab--blue-gray"  >
    <div class="slab__wrapper">
        <div class="editorial">
            <!-- TWIG INCLUDE : molecules-headline-group" -->
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h2 id="headline-group660c465a3fe75" class="headline-group ">
                <span class="headline-group__super">Special Collections Resources Center</span>
                <span class="headline-group__head ">
                    <!-- TWIG INCLUDE : @limestone/link.twig" -->
                    <span class="underline-link">Additional Resources</span>
                    <!-- END TWIG INCLUDE : @limestone/link.twig" -->
                </span>
                <span class="headline-group__sub">view other sites by the Libraries</span>
            </h2>
            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <!-- END TWIG INCLUDE : molecules-headline-group" -->
        </div>
        <ul class="grid grid--3-up ">
            <?php foreach ($m['additional_resources'] as $index => $resource) : ?>
                <li class="grid__column">
                    <a
                        aria-label="<?= $resource['label'] ?>"
                        id="additional-resource-<?= $index ?>"
                        href="<?= $resource['url'] ?>"
                        target="_blank"
                        rel="noopener"
                    >
                        <img
                            class="lazy"
                            src="<?= $this->themePath('images/middlegray.png') ?>"
                            data-src="<?= $resource['image'] ?>"
                            title="<?= $resource['label'] ?>"
                            alt="<?= htmlspecialchars((string)$resource['label']) ?>"
                        >
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
<!-- END TWIG INCLUDE : @limestone/grid.twig" -->


<style type="text/css">
:root {
/* colors */
    --wildcat-blue: #0033a0;
    --wildcat-white: #fff;
    --warm-neutral-60: #efebe2;
}

#top > div {
    background-image:url(<?= $m['featured_image']['image'] ?>);
    height: 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

.section {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}

.popular-resources {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}

.additional-resources {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
    background: var(--warm-neutral-60);
}

.popular-resources > li {
    width: 160px;
    height: 240px;
    margin: 1rem;
    background: #ffffff;
}

.popular-resources > li > a {
    width: 100%;
    height: 100%;
    position: relative;
}

.popular-card__label {
    color: #ffffff;
    background-color: color-mix(in srgb, var(--wildcat-blue), transparent 30%);
    position: absolute;
    width: 100%;
    height: 33%;
    margin: 0;
    bottom: 0;
    font-size: 1.6rem;
    line-height: 2.5rem;
    font-weight: 300;
    display: flex;
    flex-direction: column;
    justify-content: center;
    text-align: center;
}

@media all and (min-width: 440px) {
    .additional-resources > li {
        width: 420px;
        height: 120px;
    }
}

.additional-resources > li > a,
.additional-resources > li > a > img {
    width: 100%;
    height: 100%;
}

.grid {
    list-style: none;
    padding: 0;
    margin: 0;
}

.grid.grid--4-up .grid__column {
    min-width: 160px;
    min-height: 240px;
    background: #fff;
}

.grid.grid--4-up .grid__column > a {
    display: block;
    position: relative;
    width: 100%;
    height: 100%;
    overflow: hidden;
}

.grid.grid--4-up .grid__column img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

</style>

<?php require('sponsors.php'); ?>
<?php require('footer.php'); ?>

