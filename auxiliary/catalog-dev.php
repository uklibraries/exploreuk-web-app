$username = 'okapi';
$home = posix_getpwuid(posix_getuid())['dir'];
$password = trim(file_get_contents("$home/okapi/okapi.txt"));
$context = stream_context_create(array(
    'http' => array(
        'header' => 'Authorization: Basic ' . base64_encode("$username:$password")
    )
));
print file_get_contents($dest, false, $context);
