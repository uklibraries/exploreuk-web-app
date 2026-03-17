<div class="download slab slab--blue-gray">
    <h3>Download</h3>
    <ul class="no-decoration cta-group">
        <li>
            <a class="button button--wildcat-blue" id="jpeg_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=jpeg') ?>">
                <i class="fa fa-file-image"></i>
                <p>JPEG<?= $m['downloadable_extra'] ?? '' ?></p>
            </a>
        </li>
        <?php if (isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
            <li class="icon-label icon-label--stacked">
                <a class="button button--wildcat-blue" id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>">
                    <i class=""></i>
                    <p>PDF<?= $m['downloadable_single_extra'] ?? '' ?></p>
                </a>
            </li>
        <?php else : ?>
            <li class="icon-label icon-label--stacked">
                <a class="button button--wildcat-blue" id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>">
                    <i class="fas fa-file-pdf"></i>
                    <p class="label">PDF<?= $m['downloadable_single_extra'] ?? '' ?></p>
                </a>
            </li>
        <?php endif; ?>
        <?php if (isset($m['downloadable_extra']) && isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
        <hr>
        <li class="download-contact-offer">Want to download entire<br>item/folder? <a href="https://libraries.uky.edu/ContactSCRC" target="_blank" rel="noopener">Contact us</a></li>
    <?php endif; ?>

    </ul>
</div>

