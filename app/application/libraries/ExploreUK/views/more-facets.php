<?php foreach ($m['facet_full_lists'] as $list) : ?>
<div id="inlinefacets-<?= $list['field_raw'] ?>" class="more-facets mfp-hide modal-display">
    <h3><?= $list['field_label'] ?></h3>
    <div class="tab-wrap js-tabs">
        <div class="">
            <ul class="tabs js-tablist" id="more-facets-tabs-<?= $list['field_raw'] ?>">
                <li id="more-facets-option-<?= $list['field_raw'] ?>-by-index" class="tab-option js-tablist__item"><?= $this->renderLink([
                    'href' => '#more-facets-list-' . $list['field_raw'] . '-by-index',
                    'content' => 'Filter by ' . $list['field_label'],
                    'classes' => 'js-tablist__link',
                    'id' => 'label_more-facets-list-' . $list['field_raw'] . '-by-index',
                ]) ?></li>
                <li id="more-facets-option-<?= $list['field_raw'] ?>-by-count" class="tab-option js-tablist__item"><?= $this->renderLink([
                    'href' => '#more-facets-list-' . $list['field_raw'] . '-by-count',
                    'content' => 'Filter by Best Match',
                    'classes' => 'js-tablist__link',
                    'id' => 'label_more-facets-list-' . $list['field_raw'] . '-by-count',
                ]) ?></li>
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
