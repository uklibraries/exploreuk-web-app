<?php $r = $m['item_book']; ?>
    <div id="books_viewer">
        <iframe title="<?= $r['title_display'] ?>" id="books_frame" src="<?= $r['embed_url'] ?>" width="100%" height="600px" name="book"></iframe><br/>
        <script type="text/javascript">
            if (window.location.hash.length > 0) {
                document.getElementById('books_frame').src += window.location.hash;
            }

            var initialSync = true;

            window.addEventListener('message', function (e) {
                var origin = window.location.protocol + '//' + window.location.host;
                if (e.origin !== origin) {
                    return;
                }
                if (!e.data || !e.data.page || !e.data.page.id) {
                    return;
                }
                var page = e.data.page;
                var hash = e.data.hash;
                var text = '<?= $this->path('/catalog/') ?>' + page.id + '/text';
                var textFrame = document.getElementById('text_frame');
                if (textFrame && textFrame.contentWindow) {
                    textFrame.contentWindow.location.replace(text);
                }

                /* download menu is only rendered for downloadable items */
                var jpegLink = document.getElementById('jpeg_href');
                if (jpegLink) {
                    jpegLink.href = '<?= $this->path('/catalog/') ?>' + page.id + '/download/?type=jpeg';
                }

                <?php if (isset($m['downloadable_single']) && $m['downloadable_single']) : ?>
                var pdfLink = document.getElementById('pdf_href');
                if (pdfLink) {
                    pdfLink.href = '<?= $this->path('/catalog/') ?>' + page.id + '/download/?type=pdf';
                }
                <?php endif; ?>

                var base = window.location.origin
                    + '<?= $this->path('/catalog/') ?>'
                    + '<?= $m['id'] ?>';

                var url = base + window.location.search + hash;

                var permalink = base + hash;

                var anchor = document.querySelector('#permalink a');
                if (anchor) {
                  anchor.href = permalink;
                  anchor.textContent = permalink;
                }

                if (url !== window.location.href) {
                    if (initialSync) {
                        history.replaceState({href: url}, '', url);
                    } else {
                        history.pushState({href: url}, '', url);
                    }
                }
                initialSync = false;
            }, false);

            window.addEventListener('popstate', function () {
                var frame = document.getElementById('books_frame');
                if (!frame || !frame.contentWindow) {
                    return;
                }
                frame.contentWindow.postMessage(
                    {command: 'navigate', hash: window.location.hash},
                    window.location.origin
                );
            });
        </script>
</div>
