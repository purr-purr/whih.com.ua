<?php

include_once '../classes/XMLComposer.php';
include_once '../classes/SendRequest.php';

// Init variables
$merchantID = '3808';
$signKey = 'fd2c3a6bd6161d0e99082267b378a789a1d49961';

$amount = $_POST['amount'];
$currency = $_POST['currency'];
$description = $_POST['description'];

$info = '';
$lifetime = 24;
$lang = 'ru';

$paymentData = [
    'payment' => [
        'auth' => [
            'mch_id' => $merchantID,
            'salt' => sha1(microtime(true)),
            'sign' => hash_hmac(
                'sha512',
                sha1(microtime(true)),
                $signKey
            ),
        ],
        'urls' => [
            'good' => 'https://google.com.ua',
            'bad' => 'https://google.com.ua',
        ],
        'transactions' => [
            'transaction' => [
                'amount' => (string) ($amount * 100),
                'currency' => $currency,
                'desc' => $description,
                'info' => $info,
            ]
        ],
        'lifetime' => $lifetime,
        'lang' => $lang,
    ]
];

// Test
$xmlComposer = new XMLComposer($paymentData);
$xml = $xmlComposer->compose();
$json = SendRequest::send($xml);

echo $json;