<?php require 'header.php'; ?>
<?php
$p = $m['pagination'];
?>
<div id="facet_group_mobile">
    <div id="facet_group_mobile_top">
        <details id="facet_group_mobile_container" class="facet-menu-mobile bg-uklwhite row">
            <summary id="facet_group_mobile_head"><?= $m['facet_menu_title'] ?></summary>
            <?php require 'facets.php'; ?>
        </details>
    </div>
</div>
<div class="item-list">
    <!-- TWIG INCLUDE : components-teaser" -->
    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->
    <?php foreach($m['results'] as $r): ?>
        <div class="teaser teaser--event teaser--blue-gray">
            <?php if (isset($r['thumb'])) : ?>
                <div class="teaser__media">
                    <a href="<?= $r['link'] ?>">
                        <!-- TWIG INCLUDE : @limestone/image.twig" -->
                        <img src="<?= $r['thumb'] ?>" alt="<?= $r['title'] ?>" class="" />
                        <!-- END TWIG INCLUDE : @limestone/image.twig" -->
                    </a>
                </div>
            <?php else : ?>
                <span class="teaser__media">No image available</span>
            <?php endif; ?>
            <div class="teaser__content">
                <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
                <h3 id="headline-group660c465b60c30" class="headline-group ">
                        <span class="headline-group__head ">
                        <!-- TWIG INCLUDE : @limestone/link.twig" -->
                        <a href="<?= $r['link'] ?>" class="underline-link"><?= $this->brevity($r['title']) ?></a>
                        <!-- END TWIG INCLUDE : @limestone/link.twig" -->
                    </span>
                    <span class="headline-group__sub">
                        <?php if (isset($r['source'])) : ?>
                            <?php if (is_array($r['source'])) : ?>
                                <?php foreach($r['source'] as $source) : ?>
                                    <a href="<?= $this->path('/?f%5Bsource_s%5D%5B%5D=' . urlencode($source)) ?>"><?= $source ?></a>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <a href="<?= $this->path('/?f%5Bsource_s%5D%5B%5D=' . urlencode($r['source'])) ?>"><?= $r['source'] ?></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </span>
                </h3>
                <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
                <div class="content-meta">
                    <div class="content-meta__who-when">
                        <?php if (isset($r['pubdate_display'])) : ?>
                            <?php if(is_array($r['pubdate_display'])) : ?>
                                <?php foreach($r['pubdate_display'] as $date) : ?>
                                    <span class="date"><?= $date ?></span>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="date"><?= $r['pubdate_display'] ?></span>
                            <?php endif; ?>
                        <?php else : ?>
                            <span class="date">date unknown</span>
                        <?php endif; ?>
                        <?php if (isset($r['format'])) : ?>
                            <?php if (is_array($r['format'])) : ?>
                                <?php foreach($r['format'] as $format) : ?>
                                    <span class="byline"><?= $format ?></span>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <span class="byline"><?= $r['format'] ?></span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->
        <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->
    <?php endforeach; ?>
    <?php require 'pagination.php' ?>
</div>
<?php require 'more-facets.php' ?>
<?php require 'universal-footer.php' ?>
