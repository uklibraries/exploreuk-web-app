<?php $theme_path = u('/themes/omeuka'); ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo m('site_title'); ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo $theme_path; ?>/BookReader/BookReader.css" rel="stylesheet"/>
    <link href="<?php echo $theme_path; ?>/BookReaderDemo/BookReaderDemo.css" rel="stylesheet"/>
</head>
<body>
<div id="BookReader">
</div>
<script type="text/javascript" src="<?php echo $theme_path; ?>/javascripts/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReader/jquery-ui-1.8.5.custom.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReader/dragscrollable.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReader/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReader/jquery.ui.ipad.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReader/jquery.bt.min.js"></script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReader/BookReader.js"></script>
<script type="text/javascript">
var json = <?php echo $euk_data['script']['json']; ?>;
</script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReaderDemo/BookReaderJSmod.js"></script>
</body>
</html>
