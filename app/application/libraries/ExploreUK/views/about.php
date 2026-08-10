<?php
    $m['page_title'] = 'About ExploreUK';
    $m['current_page_title'] = $m['page_title'];
    require('header.php');
?>
<main id="main-content">
    <div class="slab slab--thin">
        <div class="slab__wrapper">
            <?php require('breadcrumbs.php'); ?>
        </div>
    </div>
    <div class="slab">
        <div class="slab__wrapper">
            <h1>About</h1>
            <p>
                ExploreUK is the gateway to many of
                <?= $this->renderLink(['href' => 'https://libraries.uky.edu/', 'content' => 'University of Kentucky Libraries', 'external' => true]) ?>
                rare and unique resources, particularly those housed in the
                <?= $this->renderLink(['href' => 'https://libraries.uky.edu/locations/special-collections-research-center', 'content' => 'Special Collections Research Center', 'external' => true]) ?>.
                ExploreUK provides free and public access to digital materials for research, teaching, and curious exploration.
            </p>
            <p>
                Materials include manuscript collections, rare books, photographs, organizational records, newspapers, maps, architectural drawings, government publications, University of Kentucky archives, and more. The collections document the social, cultural, economic, and political history of the Commonwealth of Kentucky, but also include materials of national and international significance.
            </p>
            <h2>Content Types</h2>
            <p>
                When searching ExploreUK, you will discover the following content types:
            </p>
            <p>
                Collection guides (also known as finding aids): These documents contain detailed information about a specific collection of papers or records and often include an inventory or box list. Use collection guides to determine if materials within a collection is relevant to your interests. When a collection has been digitized, the scans are embedded within the guide as well as discoverable individually through the ExploreUK search tool.
            </p>
            <p>
                Digitized items: The Special Collections Research Center digitizes a portion of its rare and unique collections for online access. These scans can be accessed and downloaded through ExploreUK. Some digital content is described within collection guides (see above) while others are described by basic descriptive metadata. Users are responsible for securing appropriate permissions.
            </p>
            <p>
                Born-digital items: In some cases, materials are created as digital formats, like .pdf, .jpeg, and .wav files. These are also available through ExploreUK. Like digitized items, they may be described within a collection guide or by basic descriptive metadata.
            </p>
            <h2>Platform and Tools</h2>
            <p>
                ExploreUK uses a combination of the following:
            </p>
            <ul>
                <li>
                    Apache Solr
                </li>
                <li>
                    <?= $this->renderLink(['href' => 'https://www.uky.edu/its/', 'content' => 'University of Kentucky Information Technology Services', 'external' => true]) ?>
                    infrastructure for AIPs and DIPs storage
                </li>
                <li>
                    Collection guides and related information are managed by the
                    <?= $this->renderLink(['href' => 'http://archivesspace.org/', 'content' => 'ArchivesSpace', 'external' => true]) ?>
                    information management application.
                </li>
            </ul>
            <p>Visit the
                <?= $this->renderLink(['href' => 'https://github.com/uklibraries', 'content' => 'UK Libraries GitHub page', 'external' => true]) ?>
                for more information.
            </p>
            <h2>Acknowledgements</h2>
            <p>
                A portion of the collection guides and digitized content on ExploreUK was made possible by support from the
                <?= $this->renderLink(['href' => 'https://www.clir.org/', 'content' => 'Council on Library and Information Resources', 'external' => true]) ?>,
                <?= $this->renderLink(['href' => 'https://www.imls.gov/', 'content' => 'Institute of Museum and Library Services', 'external' => true]) ?>,
                <?= $this->renderLink(['href' => 'https://www.heyburninitiative.org/', 'content' => 'The John G. Heyburn II Initiative for Excellence in the Federal Judiciary', 'external' => true]) ?>, the
                <?= $this->renderLink(['href' => 'https://www.neh.gov/', 'content' => 'National Endowment for the Humanities', 'external' => true]) ?>, and the
                <?= $this->renderLink(['href' => 'https://www.archives.gov/nhprc', 'content' => 'National Historical Publications & Records Commission', 'external' => true]) ?>.
            </p>
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>
<?php
    require('global-footer.html');
    require('universal-footer.php');
?>
