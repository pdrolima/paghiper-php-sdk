<?php

namespace WebMaster\PagHiper\Core\Interfaces;

interface BoletoInterface
{
    /**
     * Realiza a emissão do boleto
     *
     * @param array $data Dados para geração do boleto. Os dados necessários para gerar o boleto
     * podem ser encontrados em: https://dev.paghiper.com/reference#gerar-boleto
     * @return void
     */
    public function create(array $data);

    /**
     * Efetua o cancelamento boleto.
     *
     * @param array $data Dados para cancelamento do boleto. Os dados para cancelar o boleto podem ser encontrados em:
     * https://dev.paghiper.com/reference#boleto
     * @return boolean
     */
    public function cancel(array $data);
}
