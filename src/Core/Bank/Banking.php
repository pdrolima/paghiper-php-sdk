<?php

namespace WebMaster\PagHiper\Core\Bank;

use WebMaster\PagHiper\Core\Exceptions\PagHiperException;
use WebMaster\PagHiper\Core\Resource;

class Banking extends Resource
{
    const ACCOUNTS_ENDPOINT = '/bank_accounts/list/';
    const CASHOUT_ENDPOINT = '/bank_accounts/cash_out/';

    /**
    * Withdraw cash to the given bank account.
    *
    * @param string $transactionId Transaction ID to cancel.
    * @return array
    */
    public function accounts()
    {
        $accountsList = $this->paghiper->request(
            self::ACCOUNTS_ENDPOINT
        )['bank_account_list_request'];

        if ($accountsList['result'] === 'reject') {
            throw new PagHiperException($accountsList['response_message'], 400);
        }

        return $accountsList;
    }

    /**
    * Withdraw cash to the given bank account.
    *
    * @param string $transactionId Transaction ID to cancel.
    * @return array
    */
    public function withdraw(int $bank_account_id)
    {
        $withdraw = $this->paghiper->request(
            self::CASHOUT_ENDPOINT,
            [
                'bank_account_id' => $bank_account_id
            ]
        )['cash_out_request'];

        if ($withdraw['result'] === 'reject') {
            throw new PagHiperException($withdraw['response_message'], 400);
        }

        return $withdraw;
    }
}
