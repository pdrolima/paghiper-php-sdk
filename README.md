# Biblioteca de integração PagHiper para PHP

[![StyleCI](https://github.styleci.io/repos/150681419/shield?branch=master)](https://github.styleci.io/repos/150681419)
[![Maintainability](https://api.codeclimate.com/v1/badges/a99a88d28ad37a79dbf6/maintainability)](https://codeclimate.com/github/webmasterdro/paghiper-php-sdk/maintainability)

## Descrição

Utilizando essa biblioteca você pode integrar o PagHiper no seu sistema e utilizar os recursos que o PagHiper fornece em sua API, deixando seu código mais legível e manutenível.

**Esta biblioteca tem suporte aos seguintes recursos:**
- [Emissão de boleto](https://dev.paghiper.com/reference#gerar-boleto)
- [Cancelamento de boleto](https://dev.paghiper.com/reference#boleto)
- [Consultar status do boleto](https://dev.paghiper.com/reference#status-do-boleto)
- [Receber notificações automáticas (Retorno Automático)](https://dev.paghiper.com/reference#qq)
- [Realizar saques para conta bancária](https://dev.paghiper.com/reference#testinput)
- [Listar contas bancárias](https://dev.paghiper.com/reference#lista-contas-banc%C3%A1rias-para-saque-via-api)
- [Listar transações](https://dev.paghiper.com/reference#listar-transa%C3%A7%C3%B5es-via-api-1)
- [Múltiplos boletos](https://dev.paghiper.com/reference#multiplos-boletos-unico-pdf)

## Instalação

### Compatibilidade

 Versão | webmasterdro/paghiper-php-sdk | PHP | guzzlehttp/guzzle
:---------|:----------|:----------|:----------
 **3.x**  | `composer require webmasterdro/paghiper-php-sdk:^3.0` | PHP >= 7.2 | Guzzle >= 7
 2.x  | `composer require webmasterdro/paghiper-php-sdk:^2.0` | PHP >= 5.6 | Guzzle >= 6.3.x < 7.0.0


Execute o comando

```php
composer require webmasterdro/paghiper-php-sdk:^2.0
```

## Utilizando

Antes de utilizar, obtenha suas credenciais (`apiKey` e `token`) em [https://www.paghiper.com/painel/credenciais/](https://www.paghiper.com/painel/credenciais/)

### Emissão de Boleto

**Para emitir um boleto você pode fazer da seguinte maneira:**

```php
use WebMaster\PagHiper\PagHiper;

$paghiper = new PagHiper('api_key', 'token');
$transaction = $paghiper->billet()->create([
    'order_id' => 'ABC-456-789',
    'payer_name' => 'Pedro Lima',
    'payer_email' => 'comprador@email.com',
    'payer_cpf_cnpj' => '1234567891011',
    'type_bank_slip' => 'boletoa4',
    'days_due_date' => '3',
    'items' => [[
        'description' => 'Macbook',
        'quantity' => 1,
        'item_id' => 'e24fc781-f543-4591-a51c-dde972e8e0af',
        'price_cents' => '1000'
    ]]
]);
```

Você pode obter a lista de dados que você pode enviar no seguinte link: [https://dev.paghiper.com/reference#gerar-boleto](https://dev.paghiper.com/reference#gerar-boleto)

**Para cancelar um boleto:**

```php
$transaction = $paghiper->billet()->cancel('JKP03X9KN0RELVLH');
```
**Para consultar o status de um boleto:**

```php
$transaction = $paghiper->billet()->status('JKP03X9KN0RELVLH');
```

**Para gerar múltiplos boletos em único PDF:**

```php
$transaction = $paghiper->billet()->multiple([
    'id_transacao'
], 'boletoCarne');
```

**Para obter informações do pagamento via retorno automático:**

```php
$transaction = $paghiper->notification()->response($_POST['notification_id'], $_POST['idTransacao']);
```

**Para obter a lista de suas contas bancárias:**

```php
$banckAccounts = $paghiper->banking()->accounts();
```

**Para realizar um saque:**

```php
$banckAccounts = $paghiper->banking()->withdraw('id_conta_bancaria');
```
