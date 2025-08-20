<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $m['page_title'] ?></title>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=EDGE" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= $this->themePath('BookReader/BookReader.css') ?>" rel="stylesheet"/>
    <link href="<?= $this->themePath('BookReaderDemo/BookReaderDemo.css') ?>" rel="stylesheet"/>
</head>
<body>
<div id="BookReader">
</div>
<script type="text/javascript" src="<?= $this->themePath('javascripts/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->themePath('BookReader/jquery-ui-1.8.5.custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->themePath('BookReader/dragscrollable.js') ?>"></script>
<script type="text/javascript" src="<?= $this->themePath('BookReader/jquery.colorbox-min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->themePath('BookReader/jquery.ui.ipad.js') ?>"></script>
<script type="text/javascript" src="<?= $this->themePath('BookReader/jquery.bt.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->themePath('BookReader/BookReader.js') ?>"></script>
<script type="text/javascript">
var json = <?= $m['script']['json'] ?>;
var search_host = <?= $m['script']['search_host'] ?>;
var imagesBaseURL = <?= $m['script']['imagesBaseURL'] ?>;
var query = <?= $m['script']['query'] ?>;
</script>
<script type="text/javascript" src="<?= $this->themePath('BookReaderDemo/BookReaderJSmod.js') ?>?<?= $this->subresourceIntegrity('BookReaderDemo/BookReaderJSmod.js') ?>"></script>
</body>
</html>
