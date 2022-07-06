<?php

// Init variables
$amount = '55';
$currency = 'UAH';
$description = 'desc';
$info = '';

$paymentData = (object) [
    'merchId' => '2023',
    'signKey' => '',
    'amount' => $amount,
    'currency' => $currency,
    'description' => $description,
    'info' => $info,
    'lifetime' => 24,
    'lang' => 'uk'
];

$apiURL = 'https://api.ipay.ua';

function composeXMLBody($paymentData) {
    $salt = sha1(microtime(true));

    // Create XML
    $body = xmlwriter_open_memory();

    // Indents, pre-setup
    xmlwriter_set_indent($body, 1);
    xmlwriter_set_indent_string($body, '    ');
    xmlwriter_start_document($body, '1.0', 'UTF-8');

    // 'payment' element
    xmlwriter_start_element($body, 'payment');
    // 'auth' element
    xmlwriter_start_element($body, 'auth');
    // 'mch_id' element
    xmlwriter_start_element($body, 'mch_id');
    xmlwriter_text($body, $paymentData->merchId);
    xmlwriter_end_element($body);
    // 'salt' element
    xmlwriter_start_element($body, 'salt');
    xmlwriter_text($body, $salt);
    xmlwriter_end_element($body);
    // 'sign'
    xmlwriter_start_element($body, 'sign');
    xmlwriter_text($body, hash_hmac('sha512', $salt, $paymentData->signKey));
    xmlwriter_end_element($body);
    // End 'auth'
    xmlwriter_end_element($body);

    // 'urls' element
    xmlwriter_start_element($body, 'urls');
    // 'good' element
    xmlwriter_start_element($body, 'good');
    xmlwriter_text($body, 'good');
    xmlwriter_end_element($body);
    // 'bad' element
    xmlwriter_start_element($body, 'bad');
    xmlwriter_text($body, 'bad');
    xmlwriter_end_element($body);
    // End 'urls'
    xmlwriter_end_element($body);

    // 'transactions' element
    xmlwriter_start_element($body, 'transactions');
    // 'transaction' element
    xmlwriter_start_element($body, 'transaction');
    // 'amount' element
    xmlwriter_start_element($body, 'amount');
    xmlwriter_text($body, $paymentData->amount);
    xmlwriter_end_element($body);
    // 'currency' element
    xmlwriter_start_element($body, 'currency');
    xmlwriter_text($body, $paymentData->currency);
    xmlwriter_end_element($body);
    // 'desc' element
    xmlwriter_start_element($body, 'desc');
    xmlwriter_text($body, $paymentData->description);
    xmlwriter_end_element($body);
    // 'info' element
    xmlwriter_start_element($body, 'info');
    xmlwriter_text($body, $paymentData->info);
    xmlwriter_end_element($body);
    // End 'transaction'
    xmlwriter_end_element($body);
    // End 'transactions'
    xmlwriter_end_element($body);

    // 'lifetime' element
    xmlwriter_start_element($body, 'lifetime');
    xmlwriter_text($body, $paymentData->lifetime);
    xmlwriter_end_element($body);
    // 'lang' element
    xmlwriter_start_element($body, 'lang');
    xmlwriter_text($body, $paymentData->lang);
    xmlwriter_end_element($body);

    // End 'payment'
    xmlwriter_end_element($body);

    // End document
    xmlwriter_end_document($body);

    return xmlwriter_output_memory($body);
}

function sendPaymentData($url, $requestData) {
    // Sending data
    $ch = curl_init();

    $headers = array(
        "Content-Type: application/x-www-form-urlencoded",
    );

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "data=$requestData");

    // Receive server response
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $server_output = curl_exec($ch);
    curl_close ($ch);

    return $server_output;
}

// Test
$data = composeXMLBody($paymentData);
$result = sendPaymentData($apiURL, $data);

echo $result;