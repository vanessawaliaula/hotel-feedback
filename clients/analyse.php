<?php
require 'vendor/autoload.php'; // Load Guzzle

use GuzzleHttp\Client;

$client = new Client();

//Request record id
$rec_id = $_REQUEST['id'];

// Hugging Face API Token
$apiToken = "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";

// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=hotel_feedback', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch responses
$stmt = $pdo->query("SELECT id AS response_id, feedback AS response_text FROM feedback WHERE id = $rec_id");
$responses = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($responses as $response) {
    $responseId = $response['response_id'];
    $responseText = $response['response_text'];

    // Make a POST request to Hugging Face Inference API
    $response = $client->post('https://api-inference.huggingface.co/models/cardiffnlp/twitter-roberta-base-sentiment', [
        'headers' => [
            'Authorization' => "Bearer $apiToken",
            'Content-Type' => 'application/json',
        ],
        'body' => json_encode(['inputs' => $responseText]),
    ]);

    $responseBody = json_decode($response->getBody(), true);
  
    // Extract sentiment
    // $sentiment = $responseBody[0]['label']; // Example: "LABEL_0", "LABEL_1", "LABEL_2"
    $sentiment = $responseBody[0][0]['label'];

        // Map sentiment labels to Positive, Neutral, or Negative
    $sentimentMap = [
        'LABEL_0' => 'Negative',
        'LABEL_1' => 'Neutral',
        'LABEL_2' => 'Positive',
    ];

  
    $sentimentText = $sentimentMap[$sentiment] ?? 'Unknown';

    // Update the database
    $updateStmt = $pdo->prepare("UPDATE feedback SET rating = :sentiment WHERE id = :response_id");
    $updateStmt->execute([
        ':sentiment' => $sentimentText,
        ':response_id' => $responseId,
    ]);

    // echo "Processed response ID $responseId with sentiment: $sentimentText\n";
    header("Location: feedback/add");
}
