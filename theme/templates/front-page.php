<div class="resources-section bg-uklblack">

<h2 class="popular-resources-title">Popular Resources</h2>
<ul class="popular-resources">
<?php foreach ($popular_resources as $index => $resource): ?>

<li><a id="popular-resource-<?php echo $index; ?>" href="<?php echo $resource['url']; ?>">
    <h3><span><?php echo $resource['label']; ?></span></h3>
</a></li>

<?php endforeach; ?>
</ul>

<h2 class="additional-resources-title">Additional Resources</h2>
<ul class="additional-resources">
<?php foreach ($additional_resources as $index => $resource): ?>

<li><a aria-label="<?php echo $resource['label']; ?>" id="additional-resource-<?php echo $index; ?>" href="<?php echo $resource['url']; ?>" target="_blank" rel="noopener"><img class="lazy" src="<?php echo $theme_path; ?>/images/middlegray.png" data-src="<?php echo $resource['image']; ?>" title="<?php echo $resource['label']; ?>"></a></li>

<?php endforeach; ?>
</ul>
</div>

<style type="text/css">
#top > div {
    background-image:url(<?php echo $featured_image['background-image']; ?>);
    height: 100%;
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}

<?php foreach ($popular_resources as $index => $resource): ?>
#popular-resource-<?php echo $index; ?> {
    background-image:url(<?php echo $resource['image']; ?>);
    background-repeat: no-repeat;
    background-position: center;
    background-size: cover;
}
<?php endforeach; ?>

.popular-resources-title,
.additional-resources-title {
    font-size: 1.3em;
    padding: 0.5em;
}

.popular-resources {
    width: 60%;
    margin-left: auto;
    margin-right: auto;
}

.additional-resources {
    width: 80%;
    margin-left: auto;
    margin-right: auto;
}

.popular-resources > li {
    width: 160px;
    height: 240px;
    margin: 1rem;
    background: #ffffff;
}
.popular-resources > li > a {
    width: 100%;
    height: 100%;
    position: relative;
}

.popular-resources > li > a > h3 {
    color: #ffffff;
    background-color: rgb(0, 93, 171, 0.7);
    position: absolute;
    width: 100%;
    height: 33%;
    bottom: 0;
    font-size: 100%;
}

.popular-resources > li > a > h3 > span {
    text-align: center;
}

@supports (display: grid) {
    .popular-resources > li > a > h3 {
        display: grid;
        justify-items: center;
        align-items: center;
    }
}

.additional-resources > li {
    width: 420px;
    height: 120px;
    margin: 1rem;
    background: #ffffff;
}
.additional-resources > li > a {
    width: 100%;
    height: 100%;
}
.additional-resources > li > a > h3 {
    display: none;
}

@supports (display: grid) {
    .popular-resources {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
        grid-gap: 1rem;
        max-width: 880px;
    }

    .additional-resources {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(420px, 1fr));
        grid-gap: 1rem;
    }
}

@supports (display: flex) {
    .popular-resources > li > a {
        display: flex;
        flex-flow: column;
        flex-shrink: 1;
        align-items: center;
    }

    .additional-resources > li > a {
        display: flex;
        flex-flow: column;
        flex-shrink: 1;
        align-items: center;
    }
}

</style>
