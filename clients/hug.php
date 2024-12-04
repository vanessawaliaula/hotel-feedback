<?php 
require 'vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client();
$apiToken = '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';
$responseText = "The service was excellent and I will return!";

try {
    $response = $client->post('https://api-inference.huggingface.co/models/cardiffnlp/twitter-roberta-base-sentiment', [
        'headers' => [
            'Authorization' => "Bearer $apiToken",
        ],
        'body' => json_encode(['inputs' => $responseText]),
    ]);

    $result = json_decode($response->getBody(), true);
    print_r($result); // Output the analysis results
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage();
}
