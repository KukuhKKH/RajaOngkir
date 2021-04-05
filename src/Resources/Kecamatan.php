<?php

namespace KukuhKKH\RajaOngkir\Resources;

use KukuhKKH\RajaOngkir\HttpClients\AbstractClient;

class Kecamatan extends AbstractLocation
{
    /**
     * @param \KukuhKKH\RajaOngkir\HttpClients\AbstractClient $httpClient
     */
    public function __construct(AbstractClient $httpClient, $id_kota)
    {
        $this->httpClient = $httpClient;
        $this->httpClient->setEntity('subdistrict?city='.$id_kota);
        $this->httpClient->setHttpMethod('GET');
    }

    /**
     * @return self
     */
    public function setSearchColumn()
    {
        $this->searchDriver->setSearchColumn('subdistrict_name');

        return $this;
    }

    /**
     * @return self
     */
    public function setSearchType()
    {
        $this->searchDriver->setSearchColumn('type');

        return $this;
    }

    /**
     * @param int|string $cityID
     * @return self
     */
    public function dariKota($cityID): self
    {
        $this->result = $this->httpClient->request(['city' => $cityID]);

        return $this;
    }
}
