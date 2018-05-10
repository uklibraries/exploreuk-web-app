<?php
$url = "https://exploreuk.uky.edu/solr/select/?" . $_SERVER['QUERY_STRING'];
print file_get_contents($url);
