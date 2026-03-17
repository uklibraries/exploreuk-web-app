<?php foreach ($m['facet_full_lists'] as $list) : ?>
<div id="inlinefacets-<?= $list['field_raw'] ?>" class="more-facets mfp-hide modal-display">
    <h1><?= $list['field_label'] ?></h1>
    <div class="tab-wrap js-tabs">
        <div class="">
            <ul class="tabs js-tablist" id="more-facets-tabs-<?= $list['field_raw'] ?>">
                <li id="more-facets-option-<?= $list['field_raw'] ?>-by-index" class="tab-option js-tablist__item"><a href="#more-facets-list-<?= $list['field_raw'] ?>-by-index" class="js-tablist__link">Sort by <?= $list['field_label'] ?></a></li>
                <li id="more-facets-option-<?= $list['field_raw'] ?>-by-count" class="tab-option js-tablist__item"><a href="#more-facets-list-<?= $list['field_raw'] ?>-by-count" class="js-tablist__link">Sort by Best Match</a></li>
            </ul>
        </div>
        <?php
        $manners = ['by-index', 'by-count'];
        foreach ($manners as $manner) :
            ?>
        <div id="more-facets-list-<?= $list['field_raw'] ?>-<?= $manner ?>" class="js-tabcontent link-group slab">
            <ul class="more-facets-list no-decoration" id="more-facets-<?= $list['field_raw'] ?>-<?= $manner ?>">
                <?php foreach ($list[$manner] as $value) : ?>
                <li><a href="<?= $value['add_link'] ?>"><?= $this->brevity($value['value_label'], 40); ?> <span class="facet-count">(<?= $value['count'] ?>)</span></a></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php endforeach; ?>
    </div>
</div>
<?php endforeach; ?>
