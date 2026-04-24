<nav class="breadcrumbs">
    <ul class="no-decoration">
        <li>
            <!-- TWIG INCLUDE : @limestone/link.twig" -->
            <a href="<?= $this->path('') ?>" class="">Home</a>
            <!-- END TWIG INCLUDE : @limestone/link.twig" -->
        </li>
        <?php if (isset($m['back_to_search']) && isset($m['back_to_search_text'])) : ?>
            <li>
                <!-- TWIG INCLUDE : @limestone/link.twig" -->
                <a href="<?= $m['back_to_search'] ?>" class=""><?= $m['back_to_search_text'] ?></a>
                <!-- END TWIG INCLUDE : @limestone/link.twig" -->
            </li>
        <?php endif; ?>
        <?php if (isset($m['current_page_title'])) : ?>
            <li aria-current="page"><?= $m['current_page_title'] ?></li>
        <?php endif; ?>
    </ul>
</nav>
