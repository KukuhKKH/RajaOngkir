<?php

namespace KukuhKKH\RajaOngkir;

use KukuhKKH\RajaOngkir\Contracts\HttpClientContract;
use KukuhKKH\RajaOngkir\Contracts\SearchDriverContract;
use KukuhKKH\RajaOngkir\HttpClients\AbstractClient;
use KukuhKKH\RajaOngkir\HttpClients\BasicClient;
use KukuhKKH\RajaOngkir\Resources\Kota;
use KukuhKKH\RajaOngkir\Resources\OngkosKirim;
use KukuhKKH\RajaOngkir\Resources\Provinsi;
use KukuhKKH\RajaOngkir\SearchDrivers\AbstractDriver;
use KukuhKKH\RajaOngkir\SearchDrivers\BasicDriver;
use KukuhKKH\RajaOngkir\Resources\Kecamatan;

class RajaOngkir
{
    /** @var \KukuhKKH\RajaOngkir\Contracts\HttpClientContract */
    protected $httpClient;

    /** @var \KukuhKKH\RajaOngkir\Contracts\SearchDriverContract */
    protected $searchDriver;

    /** @var array */
    protected $options;

    /** @var string */
    private $apiKey;

    /** @var string */
    private $package;

    /**
     * @param string $apiKey
     * @param string $package
     */
    public function __construct(string $apiKey, string $package = 'starter')
    {
        $this->apiKey = $apiKey;
        $this->package = $package;

        $this->setHttpClient(new BasicClient);
    }

    /**
     * @param \KukuhKKH\RajaOngkir\Contracts\HttpClientContract $httpClient
     * @return self
     */
    public function setHttpClient(HttpClientContract $httpClient): self
    {
        $this->httpClient = $httpClient;
        $this->httpClient->setApiKey($this->apiKey);
        $this->httpClient->setPackage($this->package);

        return $this;
    }

    /**
     * @param \KukuhKKH\RajaOngkir\Contracts\SearchDriverContract $searchDriver
     * @return self
     */
    public function setSearchDriver(SearchDriverContract $searchDriver): self
    {
        $this->searchDriver = $searchDriver;

        return $this;
    }

    /**
     * @return \KukuhKKH\RajaOngkir\Resources\Provinsi;
     */
    public function provinsi(): Provinsi
    {
        $resource = new Provinsi($this->httpClient);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @return \KukuhKKH\RajaOngkir\Resources\Kota;
     */
    public function kota(): Kota
    {
        $resource = new Kota($this->httpClient);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @return \KukuhKKH\RajaOngkir\Resources\Kecamatan;
     */
    public function kecamatan($id_kota): Kecamatan
    {
        $resource = new Kecamatan($this->httpClient, $id_kota);

        if (null === $this->searchDriver) {
            $resource->setSearchDriver(new BasicDriver);
            $resource->setSearchColumn();
        }

        return $resource;
    }

    /**
     * @param array $payload
     * @return \KukuhKKH\RajaOngkir\Resources\OngkosKirim;
     */
    public function ongkosKirim(array $payload): OngkosKirim
    {
        return new OngkosKirim($this->httpClient, $payload);
    }

    /**
     * @return \KukuhKKH\RajaOngkir\Resources\OngkosKirim;
     */
    public function ongkir(array $payload): OngkosKirim
    {
        return $this->ongkosKirim($payload);
    }

    /**
     * @return \KukuhKKH\RajaOngkir\Resources\OngkosKirim;
     */
    public function biaya(array $payload): OngkosKirim
    {
        return $this->ongkosKirim($payload);
    }
}
