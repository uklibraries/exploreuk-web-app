<!DOCTYPE html>
<html lang="en">
<head>
    <title><?= $m['page_title'] ?></title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?= $this->assetPath('BookReader/BookReader.css') ?>" rel="stylesheet"/>
    <link href="<?= $this->assetPath('BookReaderDemo/BookReaderDemo.css') ?>" rel="stylesheet"/>
</head>
<body>
<main id="main-content">
<div id="BookReader">
</div>
</main>
<script type="text/javascript" src="<?= $this->assetPath('js/vendor/jquery.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetPath('BookReader/jquery-ui-1.8.5.custom.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetPath('BookReader/dragscrollable.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetPath('BookReader/jquery.colorbox-min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetPath('BookReader/jquery.ui.ipad.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetPath('BookReader/jquery.bt.min.js') ?>"></script>
<script type="text/javascript" src="<?= $this->assetPath('BookReader/BookReader.js') ?>"></script>
<script type="text/javascript">
var json = <?= $m['script']['json'] ?>;
var search_host = <?= $m['script']['search_host'] ?>;
var imagesBaseURL = <?= $m['script']['imagesBaseURL'] ?>;
var query = <?= $m['script']['query'] ?>;
</script>
<script type="text/javascript" src="<?= $this->assetPath('BookReaderDemo/BookReaderJSmod.js') ?>?<?= $this->assetVersion('BookReaderDemo/BookReaderJSmod.js') ?>"></script>
</body>
</html>
