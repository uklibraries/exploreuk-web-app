<?php $r = m('item_audio'); ?>
<div id="media_player">
    <?php $a = $r['audio']; if (isset($a)): ?>
    <button class="click-to-play-audio" data-id="<?php echo $a['href_id']; ?>" data-href="<?php echo $a['href']; ?>"><i class="fas fa-play"></i><br>play</button>
    <?php endif; ?>

    <?php $v = $r['video']; if (isset($v)): ?>
    <button class="click-to-play-video" data-id="<?php echo $v['href_id']; ?>" data-href="<?php echo $v['href']; ?>"><i class="fas fa-play"></i><br>play</button>
    <?php endif; ?>
</div>
