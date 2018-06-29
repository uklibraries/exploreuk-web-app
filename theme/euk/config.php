<?php 
# Move as much of this as possible into user-accessible config.

global $euk_data;
$euk_data = array();

global $templates_dir;
$templates_dir = 'handlebars';

global $site_title;
$site_title = 'ExploreUK';
global $search_placeholder;
$search_placeholder = 'ExploreUK';

global $euk_solr;
$euk_solr = get_theme_option('euk_solr');

global $findaidurl;
$findaidurl = filter_var(get_theme_option('euk_findingaid_base_url'), FILTER_SANITIZE_URL);

global $featured_collections;
$featured_collections = array();
$raw_collections = explode('^', get_theme_option('featured_collections_text'));
while (count($raw_collections) >= 2) {
    $us_id = array_shift($raw_collections);
    $us_label = array_shift($raw_collections);

    $s_id = preg_replace('/[^a-z0-9]/', '', $us_id);
    $s_label = htmlspecialchars($us_label);

    $featured_collections[$s_id] = $s_label;
}

global $random_collection;

$bg = array(
    array(
        'id' => 'xt7sf7664q86',
        'background-image' => 'bg-001.jpg',
        'label' => 'Locomotive and train - xt7sf7664q86_6197_1',
    ),
    array(
        'id' => 'xt7qrf5kb01p',
        'background-image' => 'bg-002.jpg',
        'label' => 'N. Limestone - Short to Church (West), 1921 - xt7qrf5kb01p_1_184',
    ),
    array(
        'id' => 'xt7q833mwz5w',
        'background-image' => 'bg-003.jpg',
        'label' => 'a copy of a print, horse racing - xt7q833mwz5w_1_51',
    ),
    array(
        'id' => 'xt7sf7664q86',
        'background-image' => 'bg-004.jpg',
        'label' => 'African-American chef in cafeteria kitchen - xt7sf7664q86_410_1',
    ),
    array(
        'id' => 'xt7prr1pgv6h',
        'background-image' => 'bg-005.jpg',
        'label' => 'Margaret I. King Library under construction, 1929 - xt7prr1pgv6h_44_3',
    ),
    array(
        'id' => 'xt734t6f3d29',
        'background-image' => 'bg-006.jpg',
        'label' => 'Cats; Butterscotch Tabby cat on a chair - xt734t6f3d29_4066_1',
    ),
    array(
        'id' => 'xt7tdz03077b',
        'background-image' => 'bg-007.jpg',
        'label' => 'African-American man playing guitar, 1960 - xt7tdz03077b_38_32',
    ),
    array(
        'id' => 'xt7sf7664q86',
        'background-image' => 'bg-008.jpg',
        'label' => 'Students - xt7sf7664q86_1642_1',
    ),
    array(
        'id' => 'xt7sbc3svg22',
        'background-image' => 'bg-009.jpg',
        'label' => 'Laura Clay and group marching for the Madsion, Fayette ... - xt7sbc3svg22_1_4',
    ),
);

$bg_index = array_rand($bg);
$random_collection = $bg[$bg_index];
$random_collection['url'] = $findaidurl . $random_collection['id'];

global $facets;
$facets = array(
    'format',
    'source_s',
    'pub_date',
);

global $facets_titles;
$facets_titles = array(
    'format' => 'format',
    'source_s' => 'collection',
    'pub_date' => 'publication year',
);

global $hit_fields;
$hit_fields = array(
    'title' => 'title_display',
    'thumb' => 'thumbnail_url_s',
    'source' => 'source_s',
    'pubdate' => 'pub_date',
    'format' => 'format',
);

global $id_field;
$id_field = 'id';
global $text_field;
$text_field = 'text_s';

global $hl;
$hl = true;
global $hl_fl;
$hl_fl = 'title_display';
global $hl_simple_pre;
$hl_simple_pre = '<em>';
global $hl_simple_post;
$hl_simple_post = '</em>';
global $hl_snippets;
$hl_snippets = 3;

global $euk_type_dictionary;
$euk_type_dictionary = get_theme_option('euk_typedict');

function type_for($format, $type) {
    $type_for = array(
        'archival material' => 'collection',
        'athletic publications' => 'text',
        'books' => 'text',
        'collections' => 'collection',
        'course catalogs' => 'text',
        'directories' => 'text',
        'images' => 'image',
        'journals' => 'text',
        'ledgers' => 'text',
        'maps' => 'image',
        'minutes' => 'text',
        'newspapers' => 'text',
        'oral histories' => 'sound',
        'scrapbooks' => array('text', 'image'),
        'theses' => 'text',
        'yearbooks' => array('text', 'image'),
    );
    if (array_key_exists($format, $type_for)) {
        return $type_for[$format];
    }
    else {
        return $type;
    }
}

global $euk_query;
global $euk_id;

function euk_facet_displayname($facet) {
    global $facets_titles;
    if (isset($facets_titles[$facet])) {
        return ucfirst($facets_titles[$facet]);
    }
    else {
        return 'unknown';
    }
}

function euk_makeNavsSensible($navs) {
    $newNav = array();
    for ($i =0; $i < count($navs); $i += 2) {
        $newNav[$navs[$i]] = $navs[$i + 1];
    }
    return $newNav;
}
