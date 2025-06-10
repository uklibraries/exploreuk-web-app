<?php require('header.php'); ?>
<div id="primary">
    <p id="simple-pages-breadcrumb"><a href="/">Home</a> &gt; <?= $m['page_title'] ?></p>
    <h1><?= $m['page_title'] ?></h1>
    <?= $m['page']->text ?>
</div>
<?php require('footer.php'); ?>
