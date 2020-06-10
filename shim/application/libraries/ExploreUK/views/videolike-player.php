<?php
$r = $m['item_videolike'];
if (isset($m['videos'])) :
    $v = $m['videos'][0]['video'];
?>
<div id="videolike_player">
    <div class="big-media-player">
        <video id="big-media-player-video" preload="none" controls playsinline webkit-playsinline>
            <source src="<?= $v['href'] ?>" type="video/mp4">
        </video>
    </div>
</div>
<?php
elseif (isset($m['audios'])) :
    $a = $m['audios'][0]['audio'];
?>
<div id="videolike_player">
    <div class="big-media-player">
        <audio id="big-media-player-audio" preload="none" controls>
            <source src="<?= $a['href'] ?>" type="audio/mpeg">
            <p>howdy</p>
        </audio>
    </div>
</div>
<?php
endif;
?>
