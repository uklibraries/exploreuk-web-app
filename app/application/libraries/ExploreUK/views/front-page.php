<?php require('header.php'); ?>
<div class="resources-section bg-uklblack">

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
                        <div class="teaser__media">
                            <a href="<?= $resource['url'] ?>">
                                <img src="<?= $resource['image'] ?>" alt="<?= htmlspecialchars((string)$resource['label']) ?>"/>
                            </a>
                        </div>
                        <div class="teaser__content">
                            <h3 class="headline-group ">
                                <span class="headline-group__head">
                                    <a href="<?= $resource['url'] ?>" class="underline-link" id="additional-resource-<?= $index ?>">
                                        <?= $resource['label'] ?>
                                    </a>
                                </span>
                            </h3>
                            <div class="editorial">
					            <p>SPOKEdb currently provides access to 19892 interview records, and 765 projects.</p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php //require('additional-resources.php'); ?>
<?php require('sponsors.php'); ?>
<?php require('global-footer.php'); ?>
<?php require('universal-footer.php'); ?>

