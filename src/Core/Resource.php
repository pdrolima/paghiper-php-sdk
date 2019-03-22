<?php

namespace WebMaster\PagHiper\Core;

use WebMaster\PagHiper\PagHiper;

class Resource
{

    /**
     * @var \WebMaster\PagHiper\PagHiper;
     */
    protected $paghiper;

    public function __construct(PagHiper $paghiper)
    {
        $this->paghiper = $paghiper;
    }
}
