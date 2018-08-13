<!DOCTYPE html>
<html lang="en">
<head>
    <title><?php echo m('site_title'); ?></title>
    <meta charset="utf-8" />
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
var search_host = <?php echo $euk_data['script']['search_host']; ?>;
var imagesBaseURL = <?php echo $euk_data['script']['imagesBaseURL']; ?>;
var query = <?php echo $euk_data['script']['query']; ?>;
</script>
<script type="text/javascript" src="<?php echo $theme_path; ?>/BookReaderDemo/BookReaderJSmod.js?<?php echo subresource_integrity('BookReaderDemo/BookReaderJSmod.js'); ?>"></script>
</body>
</html>
