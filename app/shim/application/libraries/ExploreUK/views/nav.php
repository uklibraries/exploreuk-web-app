<nav>
    <label for="drop" class="toggle">Menu</label>
    <input type="checkbox" id="drop" />
    <ul class="navigation">
    <?php foreach ($m['nav'] as $page) : ?>
        <li<?= isset($page['active']) ? ' class="active"' : '' ?>><a<?= isset($page['suppress']) ? '' : " href=\"{$page['uri']}\"" ?><?= isset($page['external']) ? ' target="_blank" rel="noopener"' : '' ?>><?= $page['label'] ?></a>
        <?php if (isset($page['pages'])) : ?>
            <ul>
            <?php foreach ($page['pages'] as $subpage) : ?>
                <li<?= isset($subpage['active']) ? ' class="active"' : '' ?>><a<?= isset($subpage['suppress']) ? '' : " href=\"{$subpage['uri']}\"" ?><?= isset($subpage['external']) ? ' target="_blank" rel="noopener"' : '' ?>><?= $subpage['label'] ?></a>
            <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        </li>
    <?php endforeach; ?>
    </ul>
</nav>
