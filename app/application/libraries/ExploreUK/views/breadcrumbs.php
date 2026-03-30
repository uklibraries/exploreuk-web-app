<nav class="breadcrumbs">
    <ul class="no-decoration">
        <li>
            <!-- TWIG INCLUDE : @limestone/link.twig" -->
            <a href="<?= $this->path('') ?>" class="">Home</a>
            <!-- END TWIG INCLUDE : @limestone/link.twig" -->
        </li>
        <li>
            <!-- TWIG INCLUDE : @limestone/link.twig" -->
            <?php if (isset($m['back_to_search']) && isset($m['back_to_search_text'])) : ?>
                <a href="<?= $m['back_to_search'] ?>" class=""><?= $m['back_to_search_text'] ?></a>
            <?php endif; ?>
            <!-- END TWIG INCLUDE : @limestone/link.twig" -->
        </li>
    </ul>
</nav>
