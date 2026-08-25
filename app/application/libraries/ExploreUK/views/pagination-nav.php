<?php $p = $m['pagination']; ?>
<?php if (!empty($p['pages'])) : ?>
<div class="pagination">
    <nav aria-label="Pagination">
        <ul>
            <?php if ($p['current_page'] > 1) : ?>
                <li class="first"><?= $this->renderLink(['href' => $p['first_page'], 'content' => 'First']) ?></li>
                <li class="previous"><?= $this->renderLink(['href' => $p['previous'], 'content' => 'Previous']) ?></li>
            <?php endif; ?>
            <?php foreach ($p['pages'] as $page) : ?>
                <li<?php if ($page['current']) :
                    ?> class="current"<?php
                   endif; ?>><?= $this->renderLink(['href' => $page['link'], 'content' => $page['number']]) ?></li>
            <?php endforeach; ?>
            <?php if ($p['current_page'] < $p['total_pages']) : ?>
                <li class="next"><?= $this->renderLink(['href' => $p['next'], 'content' => 'Next']) ?></li>
                <li class="last"><?= $this->renderLink(['href' => $p['last_page'], 'content' => 'Last']) ?></li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<?php endif; ?>
