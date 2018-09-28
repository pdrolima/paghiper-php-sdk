<?php

namespace WebMaster\PagHiper\Core\Interfaces;

interface NotificationInterface
{
    /**
     * Get notification's response.
     *
     * @param string $notificationId
     * @param string $transactionId
     * @return void
     */
    public function response(string $notificationId = '', string $transactionId = '');
}
