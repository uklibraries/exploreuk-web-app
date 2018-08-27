<?php $r = $m['item_book']; ?>
    <div id="books_viewer">
    <iframe title="<?= $r['title_display'] ?>" id="books_frame" src="<?= $r['embed_url'] ?>" width="100%" height="600px" name="book"></iframe><br/>
<script type="text/javascript">
/* Communication from the outer frame to the inner frame should happen only on
   initialization.  From now on, the inner frame will send messages to the outer
   frame instead. */
if (window.location.hash.length > 0) {
    document.getElementById('books_frame').src += window.location.hash;
}

window.addEventListener('message', function (e) {
    var origin = window.location.protocol + '//' + window.location.hostname;
    if (e.origin !== origin) {
        return;
    }
    var page = e.data.page;
    var hash = e.data.hash;
    var text = '<?= $this->path('/catalog/') ?>' + page.id + '/text';
    document.getElementById('text_frame').src = text;

    var jpeg_href = '<?= $this->path('/catalog/') ?>' + page.id + '/download/?type=jpeg';
    document.getElementById('jpeg_href').href = jpeg_href;

    var pdf_href = '<?= $this->path('/catalog/') ?>' + page.id + '/download/?type=pdf';
    document.getElementById('pdf_href').href = pdf_href;

    var url = 'https://' + window.location.hostname
        + '<?= $this->path('/catalog/') ?>'
        + page.id
        + window.location.search
        + window.location.hash

    var permalink = 'https://' + window.location.hostname
        + '<?= $this->path('/catalog/') ?>'
        + page.id;

    var anchor = document.getElementById('page-details-id').nextElementSibling.childNodes[0];
    anchor.href = permalink;
    anchor.innerHTML = permalink;

    history.pushState({href: url}, null, url);
    window.location.hash = hash;
}, false);
</script>
    </div>

    <div>
</div>
