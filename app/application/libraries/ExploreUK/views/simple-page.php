<?php require('header.php'); ?>
<div id="primary" class="slab">
    <div class="slab__wrapper">
        <p id="simple-pages-breadcrumb"><a href="/">Home</a> &gt; <?= $m['page_title'] ?></p>
        <h1><?= $m['page_title'] ?></h1>
        <?= $m['page']->text ?>
    </div>
</div>
<?php require('global-footer.html'); ?>
<?php require('universal-footer.php'); ?>
