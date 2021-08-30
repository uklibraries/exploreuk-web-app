<?php require('header.php'); ?>

<div class="search-and-item-control-row bg-uklgray">
<div class="search-and-item-control-container">

</div>
</div>

<div class="item-container">
<main class="item-presentation">

<div class="page-title bg-uklgray">
<h2>ExploreUK statistics</h2>

<h3>Leaves</h3>
<ul>
<li><b>Total:</b> <?= $m['stats']['leaf']['count'] ?></li>
<?php
foreach ($m['stats']['leaf']['count_by_type'] as $type => $count):
?>
<li><?= $type ?>: <?= $count ?></li>
<?php
endforeach;
?>
</ul>

<h3>Sections</h3>
<ul>
<li><b>Total:</b> <?= $m['stats']['section']['count'] ?></li>
<?php
foreach ($m['stats']['section']['count_by_type'] as $type => $count):
?>
<li><?= $type ?>: <?= $count ?></li>
<?php
endforeach;
?>
</ul>

</main>

</div>

<?php require('footer.php'); ?>
