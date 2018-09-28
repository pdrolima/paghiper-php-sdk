<?php

namespace WebMaster\PagHiper\v1\Payment\Notification;

use WebMaster\PagHiper\Core\Request\Request;
use WebMaster\PagHiper\Core\Exceptions\PagHiperException;
use WebMaster\PagHiper\Core\Interfaces\NotificationInterface;

class Notification implements NotificationInterface
{
    protected $notificationUri = '/transaction/notification/';

    /**
     *  Get notification's response.
     *
     * @return void
     */
    public function response(string $notificationId = '', string $transactionId = '')
    {
        $notification = new Request($this->notificationUri, [
            'notification_id' => $notificationId,
            'transaction_id' => $transactionId
        ]);

        $response = $notification->getResponse()['status_request'];

        if ($response['result'] === 'reject') {
            throw new PagHiperException($response['response_message'], $response['http_code']);
        }

        return $response;
    }
}
