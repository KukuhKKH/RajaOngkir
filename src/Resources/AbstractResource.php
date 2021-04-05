<?php

namespace KukuhKKH\RajaOngkir\Resources;

abstract class AbstractResource
{
    /** @var array */
    protected $result = [];

    /** @var \KukuhKKH\RajaOngkir\HttpClients\AbstractClient */
    protected $httpClient;

    public function get(): array
    {
        return $this->result;
    }
}
