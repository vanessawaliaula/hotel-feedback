<?php
// Hugging Face API Token
$apiToken = "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";

// Database connection
$pdo = new PDO('mysql:host=localhost;dbname=hotel_feedback', 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch responses
$stmt = $pdo->query("SELECT id AS response_id, feedback AS response_text FROM feedback WHERE id = 1");
$responses = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($responses as $response) {
    $responseId = $response['response_id'];
    $responseText = $response['response_text'];

    // cURL setup
    $url = 'https://api-inference.huggingface.co/models/cardiffnlp/twitter-roberta-base-sentiment';
    $headers = [
        'Authorization: Bearer ' . $apiToken,
        'Content-Type: application/json'
    ];

    $data = [
        'inputs' => $responseText,
    ];

    // Initialize cURL session
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute the request and get the response
    $responseBody = curl_exec($ch);

    // Check if the request was successful
    if(curl_errno($ch)) {
        echo 'cURL error: ' . curl_error($ch);
    }

    // Close cURL session
    curl_close($ch);

    // Decode the response
    $responseBody = json_decode($responseBody, true);

    // Check if 'label' exists in the response
    if (isset($responseBody[0]['label'])) {
        $sentiment = $responseBody[0]['label']; // Extract sentiment
        // $sentiment = $responseBody[0][0]['label'];

        // Map sentiment labels to Positive, Neutral, or Negative
        $sentimentMap = [
            'LABEL_0' => 'Negative',
            'LABEL_1' => 'Neutral',
            'LABEL_2' => 'Positive',
        ];
        $sentimentText = $sentimentMap[$sentiment] ?? 'Unknown';

        // Update the database
        $updateStmt = $pdo->prepare("UPDATE feedback SET feedback = :sentiment WHERE id = :response_id");
        $updateStmt->execute([
            ':sentiment' => $sentimentText,
            ':response_id' => $responseId,
        ]);

        echo "Processed response ID $responseId with sentiment: $sentimentText\n";
    } else {
        echo "Unexpected API response: ";
        print_r($responseBody);
        die();
    }
}
