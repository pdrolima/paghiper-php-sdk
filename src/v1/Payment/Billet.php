<?php

namespace WebMaster\PagHiper\v1\Payment;

use GuzzleHttp\Client;
use WebMaster\PagHiper\Core\Request\Request;
use WebMaster\PagHiper\Core\Interfaces\BilletInterface;
use WebMaster\PagHiper\Core\Configuration\Configuration;
use WebMaster\PagHiper\Core\Exceptions\PagHiperException;

class Billet implements BilletInterface
{
    protected $createUri = '/transaction/create/';
    protected $cancelUri = '/transaction/cancel/';

    /**
    * Create a new billet.
    *
    * @param array $data Billet data. Full list of all available data can be found at: https://dev.paghiper.com/reference#gerar-boleto
    * @return void
    */
    public function create(array $data)
    {
        $request = new Request($this->createUri, $data);

        $response = $request->getResponse()['create_request'];

        if ($response['result'] === 'reject') {
            throw new PagHiperException($response['response_message'], $response['http_code']);
        }

        return $response;
    }

    /**
    * Cancels a billet.
    *
    * @param string $transactionId Transaction ID to cancel.
    * @return boolean
    */
    public function cancel(string $transactionId)
    {
        $data = [
            'transaction_id' => $transactionId,
            'status' => 'canceled'
        ];

        $request = new Request($this->cancelUri, $data);

        $response = $request->getResponse()['cancellation_request'];

        if ($response['result'] === 'reject') {
            throw new PagHiperException($response['response_message'], $response['http_code']);
        }

        return $response;
    }
}
