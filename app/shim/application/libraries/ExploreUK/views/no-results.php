<?php require('header.php'); ?>
<div class="results">
    <div id="resultsfacets" class="resultsfacets no-results">
        <div id="facet_group">
            <div id="facet_group_left">
            </div>
        </div>
    </div>
    <div id="resultsmain">
        <div class="row pagination">&nbsp;</div>
        <div class="row">
            <ul class="result-list">
            <li class="result-item">
                <p class="result-number"></p>
                <div class="result-summary">
                    <h3>No results found matching your search for '<?= htmlspecialchars($this->q('q'), ENT_QUOTES, 'UTF-8') ?>'.</h3>
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
            </li>
            </ul>
        </div>
    </div>
</div>
<?php require('footer.php'); ?>
