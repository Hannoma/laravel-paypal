<?php

namespace Srmklive\PayPal\Traits\PayPalAPI;

trait IPN {

    public function verifyIPN(array $request) {
        $this->apiUrl = $this->config['ipn_url'];
        array_push($request, ['cmd' => '_notify-validate']);
        $this->options['json'] = $request;

        $this->verb = 'post';

        $this->options['headers']['User-Agent'] = 'PHP-IPN-Verification-Script';

        return $this->doPayPalRequest();
    }

}