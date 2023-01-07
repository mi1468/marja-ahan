<?php

define("ZARINPAL_MERCHANT_ID", "محل مرچنت آیدی");

function httpRequestPost(string $url, array $body_list = [])
{
    $body = json_encode($body_list);
    $body_length = strlen($body);

    $opts = array(
        'http' =>
        array(
            'method'  => 'POST',
            'header'  => "Content-Type: application/json\r\n" . "Content-Length: {$body_length}\r\n",
            'content' => $body,
            'timeout' => 60
        )
    );

    $context  = stream_context_create($opts);
    $result = @file_get_contents($url, false, $context);

    if ($result) $result = json_decode($result, true);

    return $result;
}

function requestZarinPal($amount, $order_id, $description = "")
{
    $body = array(
        "merchant_id" => ZARINPAL_MERCHANT_ID,
        "amount" => $amount,
        "callback_url" => "http://example.com/payment/zarinpal.php?order_id={$order_id}&amount={$amount}",
        "description" => $description ? $description : "خرید از وبسایت رپید کد",
        "metadata" => [],
    );

    $res = httpRequestPost('https://api.zarinpal.com/pg/v4/payment/request.json', $body);
    return $res;
}

function payZarinPal($authority)
{
    $action_url = "https://www.zarinpal.com/pg/StartPay/" . $authority;
    return $action_url;
}

function verifyZarinPal($authority, $amount)
{
    $body = array(
        "merchant_id" => ZARINPAL_MERCHANT_ID,
        "amount" => $amount,
        "authority" => $authority
    );

    $res = httpRequestPost('https://api.zarinpal.com/pg/v4/payment/verify.json', $body);

    return $res;
}
