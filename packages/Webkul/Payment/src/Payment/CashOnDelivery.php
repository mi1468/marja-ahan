<?php

namespace Webkul\Payment\Payment;

class CashOnDelivery extends Payment
{
    /**
     * Payment method code
     *
     * @var string
     */
    protected $code  = 'cashondelivery';

    public function getRedirectUrl()
    {
        // MEEEEEEEEEEEEEEEEEEEEEEEEEEE CashOnDelivery
        return "https://zarinp.al/youngengineer.ir";
    }
}