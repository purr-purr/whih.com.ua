<?php

include_once '../classes/XMLComposer.php';
include_once '../classes/SendRequest.php';

// Init variables
$merchantID = '3808';
$signKey = 'fd2c3a6bd6161d0e99082267b378a789a1d49961';

$amount = $_POST['amount'];
$currency = $_POST['currency'];
$description = $_POST['description'];
$language = $_POST['language'];
$info = json_encode(array(
    'service_data' => (object) array(
        'Receiver' => 'БО "ВБФ "БЕЗ НАДІЇ СПОДІВАЮСЬ"',
        'ZKPO' => '40991205',
        'BankReciever' => 'АБ «УКРГАЗБАНК»',
        'AccReceiver' => 'UA093204780000026004924922916',
        'PayText' => 'Благодійна допомога для гуманітарних потреб України',
    ),
), JSON_UNESCAPED_UNICODE);

if (empty($amount)
    ||
    empty($currency)
    ||
    empty($info)
) {
    header("HTTP/1.1 500 Internal Server Error");
    die();
}

if (empty($description)) {
    $description = (($language == 'uk') ? 'Благодійна допомога' : 'Comment') . ' - ' . $_POST['name'];
} else {
    $description .= $_POST['name'];
}

$lifetime = 24;
$lang = ($language == 'uk') ? 'ru' : 'en';

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
            'good' => ($language == 'uk') ? 'https://whih.com.ua/successful-payment.html' : 'https://whih.com.ua/successful-payment_en.html',
            'bad' => ($language == 'uk') ? 'https://whih.com.ua/unsuccessful-payment.html' : 'https://whih.com.ua/unsuccessful-payment_en.html',
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

$xmlComposer = new XMLComposer($paymentData);
$xml = $xmlComposer->compose();
$json = SendRequest::send($xml);

echo $json;