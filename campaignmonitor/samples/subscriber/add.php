<?php
require_once '../../csrest_subscribers.php';

$wrap = new CS_REST_Subscribers('82f2d127c4514f1aaeee9ac155a32fc6', '7ff8172778f440f54148c4c6a6ebaf6c');
$result = $wrap->add(array(
    'EmailAddress' => 'tes1111t ',
    'Name' => 'fatia',
    'Resubscribe' => true
));


if($result->was_successful()) {
    echo "Subscribed with code ".$result->http_status_code;
} else {
    echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
    var_dump($result->response);
    echo '</pre>';
}