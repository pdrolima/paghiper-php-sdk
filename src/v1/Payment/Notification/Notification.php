<?php

namespace WebMaster\PagHiper\v1\Payment\Notification;

use WebMaster\PagHiper\Core\Request\Request;
use WebMaster\PagHiper\Core\Interfaces\NotificationInterface;

class Notification implements NotificationInterface
{
    protected $notificationUri = '/transaction/notification/';

    public function response(array $data)
    {
        $notification = new Request($this->notificationUri, $data);

        return $notification->getResponse()['status_request'];
    }
}
