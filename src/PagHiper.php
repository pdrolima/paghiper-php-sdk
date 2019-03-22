<?php

namespace WebMaster\PagHiper;

use WebMaster\PagHiper\Core\Payment\Billet;
use WebMaster\PagHiper\Core\Payment\Notification;
use WebMaster\PagHiper\Core\Bank\Banking;
use GuzzleHttp\Client;

class PagHiper
{
    /**
     * @var  WebMaster\PagHiper\Core\Payment\Billet;
     */
    private $billet;

    /**
     * @var WebMaster\PagHiper\Core\Payment\Notification;
     */
    private $notification;

    /**
     * @var WebMaster\PagHiper\Core\Bank\Banking;
     */
    private $banking;

    /**
     * @var array PagHiper credentials
     */
    private $credentials;

    /**
     * @var GuzzleHttp\Client;
     */
    private $client;


    public function __construct(
        $apiKey,
        $token
    ) {
        $this->credentials = [
            'apiKey' => $apiKey,
            'token' => $token
        ];

        $this->client = new Client([
            'base_uri' => 'http://api.paghiper.com',
            'defaults' => [
                'headers' => [
                    'Accept' => 'application/json',
                    'Accept-Charset' => 'UTF-8',
                    'Accept-Encoding' => 'application/json',
                    'Content-Type' => 'application/json'
                ],
            ],
        ]);


        $this->billet = new Billet($this);
        $this->banking = new Banking($this);
        $this->notification = new Notification($this);
    }

    /**
     * Send a request to PagHiper's API.
     *
     * @param  string  $uri  Endpoint
     * @param  array  $params Data for the given endpoint.
     */
    public function request($uri, $data = [])
    {
        $data = array_merge($this->credentials, $data);

        try {
            $response = $this->client->request(
                'POST',
                $uri,
                ['json' => $data]
            );

            return json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * @var WebMaster\PagHiper\Core\Payment\Billet;
     */
    public function billet()
    {
        return $this->billet;
    }

    /**
     * @var WebMaster\PagHiper\Core\Payment\Notification;
     */
    public function notification()
    {
        return $this->notification;
    }

    /**
     * @var WebMaster\PagHiper\Core\Bank\Banking;
     */
    public function banking()
    {
        return $this->banking;
    }
}
