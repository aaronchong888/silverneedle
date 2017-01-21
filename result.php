<?php
require_once 'HTTP/Request2.php';
$request = new Http_Request2('https://westus.api.cognitive.microsoft.com/vision/v1.0/analyze');
$url = $request->getUrl();

$headers = array(
    // Request headers
    'Content-Type' => 'application/json',
    'Ocp-Apim-Subscription-Key' => '{bdfa4eea082d4d759fae63b21b478c6e}',
);

$request->setHeader($headers);

$parameters = array(
    // Request parameters
    'visualFeatures' => 'Categories',
    'details' => '{string}',
    'language' => 'en',
);

$url->setQueryVariables($parameters);

$request->setMethod(HTTP_Request2::METHOD_POST);
$content = file_get_contents($key['tmp_name']);
// Request body
$request->setBody("{".$content."}");

try
{
    $response = $request->send();
    echo $response->getBody();
}
catch (HttpException $ex)
{
    echo $ex;
}

?>