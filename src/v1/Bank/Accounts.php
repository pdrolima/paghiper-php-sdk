<?php

namespace WebMaster\PagHiper\v1\Bank;

use WebMaster\PagHiper\Core\Request\Request;
use WebMaster\PagHiper\Core\Interfaces\BankAccountsInterface;

class Accounts implements BankAccountsInterface
{
    protected $accountsUri = '/bank_accounts/list/';

    /**
     * Lista as contas bancárias para saque via API.
     *
     * @return void
     */
    public function accounts()
    {
        $bankAccounts = new Request($this->accountsUri);

        return $bankAccounts->getResponse()['bank_account_list_request'];
    }
}
