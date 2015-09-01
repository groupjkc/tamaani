<?php

require_once '../../csrest_clients.php';

$wrap = new CS_REST_Clients(
	'53dc5a98c727defb9f3fc62ed4e1559b','05eb9d91fcd118669120e66b1bdd6668');

$result = $wrap->get_lists();

echo "Result of /api/v3/clients/{id}/lists\n<br />";
if($result->was_successful()) {
    echo "Got lists\n<br /><pre>";
    var_dump($result->response);
} else {
    echo 'Failed with code '.$result->http_status_code."\n<br /><pre>";
    var_dump($result->response);
}
echo '</pre>';