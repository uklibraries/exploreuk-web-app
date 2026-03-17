<nav class="breadcrumbs">
    <ul class="no-decoration">
        <li>
            <!-- TWIG INCLUDE : @limestone/link.twig" -->
            <a href="<?= $this->path('') ?>" class="">Home</a>
            <!-- END TWIG INCLUDE : @limestone/link.twig" -->
        </li>
        <li>
            <!-- TWIG INCLUDE : @limestone/link.twig" -->
            <a href="<?= $m['back_to_search'] ?>" class=""><?= $m['back_to_search_text']?></a>
            <!-- END TWIG INCLUDE : @limestone/link.twig" -->
        </li>
    </ul>
</nav>
