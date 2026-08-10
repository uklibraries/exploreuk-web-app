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
                <a href="https://libraries.uky.edu/" target="_blank" rel="noopener">University of Kentucky Libraries</a>
                rare and unique resources, particularly those housed in the
                <a href="https://libraries.uky.edu/locations/special-collections-research-center" target="_blank" rel="noopener">Special Collections Research Center</a>.
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
                    <a href="https://www.uky.edu/its/" target="_blank" rel="noopener">University of Kentucky Information Technology Services</a>
                    infrastructure for AIPs and DIPs storage
                </li>
                <li>
                    Collection guides and related information are managed by the
                    <a href="http://archivesspace.org/" target="_blank" rel="noopener">ArchivesSpace</a>
                    information management application.
                </li>
            </ul>
            <p>Visit the
                <a href="https://github.com/uklibraries" target="_blank" rel="noopener">UK Libraries GitHub page</a>
                for more information.
            </p>
            <h2>Acknowledgements</h2>
            <p>
                A portion of the collection guides and digitized content on ExploreUK was made possible by support from the
                <a href="https://www.clir.org/" target="_blank" rel="noopener">Council on Library and Information Resources</a>,
                <a href="https://www.imls.gov/" target="_blank" rel="noopener">Institute of Museum and Library Services</a>,
                <a href="https://www.heyburninitiative.org/" target="_blank" rel="noopener">The John G. Heyburn II Initiative for Excellence in the Federal Judiciary</a>, the
                <a href="https://www.neh.gov/" target="_blank" rel="noopener">National Endowment for the Humanities</a>, and the
                <a href="https://www.archives.gov/nhprc" target="_blank" rel="noopener">National Historical Publications &amp; Records Commission</a>.
            </p>
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>
<?php
    require('global-footer.html');
    require('universal-footer.php');
?>
