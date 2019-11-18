<?php

namespace WebMaster\PagHiper\Core\Payment;

use WebMaster\PagHiper\Core\Exceptions\PagHiperException;
use WebMaster\PagHiper\Core\Resource;

class Notification extends Resource
{
    const NOTIFICATION_ENDPOINT = '/transaction/notification/';

    /**
     *  Get notification response.
     *
     * @return array
     */
    public function response(string $notificationId, string $transactionId)
    {
        $paymentNotification = $this->paghiper->request(
            self::NOTIFICATION_ENDPOINT,
            [
                'notification_id' => $notificationId,
                'transaction_id' => $transactionId
            ]
        )['status_request'];

        if ($paymentNotification['result'] === 'reject') {
            throw new PagHiperException($paymentNotification['response_message'], 400);
        }

        return $paymentNotification;
    }
}
