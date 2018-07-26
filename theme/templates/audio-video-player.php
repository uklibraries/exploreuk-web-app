<?php $r = m('item_audio'); ?>
<div id="media_player">
    <?php $a = $r['audio']; if (isset($a)): ?>
    <p class="click-to-play-audio" data-id="<?php echo $a['href_id']; ?>" data-href="<?php echo $a['href']; ?>"><i class="fas fa-play"></i><br>play</p>
    <?php endif; ?>

    <?php $v = $r['video']; if (isset($v)): ?>
    <p class="click-to-play-video" data-id="<?php echo $v['href_id']; ?>" data-href="<?php echo $v['href']; ?>"><i class="fas fa-play"></i><br>play</p>
    <?php endif; ?>
</div>
