<?php
    $m['page_title'] = 'Copyright, Use, and Take-Down Policies';
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
                <h2>Copyright and Use</h2>
                <p>Disclaimer: The University of Kentucky Libraries Special Collections Research Center (SCRC) provides broad public access to collections as a contribution to education and scholarship. Most content in the digital libraries is protected by the U.S. Copyright Law (Title 17, U.S.C.). Use of the materials may also be subject to other legal rights, for example, rights of publicity, privacy rights, or other legal interests. Transmission or reproduction of materials protected by copyright beyond that allowed by fair use requires the written permission of the copyright owners. As noted, additional permissions may also be required. SCRC does not authorize any use or reproduction whatsoever for commercial purposes.</p>
                <p>SCRC makes digital versions of collections accessible in the following situations: they are in the public domain; SCRC has permission to make them accessible online; materials are made accessible for education and research purposes as a legal fair use, or; there are no known restrictions on use.</p>
                <p>Researchers should
                  <?= $this->renderLink(['href' => 'https://libraries.uky.edu/ContactSCRC', 'content' => 'contact SCRC', 'external' => true]) ?>
                  for additional information about rights, contacts, and permissions. Responsibility for making an independent legal assessment of an item and securing any necessary permissions ultimately rests with those persons wishing to use the item(s).
                </p>
                <h2>Take-Down Policies</h2>
                <p>The SCRC makes every effort to ensure that it has the appropriate rights to digitally preserve and provide access to its collections. Parties who have questions or concerns about the use of specific works may email the SCRC at scrc@uky.edu.</p>
                <p>With all such communications, please include:</p>
                <ul>
                    <li>A physical or electronic signature of the copyright owner. NOTE: If an agent is providing the notification, also include a statement that the agent is authorized to act on behalf of the owner.</li>
                    <li>Identification of the material that is claimed to be infringing or to be the subject of infringing activity and that is to be removed or access to which is to be disabled, and information reasonably sufficient to permit SCRC to locate the material. Providing URLs in your communication is the best way to help us locate content quickly.</li>
                    <li>The reason for the request.</li>
                </ul>
                <p>All correspondence will be answered within a reasonable time by SCRC.</p>
            </div>
        </div>
    </div>
    <?php require('sponsors.html'); ?>
</main>
<?php
    require('global-footer.php');
    require('universal-footer.php');
?>
