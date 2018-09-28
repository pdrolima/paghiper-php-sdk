# Biblioteca de integração PagHiper para PHP

[![StyleCI](https://github.styleci.io/repos/150681419/shield?branch=master)](https://github.styleci.io/repos/150681419)
[![Maintainability](https://api.codeclimate.com/v1/badges/a99a88d28ad37a79dbf6/maintainability)](https://codeclimate.com/github/webmasterdro/paghiper-php-sdk/maintainability)

Se você estiver usando o Laravel [(clique aqui) :fire:](https://github.com/webmasterdro/paghiper-laravel)

## Descrição

Utilizando essa biblioteca você pode integrar o PagHiper no seu sistema e utilizar os recursos que o PagHiper fornece em sua API, deixando seu código mais legível e manutenível.

**Esta biblioteca tem suporte aos seguintes recursos:**
- [Emissão de boleto](https://dev.paghiper.com/reference#gerar-boleto)
- [Cancelamento de boleto](https://dev.paghiper.com/reference#boleto)
- [Receber notificações automáticas (Retorno Automático)](https://dev.paghiper.com/reference#qq)
- [Listar contas bancárias](https://dev.paghiper.com/reference#lista-contas-banc%C3%A1rias-para-saque-via-api)

## Instalação

Você pode instalar a biblioteca via composer:

```
composer require webmasterdro/paghiper-php-sdk
```

Adicione suas credenciais (`token` e `apiKey`) em `src\Core\Configuration\Configuration.php`.(Para obtê-las basta ir no seu painel:  [https://www.paghiper.com/painel/credenciais/](https://www.paghiper.com/painel/credenciais/))

## Utilizando

### Emissão de Boleto

**Para emitir um boleto você pode fazer da seguinte maneira:**

```php
use WebMaster\PagHiper\PagHiper;

$pagHiper = new PagHiper();
$transaction = $pagHiper->billet()->create([
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
use WebMaster\PagHiper\PagHiper;

$pagHiper = new PagHiper();
$transaction = $pagHiper->billet()->cancel('JKP03X9KN0RELVLH');
```

**Para obter informações do pagamento via retorno automático:**

```php
use WebMaster\PagHiper\PagHiper;

$pagHiper = new PagHiper();
$transaction = $pagHiper->notification()->response($_POST['notification_id'], $_POST['idTransacao']);
``` 

**Para obter a lista de suas contas bancárias:**

```php
use WebMaster\PagHiper\PagHiper;

$pagHiper = new PagHiper();
$banckAccounts = $pagHiper->bank()->accounts();
``` 