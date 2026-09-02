<?php require('header.php'); ?>

    <div class="slab slab--wildcat-white page-header page-header--text">
        <div class="slab__wrapper">
            <h1 class="headline-group">
                <span class="headline-group__head">
                    ExploreUK statistics
                </span>
            </h1>
        </div>
    </div>

    <?php require('breadcrumbs.php'); ?>

<main id="main-content">
    <div class="slab">
        <div class="slab__wrapper">
            <div class="editorial">
                <h2>Leaves</h2>
                <ul>
                    <li><b>Total:</b> <?= $m['stats']['leaf']['count'] ?></li>
                    <?php
                    foreach ($m['stats']['leaf']['count_by_type'] as $type => $count) :
                        ?>
                    <li><?= $type ?>: <?= $count ?></li>
                        <?php
                    endforeach;
                    ?>
                </ul>

                <h2>Sections</h2>
                <ul>
                    <li><b>Total:</b> <?= $m['stats']['section']['count'] ?></li>
                    <?php
                    foreach ($m['stats']['section']['count_by_type'] as $type => $count) :
                        ?>
                    <li><?= $type ?>: <?= $count ?></li>
                        <?php
                    endforeach;
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>

<?php require('global-footer.php'); ?>
<?php require('universal-footer.php'); ?>
