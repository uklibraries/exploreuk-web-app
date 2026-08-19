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
<div class="slab slab--thin">
    <div class="slab__wrapper">
        <?php require 'pagination.php'; ?>
    </div>
</div>
<div class="slab">
    <div class="slab__wrapper">
        <div class="grid grid--major-right">
            <div id="facet_group_mobile" class="section-nav grid__column grid__column--minor">
                <div id="facet_group_mobile_top">
                    <h2><?= $m['facet_menu_title'] ?></h2>
                    <?php require 'facets.php'; ?>
                </div>
            </div>
            <div class="grid__column grid__column--major">
                <div class="item-list">
                    <?php foreach ($m['results'] as $r) : ?>
                        <div class="teaser teaser--news teaser--blue-gray">
                            <?php if (isset($r['thumb'])) : ?>
                                <div class="teaser__media">
                                    <a href="<?= $r['link'] ?>" aria-hidden='true' tabindex='-1'>
                                        <img src="<?= $r['thumb'] ?>" alt="<?= $this->brevity($r['title']) ?>" class="" />
                                    </a>
                                </div>
                            <?php else : ?>
                                <span class="teaser__media">No image available</span>
                            <?php endif; ?>
                            <div class="teaser-content">
                                <h3 class="headline-group">
                                    <span class="headline-group__head">
                                        <a href="<?= $r['link'] ?>" class="underline-link">
                                            <?= $this->brevity($r['title']) ?>
                                        </a>
                                    </span>
                                </h3>
                                <div class="content-meta">
                                    <dl class="described-links">
                                        <?php if (isset($r['source'])) : ?>
                                            <dt>Collection</dt>
                                            <dd class="taxonomy-list">
                                                <?php if (is_array($r['source'])) : ?>
                                                    <?php foreach ($r['source'] as $source) : ?>
                                                        <a href="<?= $this->path('/?f%5Bsource_s%5D%5B%5D=' . urlencode($source)) ?>"><?= $source ?></a>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <a href="<?= $this->path('/?f%5Bsource_s%5D%5B%5D=' . urlencode($r['source'])) ?>"><?= $r['source'] ?></a>
                                                <?php endif; ?>
                                            </dd>
                                        <?php endif; ?>
                                            <dt>Date</dt>
                                                <?php if (isset($r['pubdate_display'])) : ?>
                                                    <?php if (is_array($r['pubdate_display'])) : ?>
                                                        <?php foreach ($r['pubdate_display'] as $date) : ?>
                                                            <dd><?= $date ?></dd>
                                                        <?php endforeach; ?>
                                                    <?php else : ?>
                                                        <dd><?= $r['pubdate_display'] ?></dd>
                                                    <?php endif; ?>
                                                <?php else : ?>
                                                    <dd>Date unknown</dd>
                                                <?php endif; ?>
                                            <?php if (isset($r['format'])) : ?>
                                                <dt>Format</dt>
                                                <?php if (is_array($r['format'])) : ?>
                                                    <?php foreach ($r['format'] as $format) : ?>
                                                        <dd><?= $format ?></dd>
                                                    <?php endforeach; ?>
                                                <?php else : ?>
                                                    <dd><?= $r['format'] ?></dd>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </dl>
                                </div>    
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="slab slab--thin">
    <div class="slab__wrapper">
        <?php require 'pagination.php'; ?>
    </div>
</div>
<?php require 'more-facets.php'; ?>
</main>
<?php require 'global-footer.html'; ?>
<?php require 'universal-footer.php'; ?>
