<?php
$GLOBALS['title'] = "رپید کد - آموزش اتصال به زرین پال در PHP";
require_once $_SERVER['DOCUMENT_ROOT'] . "/parts/header.php";

$authority = $_GET['Authority'] ?? null;
$amount = $_GET['amount'] ?? null;

$message = [
    "text" => "",
    "css_class" => ""
];


if ($authority && ($amount && is_numeric($amount))) {
    $res = verifyZarinPal($authority, $amount);

    /*
    $res['data']['code'] :
        100 -> Paid (first time page seen)
        101 -> Verified (second time or more)
    */

    if (!empty($res['data']['code']) && ($res['data']['code'] == 100 || $res['data']['code'] == 101)) {
        $amount_currency = $amount/10 . " تومان";
        $message['text'] = "خرید موفق به مبلغ {$amount_currency}";
        $message['css_class'] = "bg-success text-white";
    } else {
        $message['text'] = "خرید ناموفق";
        $message['css_class'] = "bg-danger";
    }
} else {
    $message['text'] = "پارامتر نامعتبر";
    $message['css_class'] = "bg-danger";
}

?>

<p class="text-center p-2 rounded fw-bold <?= $message['css_class'] ?>"><?= $message['text'] ?></p>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/parts/footer.php";
?>