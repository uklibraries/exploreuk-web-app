<?php

function euk_oai_error($code) {
    return array(
        'code' => $code,
        'message' => euk_oai_error_message($code),
    );
}

function euk_oai_error_message($code) {
    $message = array(
        'badArgument' => 'The request includes illegal arguments, is missing required arguments, includes a repeated argument, or values for arguments have an illegal syntax.',
        'badResumptionToken' => 'The value of the resumptionToken argument is invalid or expired.',
        'badVerb' => 'Value of the verb argument is not a legal OAI-PMH verb, the verb argument is missing, or the verb argument is repeated.',
        'cannotDisseminateFormat' => 'The metadata format identified by the value given for the metadataPrefix argument is not supported by the item or by the repository',
        'idDoesNotExist' => 'The value of the identifier argument is unknown or illegal in this repository.',
        'noRecordsMatch' => 'The combination of the values of the from, until, set, and metadataPrefix arguments results in an empty list.',
        'noMetadataFormats' => 'There are no metadata formats available for the specified item.',
        'noSetHierarchy' => 'The repository does not support sets.',
    );
    if (isset($message[$code])) {
        return $message[$code];
    }
    else {
        return null;
    }
}

global $euk_oai_options;
$euk_oai_options = array(
    'identifier',
    'metadataPrefix',
    'from',
    'until',
    'set',
    'resumptionToken',
);

global $euk_oai_sets;
$euk_oai_sets = array(
    array(
        'spec' => 'primo',
        'name' => 'ExploreUK records ready for Primo import',
    ),
);

# TODO: define this
function euk_parse_token($string) {
    # Sample token we want to parse
    # oai_dc.f(2017-06-21T20:03:21Z).u(2018-02-01T13:37:31Z):2
}

function oai_base() {
    global $host;
    global $euk_base;
    $oai_base = "https://$host/{$euk_base}/catalog/oai";
    $oai_base = preg_replace('#/+#', '/', $oai_base);
    $oai_base = preg_replace('#https:/#', 'https://', $oai_base);
    return $oai_base;
}

function euk_oai_response() {
    global $euk_oai_options;
    parse_str($_SERVER['QUERY_STRING'], $params);
    $response = array(
        'verb' => null,
        'responseDate' => gmdate('Y-m-d\TH:i:s\Z'),
        'request' => oai_base(),
    );
    $error = null;
    $options = array();
    foreach ($params as $key => $value) {
        if ($key === 'verb') {
            if (!isset($response['verb'])) {
                $response['verb'] = $value;
            }
            else {
                $error = 'badVerb';
                break;
            }
        }
        elseif (!in_array($key, $euk_oai_options)) {
            $error = 'badArgument';
            break;
        }
        elseif (isset($options[$key])) {
            $error = 'badArgument';
            break;
        }
        else {
            $response[$key] = $value;
            $options[$key] = $value;
        }
    }
    if (!isset($response['verb'])) {
        $error = 'badVerb';
    }
    if ($error) {
        $response['error'] = euk_oai_error($error);
        return $response;
    }
    switch ($response['verb']) {
    case 'Identify':
        $metadata = euk_oai_identify($options);
        break;
    case 'ListMetadataFormats':
        $metadata = euk_oai_list_metadata_formats($options);
        break;
    case 'ListSets':
        $metadata = euk_oai_list_sets($options);
        break;
    case 'GetRecord':
        $metadata = euk_oai_get_record($options);
        break;
    default:
        break;
    }
    if (isset($metadata['error'])) {
        $response['error'] = $metadata['error'];
    }
    else {
        $response['metadata'] = $metadata;
    }
    return $response;
}

function euk_oai_earliest_datestamp() {
    global $euk_solr;
    $url = "$euk_solr?wt=json&sort=timestamp+asc&rows=1&fl=timestamp";
    $result = json_decode(file_get_contents($url), true);
    if (isset($result['response']) and $result['response']['docs'] > 0) {
        return $result['response']['docs'][0]['timestamp'];
    }
    else {
        return '0000-00-00T00:00:00Z';
    }
}

function euk_oai_list_sets($options) {
    global $euk_oai_sets;
    $permitted_options = array(
        'resumptionToken',
    );
    foreach ($options as $option => $value) {
        if (!in_array($option, $permitted_options)) {
            return array('error' => euk_oai_error('badArgument'));
        }
    }
    if (count($euk_oai_sets) == 0) {
        return array('error' => euk_oai_error('noSetHierarchy'));
    }
    # We only offer one set, so we do not return resumptionTokens for this verb.
    if (isset($options['resumptionToken'])) {
        return array('error' => euk_oai_error('badResumptionToken'));
    }
    $metadata = array('results' => array());
    foreach ($euk_oai_sets as $set) {
        $metadata['results'][] = array(
            array('setSpec', $set['spec']),
            array('setName', $set['name']),
            array('setDescription', ''),
        );
    }
    return $metadata;
}

