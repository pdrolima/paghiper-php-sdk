<?php

namespace WebMaster\PagHiper\Core\Payment;

use WebMaster\PagHiper\Core\Exceptions\PagHiperException;
use WebMaster\PagHiper\Core\Resource;

class Billet extends Resource
{
    const CREATE_ENDPOINT = '/transaction/create/';
    const CANCEL_ENDPOINT = '/transaction/cancel/';
    const STATUS_ENDPOINT = '/transaction/status/';
    const MULTIPLE_ENDPOINT = '/transaction/multiple_bank_slip';

    /**
    * Create a new billet.
    *
    * @param array $data Billet data.
    * @return void
    */
    public function create(array $data = [])
    {
        $createTransaction = $this->paghiper->request(
            self::CREATE_ENDPOINT,
            $data
        )['create_request'];

        if ($createTransaction['result'] === 'reject') {
            throw new PagHiperException($createTransaction['response_message'], 400);
        }

        return $createTransaction;
    }

    /**
    * Cancel a billet with the given transaction ID.
    *
    * @param string $transactionId Transaction ID to cancel.
    * @return void
    */
    public function cancel(string $transaction_id)
    {
        $cancelTransaction = $this->paghiper->request(
            self::CANCEL_ENDPOINT,
            [
                'transaction_id' => $transaction_id,
                'status' => 'canceled'
            ]
        )['cancellation_request'];

        if ($cancelTransaction['result'] === 'reject') {
            throw new PagHiperException($cancelTransaction['response_message'], 400);
        }

        return $cancelTransaction;
    }

    /**
     * Retrieves billet status with the given transaction ID.
     *
     * @param   string  $transaction_id
     * @return void
     */
    public function status(string $transaction_id)
    {
        $transactionStatus = $this->paghiper->request(
            self::STATUS_ENDPOINT,
            [
                'transaction_id' => $transaction_id,
            ]
        )['status_request'];

        if ($transactionStatus['result'] === 'reject') {
            throw new PagHiperException($transactionStatus['response_message'], 400);
        }

        return $transactionStatus;
    }

    /**
     * Generate multiple billets with the given transaction IDs.
     *
     * @param   array   $transactions  Array containing transaction IDs.
     * @param   string  $type          How PDF should be generated: 'boletoCarne' (default) generates a PDF in 'carnê' format
     * (3 billets per page) or 'boletoA4'.
     *
     * @return void
     */
    public function multiple(array $transactions = [], string $type = 'boletoCarne')
    {
        $multipleBillets = $this->paghiper->request(
            self::MULTIPLE_ENDPOINT,
            [
                'transactions' => $transactions,
                'type_bank_slip' => $type
            ]
        )['status_request'];

        if ($multipleBillets['result'] === 'reject') {
            throw new PagHiperException($multipleBillets['response_message'], 400);
        }

        return $multipleBillets;
    }
}
