<?php require('header.php'); ?>
<div class="resources-section bg-uklblack">

<!-- TWIG INCLUDE : @limestone/grid.twig" -->
<div class="slab">
    <div class="slab__wrapper">
        <div class="editorial">
            <!-- TWIG INCLUDE : molecules-headline-group" -->
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h2 class="headline-group">
                <span class="headline-group__head ">Popular Resources</span>
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
            <h2 class="headline-group ">
                <span class="headline-group__head ">Additional Resources</span>
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


<?php require('sponsors.php'); ?>
<?php require('global-footer.php'); ?>
<?php require('universal-footer.php'); ?>

