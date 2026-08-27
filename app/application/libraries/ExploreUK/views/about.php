<?php
    $m['page_title'] = 'About ExploreUK';
    $m['current_page_title'] = $m['page_title'];
    require('header.php');
?>

    <div class="slab slab--wildcat-white page-header page-header--text">
        <div class="slab__wrapper">
            <h1 class="headline-group">
                <span class="headline-group__head">
                    <?= $m['page_title'] ?>
                </span>
            </h1>
        </div>
    </div>

    <?php require('breadcrumbs.php'); ?>

<main id="main-content">
    <div class="slab">
        <div class="slab__wrapper">
            <div class="editorial">
                <p>ExploreUK is the gateway to many of <a href="http://libraries.uky.edu/">University of Kentucky Libraries’</a> rare and unique resources, particularly those housed in the <a href="https://libraries.uky.edu/locations/special-collections-research-center">Special Collections Research Center</a>. ExploreUK provides free and public access to digital materials for research, teaching, and curious exploration.</p>
                <p>Materials include manuscript collections, University of Kentucky archives, rare books, photographs, organizational records, newspapers, maps, architectural drawings, government publications, and more. The collections document the social, cultural, economic, and political history of the Commonwealth of Kentucky, but also include materials of national and international significance.</p>
                
                <h2>Content Types</h2>
                <p>When searching ExploreUK, you will discover the following content types:</p>
                <dl>
                    <dt>Collection guides (also known as “finding aids”)</dt>
                    <dd>These documents contain detailed information about a specific collection of papers or records and often include an inventory or box list. Use collection guides to determine if materials within a collection is relevant to your interests. When a collection has been digitized, the scans are embedded within the guide as well as discoverable individually through the ExploreUK search tool.</dd>
                </dl>
                <dl>
                    <dt>Digitized items</dt>
                    <dd>The Special Collections Research Center digitizes a portion of its rare and unique collections for online access. These scans can be accessed and downloaded through ExploreUK. Some digital content is described within collection guides (see above) while others are described by basic descriptive metadata. Users are responsible for securing appropriate permissions.</dd>
                </dl>
                <dl>
                    <dt>Born-digital items</dt>
                    <dd>In some cases, materials are created as digital formats, like .pdf, .jpeg, and .wav files. These are also available through ExploreUK. Like digitized items, they may be described within a collection guide or by basic descriptive metadata.</dd>
                </dl>
                <h2>Our Organization</h2>
                    <p>ExploreUK is a project of the <a href="http://libraries.uky.edu/">University of Kentucky Libraries</a> and is developed and maintained by the <a href="https://libraries.uky.edu/locations/special-collections-research-center">UK Libraries Special Collections Research Center.</a></p>
                
                    <h2>Platform and Tools</h2>
                    <p>ExploreUK uses a combination of the following:</p>
                <ul>
                    <li><a href="https://omeka.org/">Omeka Classic</a> with a highly customized theme</li>
                    <li>Apache Solr</li>
                    <li><a href="https://www.uky.edu/its/">University of Kentucky Information Technology Services</a> infrastructure for AIPs and DIPs storage</li>
                    <li>Collection guides and related information are managed by the <a href="http://archivesspace.org/">ArchivesSpace</a> information management application.</li>
                </ul>
                <p>Visit the <a href="https://github.com/uklibraries">UK Libraries GitHub page</a> for more information.</p>
                
                <h2>Acknowledgements</h2>
                <p>A portion of the collection guides and digitized content on ExploreUK was made possible by support from the <a href="https://www.clir.org/">Council on Library and Information Resources</a>, <a href="https://www.imls.gov/">Institute of Museum and Library Services</a>, <a href="https://heyburncollections.org/">The John G. Heyburn II Initiative for Excellence in the Federal Judiciary</a>, the <a href="https://www.neh.gov/">National Endowment for the Humanities</a>, and the <a href="https://www.archives.gov/nhprc">National Historical Publications &amp; Records Commission</a>. Visit the <a href="https://libraries.uky.edu/people-0/about-us/grants-partnerships">SCRC Projects and Grants page</a> for more information on these grant-funded projects.</p>
            </div>
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>
<?php
    require('global-footer.html');
    require('universal-footer.php');
?>
