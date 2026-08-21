<?php
    require('header.php'); ?>
<?php $m['current_page_title'] = $m['page_title']; ?>

<div class="slab slab--wildcat-white page-header page-header--text">
    <div class="slab__wrapper">
        <h1 class="headline-group">
            <span class="headline-group__head">
                <?= $m['page_title'] ?>
            </span>
        </h1>
    </div>
</div>

<?php require('breadcrumbs.php'); ?>

<main id="main-content">
    <div id="primary" class="slab">
        <div class="slab__wrapper">
            <div class="editorial">
                <?= $m['page']->text ?>
            </div>
        </div>
    </div>
</main>

<?php require('global-footer.html'); ?>
<?php require('universal-footer.php'); ?>
