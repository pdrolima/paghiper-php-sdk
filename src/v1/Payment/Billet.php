<?php

namespace WebMaster\PagHiper\v1\Payment;

use GuzzleHttp\Client;
use WebMaster\PagHiper\Core\Request\Request;
use WebMaster\PagHiper\Core\Interfaces\BoletoInterface;
use WebMaster\PagHiper\Core\Configuration\Configuration;
use WebMaster\PagHiper\Core\Exceptions\PagHiperException;

class Billet implements BoletoInterface
{
    protected $createUri = '/transaction/create/';
    protected $cancelUri = '/transaction/cancel/';

    /**
     * Realiza a emissão do boleto
     *
     * @param array $data Dados para geração do boleto. Os dados necessários para gerar o boleto
     * podem ser encontrados em: https://dev.paghiper.com/reference#gerar-boleto
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
    * Efetua o cancelamento boleto.
    *
    * @param array $data Dados para cancelamento do boleto. Os dados para cancelar o boleto podem ser encontrados em:
    * https://dev.paghiper.com/reference#boleto
    * @return boolean
    */
    public function cancel(array $data)
    {
        // Define o status da transação com 'canceled'
        $data = array_merge([
            'status' => 'canceled'
        ], $data);

        $request = new Request($this->cancelUri, $data);

        return $request->getResponse()['cancellation_request'];
    }
}
