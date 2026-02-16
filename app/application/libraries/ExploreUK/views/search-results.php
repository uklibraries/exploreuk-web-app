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
<div class="results">
    <div id="resultsfacets" class="resultsfacets has-results">
        <div id="facet_group">
            <div id="facet_group_left">
                <div class="bg-uklblue" id="facet_group_left_container">
                    <span id="facet_group_left_head"><?= $m['facet_menu_title'] ?></span>
                </div>
                <?php require 'facets.php'; ?>
            </div>
        </div>
    </div>
    <div id="resultsmain">
        <?php require 'pagination.php'; ?>
        <div class="row">
            <ul class="result-list">
                <?php foreach ($m['results'] as $r) : ?>
                <li class="result-item">
                    <p class="result-number"><?= $r['number'] ?>.</p>
                    <div class="result-summary">
                        <?php if (isset($r['thumb'])) : ?>
                        <a class="image-placeholder" href="<?= $r['link'] ?>"<?= $r['target'] ?>
                            aria-label="<?= $r['title'] ?>">
                            <img class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>"
                                data-src="<?= $r['thumb'] ?>" alt="<?= $r['title'] ?>" title="<?= $r['title'] ?>">
                        </a>
                        <?php elseif (isset($r['format']) && isset(EUK_FORMAT_ICONS[$r['format']])) : ?>
                        <a class="image-placeholder" href="<?= $r['link'] ?>"<?= $r['target'] ?>
                            aria-label="<?= $r['title'] ?>"><i
                                class="fas fa-<?= EUK_FORMAT_ICONS[$r['format']] ?> fa-7x"></i></a>
                        <?php else : ?>
                        <div class="image-placeholder"></div>
                        <?php endif; ?>
                        <h3><a href="<?= $r['link'] ?>"<?= $r['target'] ?>><?= $this->brevity($r['title']) ?></a></h3>
                        <ul class="result-metadata">
                            <?php foreach (EUK_RESULT_FACET_ORDER as $field) : ?>
                            <?php if (isset($r[$field])) : ?>
                            <?php $label = EUK_LOCALE['en'][EUK_HIT_FIELDS[$field]]; ?>
                            <?php if (in_array($field, EUK_RESULT_DROP_FIELDS)) : ?>
                            <?php $lclass = ' class="result-metadata-drop"'; ?>
                            <?php else : ?>
                            <?php $lclass = ''; ?>
                            <?php endif; ?>
                            <?php if (is_array($r[$field])) : ?>
                            <?php foreach ($r[$field] as $entry) : ?>
                            <li<?= $lclass ?>><span class="result-metadata-label"><?= $label ?>:</span>
                                <?= $entry ?>
                </li>
                <?php endforeach; ?>
                <?php else : ?>
                <li<?= $lclass ?>><span class="result-metadata-label"><?= $label ?>:</span>
                    <?= $r[$field] ?></li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
            </ul>
        </div>
        </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php require 'pagination.php'; ?>
</div>
</div>
<?php require 'more-facets.php'; ?>
<?php require 'footer.php'; ?>

<?php require 'header.php'; ?>
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
<?php require 'footer.php' ?>
