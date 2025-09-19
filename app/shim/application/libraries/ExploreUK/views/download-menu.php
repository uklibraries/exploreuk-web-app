<ul class="download">
    <li>Download</li>
    <li class="bg-uklblack"><a id="jpeg_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=jpeg') ?>"><i class="fas fa-file-image"></i><p>JPEG<?= $m['downloadable_extra'] ?? '' ?></p></a></li>
<?php if (isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
    <li class="bg-uklblack"><a id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>"><i class="fas fa-file-pdf"></i><p>PDF<?= $m['downloadable_single_extra'] ?? '' ?></p></a></li>
<?php else : ?>
    <li class="bg-uklblack"><a id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>"><i class="fas fa-file-pdf"></i><p>PDF<?= $m['downloadable_single_extra'] ?? '' ?></p></a></li>
<?php endif; ?>
<?php if (isset($m['downloadable_extra']) && isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
    <hr>
    <li class="download-contact-offer">Want to download entire<br>item/folder? <a href="https://libraries.uky.edu/ContactSCRC" target="_blank" rel="noopener">Contact us</a></li>
<?php endif; ?>
</ul>
