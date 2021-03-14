<?php

namespace WebMaster\PagHiper\Core\Pix;

use WebMaster\PagHiper\Core\Resource;
use WebMaster\PagHiper\Core\Exceptions\PagHiperException;

class Pix extends Resource
{
    const PIX_CREATE_ENDPOINT = '/invoice/create';
    const PIX_CANCEL_ENDPOINT = '/invoice/cancel';
    const PIX_STATUS_ENDPOINT = '/invoice/status';
    const PIX_NOTIFICATION_ENDPOINT = '/invoice/notification';


    public function create(array $data)
    {
        $createTransaction = $this->paghiper->request(
            static::PIX_CREATE_ENDPOINT,
            $data
        );

        if ($createTransaction['pix_create_request']['result'] === 'reject') {
            throw new PagHiperException($createTransaction['response_message'], 400);
        }

        return $createTransaction;
    }

    public function cancel(string $transaction_id)
    {
        $cancelTransaction = $this->paghiper->request(
            self::PIX_CANCEL_ENDPOINT,
            [
                'transaction_id' => $transaction_id,
                'status' => 'canceled'
            ]
        )['cancellation_request'];

        if ($cancelTransaction['pix_create_request']['result'] === 'reject') {
            throw new PagHiperException($cancelTransaction['response_message'], 400);
        }

        return $cancelTransaction;
    }

    public function status(string $transaction_id)
    {
        $transactionStatus = $this->paghiper->request(
            self::PIX_STATUS_ENDPOINT,
            [
                'transaction_id' => $transaction_id,
            ]
        )['status_request'];

        if ($transactionStatus['pix_create_request']['result'] === 'reject') {
            throw new PagHiperException($transactionStatus['response_message'], 400);
        }

        return $transactionStatus;
    }

    /**
     *  Get notification response.
     *
     * @return array
     */
    public function notification(string $notificationId, string $transactionId)
    {
        $paymentNotification = $this->paghiper->request(
            static::PIX_NOTIFICATION_ENDPOINT,
            [
                'notification_id' => $notificationId,
                'transaction_id' => $transactionId
            ]
        )['status_request'];

        if ($paymentNotification['pix_create_request']['result'] === 'reject') {
            throw new PagHiperException($paymentNotification['response_message'], 400);
        }

        return $paymentNotification;
    }
}
