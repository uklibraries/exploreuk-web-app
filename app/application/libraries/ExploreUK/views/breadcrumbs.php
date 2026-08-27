<div class="slab slab--thin slab--wildcat-white">
    <div class="slab__wrapper">
        <nav class="breadcrumbs">
            <ul class="no-decoration">
                <li>
                    <a href="<?= $this->path('') ?>" class="">Home</a>
                </li>
                <?php if (isset($m['back_to_search']) && isset($m['back_to_search_text'])) : ?>
                    <li>
                        <a href="<?= $m['back_to_search'] ?>" class=""><?= $m['back_to_search_text'] ?></a>
                    </li>
                <?php endif; ?>
                <?php if (isset($m['current_page_title'])) : ?>
                    <li aria-current="page"><?= $m['current_page_title'] ?></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</div>
