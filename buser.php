<?php
require "vendor/autoload.php";

$cookie = [
    "sessionid" => "",
    "signed_ida" => "",
    "openChat" => "",
    "promo" => ""
];

$from = "vila-velha-es";
$to = "belo-horizonte-mg";
$date = "2022-05-13";

$request = new HTTP_Request2();
$request->setUrl("https://www.buser.com.br/api/search?origemSlug={$from}&destinoSlug={$to}&departureDate={$date}");
$request->setMethod(HTTP_Request2::METHOD_GET);
$request->setConfig([ 'follow_redirects' => TRUE ]);
$request->setHeader([
    // 'Cookie' => rawurldecode(http_build_query($cookie))
]);
try {
    $response = $request->send();
    if ($response->getStatus() == 200) {
        $body = json_decode($response->getBody());
        // make it happen
        print_r($body);
    }
    else {
        echo 'Unexpected HTTP status: ' . $response->getStatus() . ' ' .
        $response->getReasonPhrase();
    }
}
catch(HTTP_Request2_Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
