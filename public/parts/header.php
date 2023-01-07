<?php require_once $_SERVER['DOCUMENT_ROOT'] ."/inc/functions.php" ?>
<?php


if (!empty($_POST['ref'])) {
  
    if ($_POST['ref'] == "zarinpal_request") {
        if (!empty($_POST['amount']) && is_numeric($_POST['amount'])) {
            $res = requestZarinPal($_POST['amount'] , 194);
            $authority = $res['data']['authority'] ?? false;
            if ($res['data'] && $authority) {
                $url = payZarinPal($authority);
                header("Location: {$url}");
            } else {
                $err_zarinpal = "خطا در اتصال به زرین پال";
            }
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title><?= $GLOBALS['title'] ?></title>
</head>

<body>
    <div class="container mt-5">