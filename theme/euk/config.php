<?php
# Move as much of this as possible into user-accessible config.

# Reminder: Omeka does not have "advanced" search for collections.
# https://forum.omeka.org/t/find-collections-by-metadata-exact-match/3051/2
function euk_get_collection_by_title($title)
{
    # XXX: Calling this function assumes that Omeka has been loaded.
    $db = get_db();
    $table = $db->getTable('Collection');

    $sql = <<<SQL
SELECT collections.* FROM `{$db->Collection}` AS collections
INNER JOIN `{$db->ElementText}` AS element_texts ON element_texts.record_id = collections.id
WHERE element_texts.element_id = ? AND element_texts.record_type = 'Collection' AND element_texts.text = ?
GROUP BY collections.id
SQL;
    # XXX: In a standard Omeka setup, Title is element 50.
    $collections = $table->fetchObjects($sql, array(50, $title));
    if (count($collections) > 0) {
        return $collections[0];
    } else {
        return null;
    }
}

global $euk_per_page_opts;
$euk_per_page_opts = array(20, 50, 100);

global $euk_data;
$euk_data = array();

global $oai_response;
global $oai_verb;

global $templates_dir;
$templates_dir = 'handlebars';

global $site_title;
$site_title = 'ExploreUK';

global $euk_solr;
$euk_solr = get_theme_option('euk_solr');

global $findaidurl;
$findaidurl = filter_var(get_theme_option('euk_findingaid_base_url'), FILTER_SANITIZE_URL);

global $featured_image;

# Reminder: Omeka does not have "advanced" search for collections.
# https://forum.omeka.org/t/find-collections-by-metadata-exact-match/3051/2
$colln = euk_get_collection_by_title('Background image rotation');
$items = get_records(
    'Item',
    array(
        'collection' => $colln->id,
        'featured' => 1,
    )
);
if (count($items) > 0) {
    $index = array_rand($items);
    $item = $items[$index];
    set_loop_records('files', $item->Files);
    foreach (loop('files') as $file) {
        break;
    }
    $featured_image = array(
        'background-image' => file_display_url($file, 'fullsize'),
        'label' => metadata($item, array('Dublin Core', 'Title')),
        'url' => metadata($item, array('Dublin Core', 'Relation')),
    );
} else {
    $featured_image = array(
        'background-image' => '',
        'label' => '',
        'url' => '',
    );
}

global $popular_resources;
$popular_resources = array();
# XXX: Ultimately we will allow users to order these.
$colln = euk_get_collection_by_title('Popular Resources');
$items = get_records(
    'Item',
    array(
        'collection' => $colln->id,
    ),
    11
);
foreach ($items as $item) {
    set_loop_records('files', $item->Files);
    unset($file);
    foreach (loop('files') as $file) {
        break;
    }
    if (isset($file)) {
        $popular_resources[] = array(
            'image' => file_display_url($file, 'fullsize'),
            'label' => metadata($item, array('Dublin Core', 'Title')),
            'url' => metadata($item, array('Dublin Core', 'Relation')),
        );
    } else {
        $popular_resources[] = array(
            'image' => '',
            'label' => '',
            'url' => '',
        );
    }
}

global $additional_resources;
$additional_resources = array();
# XXX: Ultimately we will allow users to order these.
$colln = euk_get_collection_by_title('Additional Resources');
$items = get_records(
    'Item',
    array(
        'collection' => $colln->id,
    ),
    6
);
foreach ($items as $item) {
    set_loop_records('files', $item->Files);
    unset($file);
    foreach (loop('files') as $file) {
        break;
    }
    if (isset($file)) {
        $additional_resources[] = array(
            'image' => file_display_url($file, 'fullsize'),
            'label' => metadata($item, array('Dublin Core', 'Title')),
            'url' => metadata($item, array('Dublin Core', 'Relation')),
        );
    } else {
        $additional_resources[] = array(
            'image' => '',
            'label' => '',
            'url' => '',
        );
    }
}

global $euk_back_to_search_text;
$euk_back_to_search_text = 'Back to Search Results';

global $euk_locale;
$euk_locale = array(
    'en' => array(
        'accession_number_s' => 'Accession Number',
        'author_display' => 'Creator',
        'container_list_s' => 'Containers',
        'contributor_s' => 'Contributor',
        'coverage_display' => 'Geographic Subject',
        'description_display' => 'Description',
        'facet_menu_title' => 'Filter Your Results',
        'finding_aid_url_s' => 'XML Collection Guide',
        'format' => 'Format',
        'id' => 'Permalink',
        'language_display' => 'Language',
        'mets_url_display' => 'XML Metadata',
        'pub_date' => 'Date',
        'publisher_display' => 'Publisher',
        'collection_url' => 'Collection',
        'source_s' => 'Collection',
        'subject_topic_facet' => 'Library of Congress Subject Headings',
        'usage_display' => 'Rights',
        'open_collection_guide' => 'collection guide',
        'more_items' => 'more from this collection',
    ),
);

global $euk_requires_capitalization;
$euk_requires_capitalization = array(
    'language_display',
);

global $euk_facetable;
$euk_facetable = array(
    'source_s',
    'subject_topic_facet',
    'format',
    'pub_date',
);

global $facets;
$facets = array(
    'format',
    'pub_date',
    'source_s',
);

global $euk_result_facet_order;
$euk_result_facet_order = array(
    'source',
    'pubdate',
    'format',
);

global $euk_result_drop_fields;
$euk_result_drop_fields = array(
    'format',
);

global $euk_title_field_order;
$euk_title_field_order = array(
    'pub_date',
    'author_display',
    'language_display',
    'collection_url', # NOTE: this implies source_s
    'description_display',
);

global $euk_detail_field_order;
$euk_detail_field_order = array(
    'usage_display',
    'accession_number_s',
    'container_list_s',
    'contributor_s',
    'coverage_display',
    'subject_topic_facet',
    'publisher_display',
    'format',
    'id',
    'finding_aid_url_s',
    'mets_url_display',
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

function type_for($format, $type)
{
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
    } else {
        return $type;
    }
}

global $euk_query;
global $euk_id;

function euk_facet_displayname($facet)
{
    global $euk_locale;
    if (isset($euk_locale['en'][$facet])) {
        return ucfirst($euk_locale['en'][$facet]);
    } else {
        return 'unknown';
    }
}

function euk_makeNavsSensible($navs)
{
    $newNav = array();
    for ($i =0; $i < count($navs); $i += 2) {
        $newNav[$navs[$i]] = $navs[$i + 1];
    }
    return $newNav;
}
