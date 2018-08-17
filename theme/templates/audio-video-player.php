<?php $r = m('item_audio'); ?>
<ul class="media-player">
    <?php $a = $r['audio']; if (isset($a)) : ?>
    <li class="bg-uklblack"><a class="click-to-play-audio" data-id="<?= $a['href_id'] ?>" data-href="<?= $a['href'] ?>"><i class="fas fa-play"></i><p>Play Audio</p></a></li>
    <?php endif; ?>

    <?php $v = $r['video']; if (isset($v)) : ?>
    <li class="bg-uklblack"><a class="click-to-play-video" data-id="<?= $v['href_id'] ?>" data-href="<?= $v['href'] ?>"><i class="fas fa-play"></i><p>Play Video</p></a></li>
    <?php endif; ?>
</ul>
