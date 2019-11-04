<?php

require 'vendor/autoload.php';

use App\Infrastructure\Service\NetbillingClient;


$client = new NetbillingClient();
$response = $client->serviceCall();
var_dump($response);die('');

$code = $response->getStatusCode(); // 200
$reason = $response->getReasonPhrase(); // OK
$body = $response->getBody();
if ($response->hasHeader('Content-Length')) {
    echo "It exists";
}

echo "<b>HTTP Response</b><br />  $http_code<br /><br />" ;
echo "<b>Response from Payment Gateway</b><br /> $res<br /><br />";


