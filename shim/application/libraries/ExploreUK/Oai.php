<?php

/* main entry point */
function euk_oai_response($host_options) {
    global $euk_oai_options;
    global $euk_oai_sets;
    global $oai_per_page;
    global $oai_host_options;

    $oai_host_options = $host_options;
    $euk_oai_options = array(
        'identifier',
        'metadataPrefix',
        'from',
        'until',
        'set',
        'resumptionToken',
    );
    $euk_oai_sets = array(
        array(
            'spec' => 'primo',
            'name' => 'ExploreUK records ready for Primo import',
        ),
        array(
            'spec' => 'umbra',
            'name' => 'ExploreUK records ready for Umbra import',
        ),
    );
    $oai_per_page = 15;

    switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        parse_str($_SERVER['QUERY_STRING'], $params);
        break;

    case 'POST':
        $params = array();
        if (isset($_REQUEST['verb'])) {
            $params['verb'] = $_REQUEST['verb'];
        }
        foreach ($euk_oai_options as $option) {
            if (isset($_REQUEST[$option])) {
                $params[$option] = $_REQUEST[$option];
            }
        }
        break;

    default:
        return euk_oai_error('badArgument');
        break;
    }
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
                return euk_oai_error('badVerb');
                break;
            }
        }
    }
    if (!isset($response['verb'])) {
        return euk_oai_error('badVerb');
    }
    foreach ($params as $key => $value) {
        if ($key === 'verb') {
            continue;
        }
        elseif (!in_array($key, $euk_oai_options)) {
            return euk_oai_error('badArgument');
            break;
        }
        elseif (isset($options[$key])) {
            return euk_oai_error('badArgument');
            break;
        }
        else {
            $response[$key] = $value;
            $options[$key] = $value;
        }
    }
    if (!isset($response['verb'])) {
        return euk_oai_error('badVerb');
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
    case 'ListIdentifiers':
        $metadata = euk_oai_list_identifiers($options);
        break;
    case 'ListRecords':
        $metadata = euk_oai_list_records($options);
        break;
    default:
        return euk_oai_error('badVerb');
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

/* OAI verbs */

function euk_oai_identify($options) {
    global $oai_host_options;
    $host = $oai_host_options['host'];

    if (count($options) > 0) {
        return euk_oai_error('badArgument');
    }

    $metadata = array(
        array('repositoryName', 'ExploreUK'),
        array('baseURL', oai_base()),
        array('protocolVersion', '2.0'),
        array('adminEmail', array('m.slone@uky.edu')),
        array('earliestDatestamp', euk_oai_earliest_datestamp()),
        array('deletedRecord', 'transient'),
        array('granularity', 'YYYY-MM-DDThh:mm:ssZ'),
        array('description', array(
            array('scheme', 'oai'),
            array('repositoryIdentifier', $host),
            array('delimiter', ':'),
            array('sampleIdentifier', "$host:xt7tx921dp6w_7"),
        )),
    );
    return $metadata;
}

function euk_oai_list_metadata_formats($options) {
    global $oai_host_options;
    $host = $oai_host_options['host'];
    $solr = $oai_host_options['solr'];
    $permitted_options = array(
        'identifier',
    );
    if (count($options) > 1) {
        return euk_oai_error('badArgument');
    }
    foreach ($options as $option => $value) {
        if (!in_array($option, $permitted_options)) {
            return euk_oai_error('badArgument');
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
        $id = $options['identifier'];
        $id = preg_replace("#$host/#", '', $id);
        # verify that document exists
        $url = "$solr?qt=document&wt=json&id=" . urlencode($id);
        $result = json_decode(file_get_contents($url), true);
        if (isset($result['response']) && $result['response']['numFound'] == 0) {
            return euk_oai_error('idDoesNotExist');
        }
    }
    return $metadata;
}

function euk_oai_list_sets($options) {
    global $euk_oai_sets;
    $permitted_options = array(
        'resumptionToken',
    );
    foreach ($options as $option => $value) {
        if (!in_array($option, $permitted_options)) {
            return euk_oai_error('badArgument');
        }
    }
    if (count($euk_oai_sets) == 0) {
        return euk_oai_error('noSetHierarchy');
    }
    # We only offer one set, so we do not return resumptionTokens for this verb.
    if (isset($options['resumptionToken'])) {
        return euk_oai_error('badResumptionToken');
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

function euk_oai_get_record($options) {
    global $oai_host_options;
    $host = $oai_host_options['host'];
    $solr = $oai_host_options['solr'];
    $required_options = array(
        'identifier',
        'metadataPrefix',
    );
    foreach ($required_options as $option) {
        if (!isset($options[$option])) {
            return euk_oai_error('badArgument');
        }
    }
    # we can always offer oai_dc, and we do not offer anything else
    if ($options['metadataPrefix'] !== 'oai_dc') {
        return euk_oai_error('cannotDisseminateFormat');
    }
    $data_dictionary = euk_oai_data_dictionary();
    $desired_fields = array();
    foreach ($data_dictionary as $row) {
        $desired_fields[] = $row[1];
    }
    $desired_fields[] = 'timestamp';
    $desired_fields[] = 'sequence_number_display';
    $fl = urlencode(implode(',', $desired_fields));
    $id = $options['identifier'];
    $id = preg_replace("#$host/#", '', $id);
    $url = "$solr?qt=document&wt=json&id=" . urlencode($id) . "&fl=$fl";
    $result = json_decode(file_get_contents($url), true);
    # This error should only happen if Solr is not working.  In this case, it is
    # literally true that we cannot disseminate the format for the given identifier.
    if (!isset($result['response'])) {
        return euk_oai_error('cannotDisseminateFormat');
    }
    if (isset($result['response']) && $result['response']['numFound'] == 0) {
        return euk_oai_error('idDoesNotExist');
    }
    $doc = $result['response']['docs'][0];
    $record = array(
        'header' => array(
            array('identifier', "$host/{$options['identifier']}"),
            array('datestamp', $doc['timestamp']),
        ),
    );
    foreach (euk_oai_set_memberships($doc, $options) as $set) {
        $record['header'][] = array('setSpec', $set);
    }
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

function euk_oai_list_identifiers($options) {
    global $oai_per_page;
    global $euk_oai_sets;
    global $oai_host_options;
    $host = $oai_host_options['host'];
    $solr = $oai_host_options['solr'];

    # resumptionToken is exclusive, but if it is not set, then metadataPrefix
    # must be specified.  Everything else but identifier is permitted.
    if ((isset($options['identifier'])) ||
        !(isset($options['metadataPrefix']) || isset($options['resumptionToken'])) ||
        (isset($options['resumptionToken']) && count($options) > 1)) {
        return euk_oai_error('badArgument');
    }

    if (isset($options['set']) && count($euk_oai_sets) == 0) {
        return euk_oai_error('noSetHierarchy');
    }

    if (isset($options['resumptionToken'])) {
        $options = array_merge($options, euk_oai_parse_token($options['resumptionToken']));
        if (isset($options['error'])) {
            return euk_oai_error('badResumptionToken');
        }
    }
    else {
        if (!isset($options['from'])) {
            $options['from'] = euk_oai_earliest_datestamp();
        }
        if (!isset($options['until'])) {
            $options['until'] = euk_oai_latest_datestamp();
        }
        if (!isset($options['page'])) {
            $options['page'] = 1;
        }
        else {
            $options['page'] = intval($options['page']);
        }
    }
    if (!euk_oai_valid_timestamps($options)) {
        return euk_oai_error('badArgument');
    }

    $raw_params = euk_oai_raw_params($options);
    $raw_params[] = array('fl', 'id,timestamp');

    $params = array();
    foreach ($raw_params as $row) {
        $params[] = $row[0] . '=' . urlencode($row[1]);
    }
    $url = $solr . '?' . implode('&', $params);

    $result = json_decode(file_get_contents($url), true);
    if (!isset($result['response'])) {
        return euk_oai_error('cannotDisseminateFormat');
    }
    if (isset($result['response']) && $result['response']['numFound'] == 0) {
        return euk_oai_error('noRecordsMatch');
    }

    $metadata['results'] = array();
    foreach ($result['response']['docs'] as $doc) {
        $record = array(
            'header' => array(
                array('identifier', "$host/{$doc['id']}"),
                array('datestamp', $doc['timestamp']),
            ),
        );
        $metadata['results'][] = $record;
    }

    $metadata['resumptionToken'] = euk_oai_mint_token($options);

    return $metadata;
}

function euk_oai_list_records($options) {
    global $oai_per_page;
    global $euk_oai_sets;
    global $oai_host_options;
    $host = $oai_host_options['host'];
    $solr = $oai_host_options['solr'];

    # resumptionToken is exclusive, but if it is not set, then metadataPrefix
    # must be specified.  Everything else but identifier is permitted.
    if ((isset($options['identifier'])) ||
        !(isset($options['metadataPrefix']) || isset($options['resumptionToken'])) ||
        (isset($options['resumptionToken']) && count($options) > 1)) {
        return euk_oai_error('badArgument');
    }

    if (isset($options['set']) && count($euk_oai_sets) == 0) {
        return euk_oai_error('noSetHierarchy');
    }

    if (isset($options['resumptionToken'])) {
        $options = array_merge($options, euk_oai_parse_token($options['resumptionToken']));
        if (isset($options['error'])) {
            return euk_oai_error('badResumptionToken');
        }
    }
    else {
        if (!isset($options['from'])) {
            $options['from'] = euk_oai_earliest_datestamp();
        }
        if (!isset($options['until'])) {
            $options['until'] = euk_oai_latest_datestamp();
        }
        if (!isset($options['page'])) {
            $options['page'] = 1;
        }
        else {
            $options['page'] = intval($options['page']);
        }
    }
    if (!euk_oai_valid_timestamps($options)) {
        return euk_oai_error('badArgument');
    }

    $raw_params = euk_oai_raw_params($options);

    $data_dictionary = euk_oai_data_dictionary();
    $desired_fields = array();
    foreach ($data_dictionary as $row) {
        $desired_fields[] = $row[1];
    }
    $desired_fields[] = 'timestamp';
    $fl = implode(',', $desired_fields);
    $raw_params[] = array('fl', $fl);

    $params = array();
    foreach ($raw_params as $row) {
        $params[] = $row[0] . '=' . urlencode($row[1]);
    }
    $url = $solr . '?' . implode('&', $params);

    $result = json_decode(file_get_contents($url), true);
    if (!isset($result['response'])) {
        return euk_oai_error('cannotDisseminateFormat');
    }
    if (isset($result['response']) && $result['response']['numFound'] == 0) {
        return euk_oai_error('noRecordsMatch');
    }

    $metadata['results'] = array();
    foreach ($result['response']['docs'] as $doc) {
        $record = array(
            'header' => array(
                array('identifier', "$host/{$doc['id']}"),
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

        $metadata['results'][] = $record;
    }

    $metadata['resumptionToken'] = euk_oai_mint_token($options);

    return $metadata;
}

/* config */

function oai_base() {
    global $oai_host_options;
    $host = $oai_host_options['host'];
    $base = $oai_host_options['base'];
    $oai_base = "https://$host/$base/catalog/oai";
    $oai_base = preg_replace('#/+#', '/', $oai_base);
    $oai_base = preg_replace('#https:/#', 'https://', $oai_base);
    return $oai_base;
}

function euk_oai_raw_params($options) {
    global $oai_per_page;

    $raw_params = array(
        array('wt', 'json'),
        array('sort', 'timestamp asc'),
        array('rows', $oai_per_page),
        array('start', $oai_per_page * ($options['page'] - 1)),
    );
    $raw_params[] = array('fq', "timestamp:[{$options['from']} TO {$options['until']}]");

    if (isset($options['set'])) {
        switch ($options['set']) {
        case 'primo':
            $raw_params[] = array('fq', '(sequence_sort:00001) OR (format:collections)');
            break;
        case 'umbra':
            /* fall through */
        default:
            $raw_params[] = array('fq', '((sequence_sort:00001) AND (format:archival* OR format:athletic* OR format:yearbooks)) OR (format:collections)');
            break;
        }
    }
    else {
        # XXX: This is not what the legacy site does, but this matches what
        # users can find on the site.
        $raw_params[] = array('fq', 'compound_object_split_b:true');
    }

    return $raw_params;
}

function euk_oai_data_dictionary() {
    return array(
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
}

/* error reporting */

function euk_oai_error($code) {
    return array(
        'error' => array(
            'code' => $code,
            'message' => euk_oai_error_message($code),
        ),
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

/* set handling */

function euk_oai_set_memberships($doc, $options) {
    $sets = array();
    if (($doc['sequence_number_display'][0] === '1') || ($doc['format'] === 'collections')) {
        $sets[] = 'primo';
    }
    if ((($doc['sequence_number_display'][0] === '1') && (in_array($doc['format'], array('archival material', 'athletic publications', 'yearbooks')))) || ($doc['format'] === 'collections')) {
        $sets[] = 'umbra';
    }
    return $sets;
}

/* token handling */

function euk_oai_parse_token($string) {
    # Sample tokens we want to parse
    # oai_dc.f(2017-06-21T20:03:21Z).u(2018-02-01T13:37:31Z):2
    # oai_dc.s(primo).f(2017-06-21T20:03:21Z).u(2018-02-01T13:37:31Z):2
    if (preg_match('/^(.*):(\d+)$/', $string, $matches)) {
        $options = array('page' => intval($matches[2]));
        $pieces = explode('.', $matches[1]);
        $options['metadataPrefix'] = array_shift($pieces);
        foreach ($pieces as $piece) {
            if (preg_match('/^(.)\(([^)]+)\)$/', $piece, $matches)) {
                switch ($matches[1]) {
                case 's':
                    $options['set'] = $matches[2];
                    break;

                case 'f':
                    $options['from'] = $matches[2];
                    break;

                case 'u':
                    $options['until'] = $matches[2];
                    break;

                default:
                    return euk_oai_error('badResumptionToken');
                    break;
                }
            }
            else {
                return euk_oai_error('badResumptionToken');
            }
        }
    }
    else {
        return euk_oai_error('badResumptionToken');
    }
    return $options;
}

function euk_oai_mint_token($options) {
    $prefix = array();
    $prefix[] = $options['metadataPrefix'];
    if (isset($options['set'])) {
        $prefix[] = 's(' . $options['set'] . ')';
    }
    $options['from'] = preg_replace('/\.\d+Z/', 'Z', $options['from']);
    $options['until'] = preg_replace('/\.\d+Z/', 'Z', $options['until']);

    $prefix[] = 'f(' . $options['from'] . ')';
    $prefix[] = 'u(' . $options['until'] . ')';

    $suffix = intval($options['page']) + 1;

    return implode('.', $prefix) . ':' . $suffix;
}

/* timestamps */

function euk_oai_earliest_datestamp() {
    global $oai_host_options;
    $solr = $oai_host_options['solr'];
    $url = "$solr?wt=json&sort=timestamp+asc&rows=1&fl=timestamp";
    $result = json_decode(file_get_contents($url), true);
    if (isset($result['response']) and $result['response']['docs'] > 0) {
        return $result['response']['docs'][0]['timestamp'];
    }
    else {
        return '0000-00-00T00:00:00.000Z';
    }
}

function euk_oai_latest_datestamp() {
    global $oai_host_options;
    $solr = $oai_host_options['solr'];
    $url = "$solr?wt=json&sort=timestamp+desc&rows=1&fl=timestamp";
    $result = json_decode(file_get_contents($url), true);
    if (isset($result['response']) and $result['response']['docs'] > 0) {
        return $result['response']['docs'][0]['timestamp'];
    }
    else {
        return '9999-12-31T23:59:59.999Z';
    }
}

function euk_oai_valid_timestamps($options) {
    if (!preg_match('/\d\d\d\d-\d\d-\d\d(T\d\d:\d\d:\d\d(\.\d\d\d)?Z)?/', $options['from'])) {
        return false;
    }
    if (!preg_match('/\d\d\d\d-\d\d-\d\d(T\d\d:\d\d:\d\d(\.\d\d\d)?Z)?/', $options['until'])) {
        return false;
    }
    if (strlen($options['from']) != strlen($options['until'])) {
        return false;
    }
    return true;
}
