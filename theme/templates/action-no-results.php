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
                    <h3>No results found matching your search for '<?= htmlspecialchars(q('q'), ENT_QUOTES, 'UTF-8') ?>'.</h3>
                    <p>
                        Did you mean:
<?php
$suggestions = m('suggestions');
foreach ($suggestions as $index => $suggestion) {
    $link = euk_link_to_query(array_merge(
        $euk_query,
        array(
            'q' => $suggestion,
        )
    ));
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
