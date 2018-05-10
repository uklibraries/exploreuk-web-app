<form action="<?php echo u('/catalog/'); ?>" method="get">
    <div class="form-group">
        <input class="q form-control" type="text" name="q" value="<?php echo q('q'); ?>">
        <span class="input-group-btn"><button type="submit" class="btn btn-default" value="search">Search</button></span>
    </div>
</form>
