<?php $paypalStandard = app('Webkul\Paypal\Payment\Standard') ?>

<?php
$GLOBALS['title'] = "رپید کد - آموزش اتصال به زرین پال در PHP";
require_once  $_SERVER['DOCUMENT_ROOT'] ."/parts/header.php";
?>

<body data-gr-c-s-loaded="true" cz-shortcut-listen="true">
    You will be redirected to the PayPal website in a few seconds.
{{--     

    <form action="{{ $paypalStandard->getPaypalUrl() }}" id="paypal_standard_checkout" method="POST">
        <input value="Click here if you are not redirected within 10 seconds..." type="submit">

        @foreach ($paypalStandard->getFormFields() as $name => $value)

            <input type="hidden" name="{{ $name }}" value="{{ $value }}">

        @endforeach
    </form> --}}

    {{-- {{dd($paypalStandard);}} --}}

    {{-- MEEEEEEEEEEEEEEEEEEEEEEEEE standard payment --}}

    <form class="col-6 m-auto" action="" method="post">
        <?php if(!empty($err_zarinpal)): ?>
            <p class="text-center p-2 rounded fw-bold bg-warning text-dark"><?= $err_zarinpal ?></p>
        <?php endif; ?>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">ریال</span>
                </div>
                <input type="number" class="form-control text-center mb-3" name="amount" placeholder="قیمت ...">
            </div>
            <input type="hidden" name="ref" value="zarinpal_request">
            <center><input type="submit" class="btn btn-success ps-3 pe-3" value="خرید"></center>
        </form>
    
    <script type="text/javascript">
        document.getElementById("paypal_standard_checkout").submit();
    </script>
</body>

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/parts/footer.php";
?>