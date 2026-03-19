<div class="section-nav section-nav--blue-gray slab">
    <h3>Download Options</h3>
    <ul class="no-decoration cta-group">
        <li>
            <a class="button button--wildcat-blue" id="jpeg_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=jpeg') ?>">
                <span class="icon-label icon-label--stacked">
                    <i class="fa fa-file-image" aria-hidden="true"></i>
                    <span class="label">JPEG<?= $m['downloadable_extra'] ?? '' ?></span>
                </span>
            </a>
        </li>
        <?php if (isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
            <li>
                <a class="button button--wildcat-blue" id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>">
                    <span class="icon-label icon-label--stacked">
                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                        <span class="label">PDF<?= $m['downloadable_single_extra'] ?? '' ?></span>
                    </span>
                </a>
            </li>
        <?php else : ?>
            <li>
                <a class="button button--wildcat-blue" id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>">
                    <span class="icon-label icon-label--stacked">
                        <i class="fas fa-file-pdf" aria-hidden="true"></i>
                        <span class="label">PDF<?= $m['downloadable_single_extra'] ?? '' ?></span>
                    </span>
                </a>
            </li>
        <?php endif; ?>
        </ul>
        <?php if (isset($m['downloadable_extra']) && isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
        <hr>
        <p class="download-contact-offer">Want to download entire<br>item/folder? <a href="https://libraries.uky.edu/ContactSCRC" target="_blank" rel="noopener">Contact us</a></p>
        <?php endif; ?>
</div>
