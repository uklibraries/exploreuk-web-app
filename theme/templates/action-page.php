<!-- rewrite this! -->
<div class="col-md-8">
<?php if (m('item_audio')): ?>
<?php $r = m('item_audio'); ?>
<h2><?php echo $r['title_display']; ?></h2>
    <div id="media_player">
<?php $a = $r['audio']; if (isset($a)): ?>
<p class="click-to-play-audio" data-id="<?php echo $a['href_id']; ?>" data-href="<?php echo $a['href']; ?>"><span class="icon fa-play"></span><br>play</p>
<?php endif; ?>
<?php $v = $r['video']; if (isset($v)): ?>
<p class="click-to-play-video" data-id="<?php echo $v['href_id']; ?>" data-href="<?php echo $v['href']; ?>"><span class="icon fa-play"></span><br>play</p>
<?php endif; ?>
    </div>
<?php endif; ?>

<?php if (m('item_image')): ?>
<?php $r = m('item_image'); ?>
<h2><?php echo $r['title_display']; ?></h2>

    <div id="image_viewer">
<a href="<?php echo $r['reference_image_url_s']; ?>"><img class="reference_image" id="reference_image" src="<?php echo $r['front_thumbnail_url_s']; ?>"></a>
        <div id="viewer" style="width: 100%; height: 600px;"></div>
    </div>

    <div>
<p><a href="#download" data-lity>Download</a></p>


<div id="download" class="lity-hide" style="background: white;">
    <img src="<?php echo $r['front_thumbnail_url_s']; ?>">
    <h3><?php echo $r['title_display']; ?></h3>
    <a href="<?php echo u("/catalog/$euk_id/download?type=jpeg"); ?>">JPEG</a>
    <a href="<?php echo u("/catalog/$euk_id/download?type=pdf"); ?>">PDF</a>
</div>

    </div>
    <div>
<ul>
<?php foreach ($r['metadata'] as $e): ?>
<?php if (isset($e['anchor'])): ?>
<li><a href="<?php echo $e['value']; ?>"><?php echo $e['label']; ?></a></li>
<?php else: ?>
<li><?php echo $e['label']; ?>:
    <?php if ($e['link']): ?>
<a href="<?php echo $e['value']; ?>"><?php echo $e['value']; ?></a></li>
    <?php else: ?>
<?php echo $e['value']; ?></li>
    <?php endif; ?>
<?php endif; ?>
<?php endforeach; ?>
</ul>
    </div>
<?php endif; ?>

<?php if (m('item_book')): ?>
<?php $r = m('item_book'); ?>
<h2><?php echo $r['title_display']; ?></h2>
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
<p><a href="#download" data-lity>Download</a></p>
        <div id="download" class="lity-hide" style="background: white;">
    <a id="jpeg_href" href="<?php echo u("/catalog/" . $r['id'] . "/download/?type=jpeg"); ?>">JPEG</a>
    <a id="pdf_href" href="<?php echo u("/catalog/" . $r['id'] . "/download/?type=pdf"); ?>">PDF</a>
        </div>
    </div>
    <div>
<?php if (m('item_book')): ?>
<?php $r = m('item_book')['text']; ?>
<p><a href="#text" data-lity>Text</a></p>
    <div id="text" class="lity-hide" style="background: white;">
    <iframe id="text_frame" src="<?php echo $r['href']; ?>" width="100%" name="text"></iframe>
    </div>
<?php endif; ?>
<?php if (m('metadata')): ?>
<?php foreach (m('metadata') as $m): ?>
<?php if ($m['anchor']): ?>
<li><a href="<?php echo $m['value']; ?>"><?php echo $m['label']; ?></a></li>
<?php else: ?>
<li><?php echo $m['label']; ?>:
    <?php if ($m['link']): ?>
<a href="<?php echo $m['value']; ?>"><?php echo $m['value']; ?></a>
    <?php else: ?>
<?php echo $m['value']; ?>
    <?php endif; ?>
</li>
<?php endif; ?>
<?php endforeach; ?>
<?php endif; ?>
</div>
<?php endif; ?>
