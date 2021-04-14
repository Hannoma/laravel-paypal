<?php

namespace Srmklive\PayPal\Traits\PayPalAPI;

use Throwable;

trait BillingAgreement
{
    /**
     * Create a new billing agreement token.
     *
     * @param array $data
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws Throwable
     *
     * @see https://developer.paypal.com/docs/api/payments.billing-agreements/v1/
     */
    public function requestBillingAgreementToken(array $data)
    {
        $this->apiEndPoint = 'v1/billing-agreements/agreement-tokens';
        $this->apiUrl = collect([str_replace('api', 'api-m', $this->config['api_url']), $this->apiEndPoint])->implode('/');
        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Create a new billing agreement.
     *
     * @param array $data
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @throws Throwable
     *
     * @see https://developer.paypal.com/docs/api/payments.billing-agreements/v1/
     */
    public function createBillingAgreement(array $data)
    {
        $this->apiEndPoint = 'v1/billing-agreements/agreements';
        $this->apiUrl = collect([str_replace('api', 'api-m', $this->config['api_url']), $this->apiEndPoint])->implode('/');
        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    /**
     * Show details for an existing billing agreement.
     *
     * @param string $agreement_id
     *
     * @throws \Throwable
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @see https://developer.paypal.com/docs/api/subscriptions/v1/#plans_get
     */
    public function showBillingAgreementDetails($agreement_id)
    {
        $this->apiEndPoint = "v1/billing-agreements/agreements/{$agreement_id}";
        $this->apiUrl = collect([str_replace('api', 'api-m', $this->config['api_url']), $this->apiEndPoint])->implode('/');

        $this->verb = 'get';

        return $this->doPayPalRequest();
    }

    /**
     * Cancel an existing billing agreement.
     *
     * @param string $agreement_id
     *
     * @throws \Throwable
     *
     * @return array|\Psr\Http\Message\StreamInterface|string
     *
     * @see https://developer.paypal.com/docs/api/subscriptions/v1/#plans_get
     */
    public function cancelBillingAgreementDetails($agreement_id)
    {
        $this->apiEndPoint = "v1/billing-agreements/agreements/{$agreement_id}/cancel";
        $this->apiUrl = collect([str_replace('api', 'api-m', $this->config['api_url']), $this->apiEndPoint])->implode('/');

        $this->verb = 'post';

        return $this->doPayPalRequest(false);
    }

    public function makeReferenceTransaction($data)
    {
        $this->apiEndPoint = 'v1/payments/payment';
        $this->apiUrl = collect([str_replace('api', 'api-m', $this->config['api_url']), $this->apiEndPoint])->implode('/');
        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

    public function refundPaymentV1($payment_id, $data)
    {
        $this->apiEndPoint = "v1/payments/sale/{$payment_id}/refund";
        $this->apiUrl = collect([str_replace('api', 'api-m', $this->config['api_url']), $this->apiEndPoint])->implode('/');
        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPayPalRequest();
    }

}