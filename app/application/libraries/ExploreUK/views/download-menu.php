<div class="section-nav section-nav--blue-gray">
    <h2>Download Options</h2>
    <ul class="no-decoration download-options">
        <li class="option">
            <a class="button button--wildcat-blue" id="jpeg_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=jpeg') ?>">
                Download JPEG<?= $m['downloadable_extra'] ?? '' ?>
            </a>
        </li>
        <?php if (isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
            <li class="option">
                <a class="button button--wildcat-blue" id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>">
                    Download PDF<?= $m['downloadable_single_extra'] ?? '' ?>
                </a>
            </li>
        <?php else : ?>
            <li class="option">
                <a class="button button--wildcat-blue" id="pdf_href" href="<?= $this->path('/catalog/' . $m['id'] . '/download?type=pdf') ?>">
                    Download PDF<?= $m['downloadable_single_extra'] ?? '' ?>
                </a>
            </li>
        <?php endif; ?>
        </ul>
        <?php if (isset($m['downloadable_extra']) && isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
        <hr>
        <p class="download-contact-offer">Want to download entire<br>item/folder? <?= $this->renderLink(['href' => 'https://libraries.uky.edu/ContactSCRC', 'content' => 'Contact us', 'external' => true]) ?></p>
        <?php endif; ?>
</div>
