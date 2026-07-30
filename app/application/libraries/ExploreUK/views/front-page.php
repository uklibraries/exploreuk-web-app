<?php require('header.php'); ?>
<main id="main-content">
<!--<div class="resources-section bg-uklblack">-->

<!-- TWIG INCLUDE : @limestone/grid.twig" -->
<div class="slab">
    <div class="slab__wrapper">
        <div class="editorial">
            <h2 class="headline-group">
                <span class="headline-group__head ">Popular Resources</span>
            </h2>
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
                            src="<?= $this->assetPath('images/middlegray.png') ?>"
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

<div class="slab slab--midnight">
    <div class="slab__wrapper">
        <div class="editorial">
            <h2 class="headline-group">
                <span class="headline-group__head ">Additional Resources</span>
            </h2>
        </div>
        <div class="grid grid--3-up">
            <?php foreach ($m['additional_resources'] as $index => $resource) : ?>
                <div class="grid__column">
                    <div class="teaser--midnight">
                    <a href="<?= $resource['url'] ?>" class="teaser__link" aria-labelledby="additional-resource-<?= $index ?>">
                            <div class="teaser__media">
                                <img src="<?= $resource['image'] ?>" alt="" role="presentation"/>
                            </div>
                            <h3 class="headline-group">
                                <span class="headline-group__head" id="additional-resource-<?= $index ?>"><?= $resource['label'] ?> <span class="ic ic--popup" aria-hidden="true"></span></span>
                            </h3>
                        </a>
                        <div class="editorial">
                            <p><?= $resource['description'] ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php //require('additional-resources.php'); ?>
<?php require('sponsors.html'); ?>
</main>
<?php require('global-footer.html'); ?>
<?php require('universal-footer.php'); ?>