function euk_oai_list_metadata_formats($options) {
    global $euk_solr;
    $permitted_options = array(
        'identifier',
    );
    if (count($options) > 1) {
        return array(
            'error' => euk_oai_error('badArgument'),
        );
    }
    foreach ($options as $option => $value) {
        if (!in_array($option, $permitted_options)) {
            return array(
                'error' => euk_oai_error('badArgument'),
            );
        }
    }
    # We only offer Dublin Core metadata
    $metadata = array('results' => array());
    $metadata['results'][] = array(
        array('metadataPrefix', 'oai_dc'),
        array('schema', 'http://www.openarchives.org/OAI/2.0/oai_dc.xsd'),
        array('metadataNamespace', 'http://www.openarchives.org/OAI/2.0/oai_dc/'),
    );
    if (isset($options['identifier'])) {
        $metadata['identifier'] = $options['identifier'];
        # verify that document exists
        $url = "$euk_solr?qt=document&wt=json&id=" . urlencode($options['identifier']);
        $result = json_decode(file_get_contents($url), true);
        if (isset($result['response']) && $result['response']['numFound'] == 0) {
            return array(
                'error' => euk_oai_error('idDoesNotExist')
            );
        }
    }
    return $metadata;
}

function euk_oai_identify($options) {
    global $host;

    if (count($options) > 0) {
        return array('error' => euk_oai_error('badArgument'));
    }

    $metadata = array(
        array('field' => 'repositoryName', 'content' => 'ExploreUK'),
        array('field' => 'baseURL', 'content' => oai_base()),
        array('field' => 'protocolVersion', 'content' => '2.0'),
        array('field' => 'adminEmail', 'content' => array('m.slone@uky.edu')),
        array('field' => 'earliestDatestamp', 'content' => euk_oai_earliest_datestamp()),
        array('field' => 'deletedRecord', 'content' => 'transient'),
        array('field' => 'granularity', 'content' => 'YYYY-MM-DDThh:mm:ssZ'),
        array('field' => 'description', 'content' => array(
            array('field' => 'scheme', 'content' => 'oai'),
            array('field' => 'repositoryIdentifier', 'content' => $host),
            array('field' => 'delimiter', 'content' => ':'),
            array('field' => 'sampleIdentifier', 'content' => "$host:xt7tx921dp6w_7"),
        )),
    );
    return $metadata;
}

function euk_oai_get_record($options) {
    global $host;
    global $euk_solr;
    $required_options = array(
        'identifier',
        'metadataPrefix',
    );
    foreach ($required_options as $option) {
        if (!isset($options[$option])) {
            return array('error' => euk_oai_error('badArgument'));
        }
    }
    # we can always offer oai_dc, and we do not offer anything else
    if ($options['metadataPrefix'] !== 'oai_dc') {
        return array('error' => euk_oai_error('cannotDisseminateFormat'));
    }
    $data_dictionary = array(
        array('title', 'title_display'),
        array('date', 'pub_date'),
        array('creator', 'author_display'),
        array('language', 'language_display'),
        array('source', 'source_s'),
        array('description', 'description_display'),
        array('rights', 'usage_display'),
        array('contributor', 'contributor_s'),
        array('coverage', 'coverage_s'),
        array('subject', 'subject_topic_facet'),
        array('publisher', 'publisher_display'),
        array('format', 'format'),
        array('identifier', 'id'),
        array('type', 'type_display'),
    );
    $desired_fields = array();
    foreach ($data_dictionary as $row) {
        $desired_fields[] = $row[1];
    }
    $desired_fields[] = 'timestamp';
    $fl = urlencode(implode(',', $desired_fields));
    $url = "$euk_solr?qt=document&wt=json&id=" . urlencode($options['identifier']) . "&fl=$fl";
    $result = json_decode(file_get_contents($url), true);
    # This error should only happen if Solr is not working.  In this case, it is
    # literally true that we cannot disseminate the format for the given identifier.
    if (!isset($result['response'])) {
        return array('error' => euk_oai_error('cannotDisseminateFormat'));
    }
    if (isset($result['response']) && $result['response']['numFound'] == 0) {
        return array(
            'error' => euk_oai_error('idDoesNotExist')
        );
    }
    $doc = $result['response']['docs'][0];
    $record = array(
        'header' => array(
            array('identifier', "$host/{$options['identifier']}"),
            array('datestamp', $doc['timestamp']),
        ),
    );
    $record['metadata'] = array();
    foreach ($data_dictionary as $row) {
        $field = $row[0];
        $values = $doc[$row[1]];
        if ($values) {
            if (!is_array($values)) {
                $values = array($values);
            }
            foreach ($values as $value) {
                $record['metadata'][] = array($field, $value);
            }
        }
    }
    $metadata['results'] = array($record);
    return $metadata;
}
