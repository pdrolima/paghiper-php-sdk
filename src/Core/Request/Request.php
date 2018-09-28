<?php

namespace WebMaster\PagHiper\Core\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use WebMaster\PagHiper\Core\Configuration\Configuration;

class Request
{
    /**
     * @var $response
     */
    protected $response;

    /**
     * Envia uma requisição para a API do PagHiper
     *
     * @param string $endpoint Recurso da API (exemplo: /transaction/create/)
     * @param array $params Parâmetros necessários para o endpoint. https://dev.paghiper.com/reference
     */
    public function __construct(string $endpoint = '', array $params = [])
    {
        $credentials = new Configuration();
        $client = new Client([
            'base_uri' => 'https://api.paghiper.com',
            'defaults' => [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Charset' => 'UTF-8',
                    'Accept-Encoding' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
            ],
        ]);

        // Acrescenta o token e apiKey
        $params = array_merge([
            'token' => $credentials::TOKEN,
            'apiKey' => $credentials::API_KEY,
        ], $params);

        $request = $client->request('POST', $endpoint, [
            'json' => $params,
        ]);

        $this->response = json_decode($request->getBody(), true);

        return $this;
    }

    /**
     * Pega a resposta do PagHiper
     *
     * @return void
     */
    public function getResponse() : array
    {
        return $this->response;
    }
}
