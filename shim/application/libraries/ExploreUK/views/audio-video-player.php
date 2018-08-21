<?php $r = $m['item_audio']; ?>
<ul class="media-player">
    <?php if (isset($r['audio'])) :
              $a = $r['audio']; ?>
    <li class="bg-uklblack"><a class="click-to-play-audio" data-id="<?= $a['href_id'] ?>" data-href="<?= $a['href'] ?>"><i class="fas fa-play"></i><p>Play Audio</p></a></li>
    <?php endif; ?>

    <?php if (isset($r['video'])) :
              $v = $r['video']; ?>
    <li class="bg-uklblack"><a class="click-to-play-video" data-id="<?= $v['href_id'] ?>" data-href="<?= $v['href'] ?>"><i class="fas fa-play"></i><p>Play Video</p></a></li>
    <?php endif; ?>
</ul>
