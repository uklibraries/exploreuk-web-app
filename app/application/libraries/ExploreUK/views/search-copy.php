<?php require 'header.php'; ?>
<?php
$p = $m['pagination'];
?>
<div id="facet_group_mobile">
    <div id="facet_group_mobile_top">
        <details id="facet_group_mobile_container" class="facet-menu-mobile bg-uklwhite row">
            <summary id="facet_group_mobile_head"><?= $m['facet_menu_title'] ?></summary>
            <?php require 'facets.php'; ?>
        </details>
    </div>
</div>
<div class="results">
    <div id="resultsfacets" class="resultsfacets has-results">
        <div id="facet_group">
            <div id="facet_group_left">
                <div class="bg-uklblue" id="facet_group_left_container">
                    <span id="facet_group_left_head"><?= $m['facet_menu_title'] ?></span>
                </div>
                <?php require 'facets.php'; ?>
            </div>
        </div>
    </div>
    <div id="resultsmain">
        <?php require 'pagination.php'; ?>
        <div class="row">
            <ul class="result-list">
                <?php foreach ($m['results'] as $r) : ?>
                <li class="result-item">
                    <p class="result-number"><?= $r['number'] ?>.</p>
                    <div class="result-summary">
                        <?php if (isset($r['thumb'])) : ?>
                        <a class="image-placeholder" href="<?= $r['link'] ?>"<?= $r['target'] ?>
                            aria-label="<?= $r['title'] ?>">
                            <img class="lazy" src="<?= $this->themePath('images/middlegray.png') ?>"
                                data-src="<?= $r['thumb'] ?>" alt="<?= $r['title'] ?>" title="<?= $r['title'] ?>">
                        </a>
                        <?php elseif (isset($r['format']) && isset(EUK_FORMAT_ICONS[$r['format']])) : ?>
                        <a class="image-placeholder" href="<?= $r['link'] ?>"<?= $r['target'] ?>
                            aria-label="<?= $r['title'] ?>"><i
                                class="fas fa-<?= EUK_FORMAT_ICONS[$r['format']] ?> fa-7x"></i></a>
                        <?php else : ?>
                        <div class="image-placeholder"></div>
                        <?php endif; ?>
                        <h3><a href="<?= $r['link'] ?>"<?= $r['target'] ?>><?= $this->brevity($r['title']) ?></a></h3>
                        <ul class="result-metadata">
                            <?php foreach (EUK_RESULT_FACET_ORDER as $field) : ?>
                            <?php if (isset($r[$field])) : ?>
                            <?php $label = EUK_LOCALE['en'][EUK_HIT_FIELDS[$field]]; ?>
                            <?php if (in_array($field, EUK_RESULT_DROP_FIELDS)) : ?>
                            <?php $lclass = ' class="result-metadata-drop"'; ?>
                            <?php else : ?>
                            <?php $lclass = ''; ?>
                            <?php endif; ?>
                            <?php if (is_array($r[$field])) : ?>
                            <?php foreach ($r[$field] as $entry) : ?>
                            <li<?= $lclass ?>><span class="result-metadata-label"><?= $label ?>:</span>
                                <?= $entry ?>
                </li>
                <?php endforeach; ?>
                <?php else : ?>
                <li<?= $lclass ?>><span class="result-metadata-label"><?= $label ?>:</span>
                    <?= $r[$field] ?></li>
                    <?php endif; ?>
                    <?php endif; ?>
                    <?php endforeach; ?>
            </ul>
        </div>
        </li>
        <?php endforeach; ?>
        </ul>
    </div>
    <?php require 'pagination.php'; ?>
</div>
</div>
<?php require 'more-facets.php'; ?>
<?php require 'footer.php'; ?>




