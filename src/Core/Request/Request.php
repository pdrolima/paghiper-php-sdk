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
     * Send a request to PagHiper's API.
     *
     * @param string $endpoint API resource (exemplo: /transaction/create/)
     * @param array $params Resource params. Can be found at: https://dev.paghiper.com/reference
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

        //  Add token and apiKey
        $params = array_merge([
            'token' => $credentials::TOKEN,
            'apiKey' => $credentials::API_KEY,
        ], $params);

        // Send the request
        $request = $client->request('POST', $endpoint, [
            'json' => $params,
        ]);

        $this->response = json_decode($request->getBody(), true);

        return $this;
    }

    /**
     * Get PagHiper's response.
     *
     * @return void
     */
    public function getResponse() : array
    {
        return $this->response;
    }
}
