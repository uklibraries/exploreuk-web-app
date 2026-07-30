<?php
require('header.php'); ?>
<?php $m['current_page_title'] = $m['page_title']; ?>
<main id="main-content">
<div class="slab slab--thin">
    <div class="slab__wrapper">
        <?php require('breadcrumbs.php'); ?>
    </div>
</div>
<div id="primary" class="slab">
    <div class="slab__wrapper">
        <h1><?= $m['page_title'] ?></h1>
        <?= $m['page']->text ?>
    </div>
</div>
</main>
<?php require('global-footer.html'); ?>
<?php require('universal-footer.php'); ?>
