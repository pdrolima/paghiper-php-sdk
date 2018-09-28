<?php

namespace WebMaster\PagHiper\Core\Interfaces;

interface BankAccountsInterface
{
    /**
     * Lista as contas bancárias para saque via API.
     *
     * @return void
     */
    public function accounts();
}
