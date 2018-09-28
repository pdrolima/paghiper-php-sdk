<?php

namespace WebMaster\PagHiper\Core\Exceptions;

use Exception;

class PagHiperException extends Exception
{
    public function __construct(string $message, int $code)
    {
        parent::__construct($message, $code);
    }
}
