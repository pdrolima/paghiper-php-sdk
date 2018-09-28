<?php

namespace WebMaster\PagHiper\Core\Interfaces;

interface NotificationInterface
{
    /**
     *  Pega a resposta da notificação (retorno automático) do PagHiper.
     *
     * @return void
     */
    public function response(array $data);
}
