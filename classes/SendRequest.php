<?php

class SendRequest
{
    private const API_URL = "https://api.ipay.ua";

    public static function send($data) {
        // Sending data
        $ch = curl_init();

        $headers = array(
            "Content-Type: application/x-www-form-urlencoded",
        );

        curl_setopt($ch, CURLOPT_URL, self::API_URL);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, 'data=' . $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        // Receive server response
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        curl_close ($ch);

        $parsedXML = simplexml_load_string($server_output, "SimpleXMLElement", LIBXML_NOCDATA);

        return json_encode($parsedXML);
    }
}