<div class="item-list">
    <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->




    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b60c30" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Exploit Turn Key Mindshare</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>


            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Mrs. Audie Tillman</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Vero
                    , Cum


                </div>
            </div>


            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    <strong>Doloribus amet et delectus unde ut.</strong>
                    Dicta ex eligendi eius consectetur labore officiis nostrum ea sunt ea nam deserunt quas qui ut est
                    magni perspiciatis quaerat temporibus et.
                    Rerum quia omnis nobis ut magni est hic nihil sed tempore dolor laborum velit commodi ut recusandae.
                    Fugiat omnis qui.

                    Ut dignissimos nobis aut est veritatis quo tempora eum qui architecto quidem incidunt.

                </p>
                <p>
                    <strong>Est enim repellendus ea provident provident quam aut et odio aperiam qui necessitatibus
                        praesentium vel eaque quasi modi velit ullam illo.</strong>
                    Dolores quis quidem.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Est consectetur quia iure.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Ut autem quam.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Harum deserunt et dolorem sint provident explicabo
                    laboriosam est et qui consequuntur ea doloribus omnis sed illum.

                </p>
                <p>
                    Explicabo temporibus consequatur molestiae et aut laudantium in omnis nam excepturi consequatur
                    saepe.
                    Molestiae sunt occaecati libero iste impedit et est numquam nemo.
                    <strong>Culpa nisi sunt ut minima atque sunt veniam aliquid consequatur blanditiis et
                        repellendus.</strong>
                    Aut nulla placeat unde repellendus eum optio est.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Ut qui.
                    </a><!-- END TWIG INCLUDE : atoms-link" -->
                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->


    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->




    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b62a9d" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">

                        Morph Cross Platform Eyeballs</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>

            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Prof. Jeffery Monahan</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Ullam

                    , Qui
                    , Ut
                    , Et

                    , Occaecati

                </div>
            </div>


            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>

                    Sed nihil corporis cum mollitia non dolorem magnam sint ipsum fuga aliquam beatae aut id velit
                    numquam aut.
                    Dignissimos aperiam sunt laudantium quia rem dignissimos quae laboriosam consequatur ex maxime
                    rerum.
                    In quo qui perspiciatis similique est nihil velit neque tenetur fuga earum illo velit perspiciatis
                    laborum ut est sequi et et aliquam quibusdam reprehenderit.
                    Quia dolore ipsam.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Id doloribus.
                    </a><!-- END TWIG INCLUDE : atoms-link" -->
                </p>
                <p>
                    Quod voluptatibus fuga sequi minima eveniet consequatur nemo quis qui ut quibusdam repudiandae.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Fugit esse non.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Ducimus a perspiciatis quia voluptatem alias magni
                    soluta.
                    Aut voluptatem ut et ut est ad optio et.

                    Maxime harum occaecati fugit quia saepe.

                </p>
                <p>
                    Doloribus suscipit nisi architecto quia doloribus eligendi error in ipsam laudantium repellendus sed
                    molestiae est impedit iure ipsum qui praesentium placeat culpa molestiae unde aspernatur.
                    <strong>Ea tempore qui dolor illum qui.</strong>
                    Expedita illo.
                    <em>Ut ut sint.</em>
                    <strong>Exercitationem eos laudantium doloremque voluptatem enim voluptate.</strong>

                </p>


            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>

    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->



    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->



    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">

            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b64425" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Streamline Granular E Tailers</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>

            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Georgianna Tromp</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">

                    Modi
                    , Quas
                    , Molestias
                    , Repudiandae

                </div>
            </div>


            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    Incidunt nam atque debitis quod dolor labore odio sunt expedita ex.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Dignissimos molestiae excepturi.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Optio assumenda sed cum officia voluptatum omnis
                    recusandae odio consequatur aliquid consequatur ipsum distinctio sit aut.
                    Voluptate sit atque veritatis quibusdam quas sed aperiam numquam aut autem earum provident vero
                    pariatur aperiam.
                    Illo velit voluptatum maxime et perferendis nesciunt molestiae ullam iste amet hic voluptatem ut
                    temporibus nihil odio.

                </p>
                <p>
                    Qui dolor inventore est mollitia magnam earum.

                    Cumque enim omnis modi labore eaque esse quia distinctio dolorem consectetur unde facilis
                    praesentium.
                    Natus velit mollitia deserunt et velit enim sint nulla in animi adipisci aut.
                    <strong>Nihil molestias similique aliquam modi aperiam enim sunt laudantium quo qui.</strong>
                    Non aut dolorem ut exercitationem et magnam aut debitis quis autem et molestiae sed.


                </p>
                <p>
                    Perferendis officiis reprehenderit nulla animi sapiente placeat est atque voluptas vel laborum ex
                    nobis.
                    Rerum aut.
                    Dolorem aspernatur ratione labore cum vero rerum molestias earum qui tenetur.
                    Voluptatibus veniam alias cumque enim nihil sit vitae distinctio voluptatem enim cumque est ipsa
                    sunt sint dolores ut quidem sequi alias iste.
                    Autem et totam porro autem itaque autem et voluptatem odit voluptas qui ut quibusdam corrupti.

                </p>


            </div>

            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->



    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->




    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b64f41" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Strategize Bricks And Clicks
                        Synergies</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>


            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Stone Spinka</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Quo
                    , Impedit

                </div>

            </div>


            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    Maiores accusamus occaecati tempore modi ipsum.

                    Neque qui mollitia rerum dolor est aut officiis ex deserunt est dolores et corrupti esse totam
                    molestiae quis itaque quasi ullam enim blanditiis.
                    Error accusantium mollitia itaque occaecati cupiditate quam est illo molestiae qui et est placeat
                    eligendi in error odio nobis recusandae.
                    <em></em>
                    Eos eaque iste est consectetur quos mollitia eveniet iste nobis quae voluptas vero magnam voluptates
                    eligendi ad dolores voluptatibus.

                </p>
                <p>


                    <!-- TWIG INCLUDE : atoms-link" -->

                    <a href="http://www.example.com/" class="">
                        Magnam ut commodi.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> A aut odit.
                    Ut labore repellat soluta qui sequi autem assumenda sunt dolorem autem aut illo.
                    <em>Aut voluptatum voluptas inventore aut quo quia sed et ut sunt accusantium.</em>

                </p>

                <p>

                    Iste vel quia itaque labore.
                    <em>Rerum atque velit qui maxime.</em>
                    Libero at mollitia repellendus accusamus accusantium maiores quia minima aspernatur voluptatem.
                    Fuga ipsam voluptatem amet nesciunt voluptas eius cum voluptate consectetur dolorem rerum corporis
                    beatae molestiae error aliquam quae iusto doloremque cumque ea non commodi quis optio nemo.

                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->


    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->


    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->



    <div class="teaser teaser--event">

        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>

        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b675a9" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Iterate Global Schemas</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>

            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Madonna Feest</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Deleniti
                    , Molestias
                    , Id
                    , Expedita
                    , Aut


                </div>
            </div>



            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    <em></em>
                    Rerum qui facere nam minima itaque et et est corrupti qui provident nam nobis voluptate assumenda.
                    Voluptatem ducimus omnis.
                    Illum eos est accusantium aut aliquid possimus rem dolore recusandae quia alias quia laborum.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Sint expedita quia.
                    </a><!-- END TWIG INCLUDE : atoms-link" -->
                </p>
                <p>
                    Nemo vel unde ab autem deserunt possimus ut aut aut illum laboriosam.
                    Libero aut a facilis corporis.
                    Non est deleniti laboriosam voluptas eveniet officia quo et corporis.
                    Aliquam vel quia quis qui non incidunt facilis rerum aspernatur totam dolores.
                    Commodi aperiam veniam et laudantium modi quis soluta nihil et ea officiis commodi aut atque tempore
                    delectus.

                </p>
                <p>
                    <strong>Officia cupiditate et et iure debitis eius velit facilis a omnis eligendi quas aperiam
                        veritatis.</strong>
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Distinctio beatae et.
                    </a><!-- END TWIG INCLUDE : atoms-link" -->
                    Architecto rerum adipisci qui quo reprehenderit ea.
                    Molestiae dolores consectetur dolor vel numquam veniam.

                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->


    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->



    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b67d78" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Repurpose Sticky Communities</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>

            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Prof. Citlalli Streich</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Ut
                    , Dolorum
                    , Autem

                </div>
            </div>



            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    Rerum corrupti.
                    <em>Reprehenderit eligendi hic qui explicabo dolores officiis suscipit autem neque maiores corporis
                        maiores nihil minima quisquam.</em>

                    <em>Repellat voluptas sequi sed laborum aut minima voluptatem et aperiam eveniet omnis maiores.</em>
                    Commodi corporis.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Laborum et incidunt accusamus.

                    </a><!-- END TWIG INCLUDE : atoms-link" -->
                </p>
                <p>
                    Non rerum placeat eum deleniti nesciunt odit eaque aut nobis voluptatibus sapiente et.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Magnam ipsa esse laborum.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Corrupti ratione.
                    Et sed fugit nulla ducimus voluptatum illum voluptates rerum delectus.
                    Doloremque voluptatem autem alias consequatur dolorem debitis ad porro.

                </p>
                <p>
                    Ut delectus et cumque modi nam consequatur temporibus dolor et est odit cum.

                    Repellat saepe fugiat aut facere iste deleniti doloremque ipsa non omnis qui eaque non magni nulla
                    blanditiis occaecati et similique natus ut alias temporibus autem nemo earum minima.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Autem et aut.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Deleniti debitis quo quia.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Molestiae quo unde eveniet ut laudantium et accusamus
                    fugiat similique ipsum perferendis recusandae eum in perspiciatis quod a est repellendus omnis quae
                    temporibus.

                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->


    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->




    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>

        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->

            <h3 id="headline-group660c465b6af97" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Envisioneer Viral Content</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>

            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Chaim Mohr</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Repudiandae
                    , Aperiam
                    , Est
                    , Est

                </div>
            </div>



            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>

                    <strong>Autem impedit est molestiae ratione ipsam saepe labore repellendus non est consequuntur
                        perferendis dolores officiis et perspiciatis unde aspernatur pariatur quaerat quis quo.</strong>
                    Cumque non dolorum molestias deserunt sint minima incidunt totam in similique non aut quia nisi odit
                    optio adipisci neque quisquam.
                    Aut placeat explicabo quo exercitationem quos molestiae aut reprehenderit dolore labore est.
                    Mollitia voluptas harum magni numquam ratione vel rerum culpa sunt ut eaque quaerat et omnis
                    quibusdam veritatis repellendus quibusdam.

                </p>
                <p>
                    Sit autem ut nemo ut est harum.
                    Omnis quaerat aliquid consequuntur consectetur qui in a id soluta.
                    Voluptates consequuntur ea quam hic voluptatibus deserunt et enim voluptatum vel.
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Aliquam quisquam iusto necessitatibus.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Sit enim unde est praesentium molestias accusamus
                    facilis amet nemo aliquid itaque.

                </p>
                <p>
                    Voluptas ab autem nostrum qui eaque.
                    Eos officiis voluptatem odio et non sint quia ipsa rerum expedita incidunt voluptatem.
                    <em>Nemo et neque quas asperiores dolor et aut omnis et qui et quia ea est.</em>
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Ut ex.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Quia corporis voluptatem sed ipsam voluptatem et
                    blanditiis praesentium quia amet tenetur quis quam enim in.


                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->


    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->



    <div class="teaser teaser--event">
        <div class="teaser__media">

            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b6b7e6" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Enable Frictionless E Services</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>


            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Dr. Valentina Towne</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Perferendis
                    , Perspiciatis

                </div>
            </div>


            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    Reprehenderit et explicabo.
                    Accusamus qui.
                    Commodi sunt aut cum.

                    <em>Similique reprehenderit quia corporis totam eum placeat itaque vel amet qui.</em>
                    Non explicabo eius quo rerum sint commodi.

                </p>

                <p>
                    Dolor dolorem dolores at dolor consequatur asperiores fuga deleniti rerum incidunt sed.
                    Et autem sed sed enim deleniti corporis magni ut est repellat molestiae tempora consequatur.
                    Veniam.
                    Quae impedit cupiditate sequi dolorem porro tenetur magnam dolorem quo rem velit eaque quaerat in.
                    <strong>Quia eos voluptate autem natus ut doloribus veniam non tempora earum ad pariatur
                        velit.</strong>

                </p>
                <p>

                    Eaque aut adipisci quia nobis dolores qui minima suscipit eum ut voluptatem nesciunt.
                    Aut omnis harum sit eaque quasi.
                    Dolores perspiciatis aut harum est inventore ducimus aspernatur deserunt quo quo suscipit omnis
                    deleniti delectus dolores aut nemo est vel ut autem dolores dolores.
                    Consequatur id molestiae fuga in modi ut.
                    <strong>Illo culpa commodi consequatur assumenda dolores deserunt aut aut nobis error voluptatem
                        perferendis quibusdam.</strong>

                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->



    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->



    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>
        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b6d47e" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Evolve Viral Deliverables</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>

            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Buck Miller</span>

                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Eligendi
                    , Velit
                    , Vitae
                    , Quae
                    , Odit

                </div>
            </div>



            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    Provident fuga eaque qui.
                    In eum et dolor qui illo quo quia soluta porro velit et blanditiis et quo delectus rerum quia.
                    Amet minima et dicta quasi vel ut voluptate neque voluptatem similique omnis vitae accusantium quis
                    sapiente amet ut.

                    Quia enim expedita ea ipsa et eveniet saepe unde.
                    Enim non dolor expedita ad voluptas eveniet.

                </p>
                <p>
                    Rerum iste asperiores dolore quod eum recusandae delectus facilis corporis.

                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Consectetur fuga doloribus.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Et sed et.
                    <strong>Earum possimus et quis voluptatem officia id minus aut corrupti tempora consequuntur
                        distinctio non qui eos qui.</strong>
                    Vel et neque voluptatem suscipit mollitia itaque.

                </p>
                <p>
                    Expedita provident illo in.
                    <strong>Fugiat sunt debitis ut iure sunt culpa maxime ut eaque quia assumenda.</strong>
                    Eveniet aut ut amet sunt possimus impedit qui.
                    <em>In repellat alias laudantium quia beatae animi perferendis cupiditate.</em>
                    Ut perspiciatis modi laboriosam error et voluptatibus nobis consectetur aut tempora perferendis.

                </p>

            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->


    <!-- END TWIG INCLUDE : components-teaser" --> <!-- TWIG INCLUDE : components-teaser" -->

    <!-- TWIG INCLUDE : @limestone/teaser.twig" -->




    <div class="teaser teaser--event">
        <div class="teaser__media">
            <a href="#"><!-- TWIG INCLUDE : @limestone/image.twig" --> <img src="https://picsum.photos/600/400/"
                    alt="Default alt text" class="" />
                <!-- END TWIG INCLUDE : @limestone/image.twig" --></a>
        </div>

        <div class="teaser__content">
            <!-- TWIG INCLUDE : @limestone/headline-group.twig" -->
            <h3 id="headline-group660c465b6db4b" class="headline-group ">
                <span class="headline-group__super">Optional Superhead</span> <span
                    class="headline-group__head "><!-- TWIG INCLUDE : @limestone/link.twig" --><a href="example.com"
                        class="underline-link">
                        Iterate Real Time Communities</a><!-- END TWIG INCLUDE : @limestone/link.twig" --></span>
                <span class="headline-group__sub">Optional Subhead</span>
            </h3>


            <!-- END TWIG INCLUDE : @limestone/headline-group.twig" -->
            <div class="content-meta">
                <div class="content-meta__who-when">
                    <span class="byline">By Fay Mosciski</span>
                    <span class="date">Apr 02, 2024</span>
                </div>
                <div class="taxonomy-list">
                    Earum
                    , Odio
                    , Eos

                </div>
            </div>



            <!-- TWIG INCLUDE : @limestone/formatted-text.twig" -->
            <div class="editorial">
                <p>
                    Cupiditate dignissimos a asperiores aliquam quaerat magnam nam.
                    <strong>Accusantium perferendis ipsum qui cumque voluptate impedit et quibusdam dolores pariatur eos
                        tempora laboriosam dignissimos impedit quae.</strong>
                    <!-- TWIG INCLUDE : atoms-link" -->
                    <a href="http://www.example.com/" class="">
                        Atque atque aut corporis.
                    </a><!-- END TWIG INCLUDE : atoms-link" --> Illo ut beatae ut repudiandae saepe reiciendis
                    consectetur hic et illum facilis porro.
                    Sunt ut id animi consequatur optio amet nesciunt aut voluptatem natus quasi.

                </p>
                <p>
                    Odio dolor iusto nisi nihil et laborum doloribus.

                    Provident adipisci occaecati consequuntur assumenda fuga et et adipisci ducimus aut consequatur
                    autem minima.
                    Vitae laboriosam voluptatem eos voluptatem aut et nemo eius non sunt.
                    <em>Et aut sed aut animi eligendi quisquam nostrum fuga facilis ut qui esse eos.</em>

                </p>
                <p> Laboriosam quod aliquid quia molestiae dolorem qui aliquam porro quia id omnis nihil magni sit
                    aspernatur impedit qui ipsam. Sint aspernatur tempora corporis alias nihil neque et ut et voluptas
                    eum voluptate accusamus ut iste iste hic culpa tenetur cupiditate facere. <em>Tempora esse est in
                        eum.</em> Non officia eum voluptatum blanditiis rerum tempora ratione soluta beatae sint
                    architecto exercitationem unde reiciendis velit aut dolorem dolorem ex sed dolores quibusdam est
                    ipsam architecto. <em>Perferendis voluptatem ea quidem sit eos illum odit voluptatem occaecati
                        beatae.</em>
                </p>
            </div>
            <!-- END TWIG INCLUDE : @limestone/formatted-text.twig" -->
        </div>
    </div>
    <!-- END TWIG INCLUDE : @limestone/teaser.twig" -->
    <!-- END TWIG INCLUDE : components-teaser" -->
    <!-- TWIG INCLUDE : molecules-pagination" -->
    <div class="pagination">
        <ul>
            <li class="first"><a href="#">First</a></li>
            <li class="previous"><a href="#">Previous</a></li>
            <li class="current"><a href="#">1</a></li>
            <li><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            <li><a href="#">4</a></li>
            <li><a href="#">5</a></li>
            <li><a href="#">6</a></li>
            <li class="next"><a href="#">Next</a></li>
            <li class="last"><a href="#">Last</a></li>
        </ul>
    </div><!-- END TWIG INCLUDE : molecules-pagination" -->
</div>
