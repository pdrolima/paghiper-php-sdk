<?php

namespace WebMaster\PagHiper\Core\Interfaces;

interface BilletInterface
{
    /**
     * Create a new billet.
     *
     * @param array $data Billet data. Full list of all available data can be found at: https://dev.paghiper.com/reference#gerar-boleto
     * @return void
     */
    public function create(array $data);

     /**
    * Cancels a billet.
    *
    * @param string $transactionId Transaction ID to cancel.
    * @return boolean
    */
    public function cancel(string $transactionId);
}
