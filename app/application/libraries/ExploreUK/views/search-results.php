<?php require 'header.php'; ?>
<?php
$m['current_page_title'] = !empty($m['q'])
    ? 'Search results for &ldquo;' . htmlspecialchars((string) $m['q']) . '&rdquo;'
    : 'All Items';
?>
<main id="main-content">
<div class="slab search-nav">
    <div class="slab__wrapper">
        <?php require 'breadcrumbs.php'; ?>
    </div>
</div>
<div class="slab slab--thin">
    <div class="slab__wrapper">
        <h1 class="headline-group">
            <span class="headline-group__head">
                <?php if (!empty($m['q'])) :?>
                Search results for &ldquo;<?= htmlspecialchars((string) $m['q']) ?>&rdquo;
                <?php else :
                    ?>All Items
                <?php endif; ?>
            </span>
        </h1>
    </div>
</div>
<div class="slab">
    <div class="slab__wrapper">
        <?php require 'pagination.php'; ?>
        <div class="grid grid--major-right">
            <div id="facet_group_mobile" class="section-nav grid__column grid__column--minor">
                <div id="facet_group_mobile_top">
                    <h2><?= $m['facet_menu_title'] ?></h2>
                    <?php require 'facets.php'; ?>
                </div>
            </div>
            <div class="item-list grid__column grid__column--major">
                <!-- TWIG INCLUDE : components-teaser" -->
                <!-- TWIG INCLUDE : @limestone/teaser.twig" -->
                <?php foreach ($m['results'] as $r) : ?>
                    <div class="teaser teaser--event teaser--blue-gray">
                        <a href="<?= $r['link'] ?>" class="teaser__link">
                            <?php if (isset($r['thumb'])) : ?>
                                <div class="teaser__media">
                                    <img src="<?= $r['thumb'] ?>" alt="" class="" />
                                </div>
                            <?php else : ?>
                                <span class="teaser__media">No image available</span>
                            <?php endif; ?>
                            <h3 class="headline-group">
                                <span class="headline-group__head"><?= $this->brevity($r['title']) ?></span>
                            </h3>
                        </a>
                        <div class="content-meta">
                                <div class="content-meta__who-when">
                                    <?php if (isset($r['source'])) : ?>
                                        <div class="meta-row">
                                            <span class="field-label">Collection:</span>
                                            <?php if (is_array($r['source'])) : ?>
                                                <?php foreach ($r['source'] as $source) : ?>
                                                    <a href="<?= $this->path('/?f%5Bsource_s%5D%5B%5D=' . urlencode($source)) ?>"><?= $source ?></a>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <a href="<?= $this->path('/?f%5Bsource_s%5D%5B%5D=' . urlencode($r['source'])) ?>"><?= $r['source'] ?></a>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="meta-row">
                                        <span class="field-label">Date:</span>
                                        <?php if (isset($r['pubdate_display'])) : ?>
                                            <?php if (is_array($r['pubdate_display'])) : ?>
                                                <?php foreach ($r['pubdate_display'] as $date) : ?>
                                                    <span class="date"><?= $date ?></span>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <span class="date"><?= $r['pubdate_display'] ?></span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span class="date">date unknown</span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (isset($r['format'])) : ?>
                                        <div class="meta-row">
                                            <span class="field-label">Format:</span>
                                            <?php if (is_array($r['format'])) : ?>
                                                <?php foreach ($r['format'] as $format) : ?>
                                                    <span class="byline"><?= $format ?></span>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <span class="byline"><?= $r['format'] ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                    </div>
                    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->
                    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->
                <?php endforeach; ?>
            </div>
        </div>
        <?php require 'pagination.php'; ?>
    </div>
</div>
<?php require 'more-facets.php'; ?>
</main>
<?php require 'global-footer.html'; ?>
<?php require 'universal-footer.php'; ?>
