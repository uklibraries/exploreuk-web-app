<?php $p = $m['pagination']; ?>
<?php if (!empty($p['pages'])) : ?>
<div class="pagination">
    <nav aria-label="Pagination">
        <ul>
            <?php if ($p['current_page'] > 1) : ?>
                <li class="first"><a href="<?= $p['first_page'] ?>">First</a></li>
                <li class="previous"><a href="<?= $p['previous'] ?>">Previous</a></li>
            <?php endif; ?>
            <?php foreach ($p['pages'] as $page) : ?>
                <li<?php if ($page['current']) :
                    ?> class="current"<?php
                   endif; ?>><a href="<?= $page['link'] ?>"><?= $page['number'] ?></a></li>
            <?php endforeach; ?>
            <?php if ($p['current_page'] < $p['total_pages']) : ?>
                <li class="next"><a href="<?= $p['next'] ?>">Next</a></li>
                <li class="last"><a href="<?= $p['last_page'] ?>">Last</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php endif; ?>
