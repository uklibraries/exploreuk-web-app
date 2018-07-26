<?php $r = m('item_book'); ?>
    <div id="books_viewer">
    <iframe id="books_frame" src="<?php echo $r['embed_url']; ?>" width="100%" height="1000px" name="book"></iframe><br/>
<script type="text/javascript">
/* Communication from the outer frame to the inner frame should happen only on
   initialization.  From now on, the inner frame will send messages to the outer
   frame instead. */
if (window.location.hash.length > 0) {
    var re = /^#page\/\d+\/mode\/\w+$/;
    var hash = window.location.hash;
    if (hash.match(re)) {
        document.getElementById('books_frame').src += hash;
    }
}

window.addEventListener('message', function (e) {
    var origin = window.location.protocol + '//' + window.location.hostname;
    if (e.origin !== origin) {
        return;
    }
    var page = e.data.page;
    var hash = e.data.hash;
    var text = '<?php echo u('/catalog/'); ?>' + page.id + '/text';
    document.getElementById('text_frame').src = text;

    var jpeg_href = '<?php echo u('/catalog/'); ?>' + page.id + '/download/?type=jpeg';
    document.getElementById('jpeg_href').href = jpeg_href;

    var pdf_href = '<?php echo u('/catalog/'); ?>' + page.id + '/download/?type=pdf';
    document.getElementById('pdf_href').href = pdf_href;

    window.location.hash = hash;
}, false);
</script>
    </div>

    <div>
</div>
