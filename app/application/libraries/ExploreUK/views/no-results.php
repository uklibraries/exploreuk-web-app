<?php require('header.php'); ?>

    <div class="slab slab--wildcat-white page-header page-header--text">
        <div class="slab__wrapper">
            <h1 class="headline-group">
                <span class="headline-group__head">
                    No results
                </span>
            </h1>
        </div>
    </div>

    <?php require('breadcrumbs.php'); ?>

<main id="main-content">
    <div class="slab">
        <div class="slab__wrapper">
            <div class="editorial">
                <h2>No results found matching your search for '<?= htmlspecialchars((string) $this->q('q'), ENT_QUOTES, 'UTF-8') ?>'.</h2>
                <p>
                    Did you mean:
                    <?php
                    $suggestions = $m['suggestions'];
                    foreach ($suggestions as $index => $suggestion) {
                        $link = $this->suggestedLink($suggestion);
                        echo '<a class="suggested-search" href="' . $link . '">' . $suggestion . '</a>';
                        if ($index + 1 < count($suggestions)) {
                            echo ' or ';
                        }
                    }
                    ?>
                    ?
                </p>
            </div>
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>

<?php 
    require('global-footer.php'); 
    require('universal-footer.php'); 
?>
