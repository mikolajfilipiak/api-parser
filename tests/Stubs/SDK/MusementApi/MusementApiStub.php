<?php

declare(strict_types=1);


namespace Musement\Tests\Stubs\SDK\MusementApi;

use Musement\SDK\MusementApi\Model\Cities;
use Musement\SDK\MusementApi\MusementApiSDK;

final class MusementApiStub implements MusementApiSDK
{
    private Cities $cities;

    private ?\Exception $exception = null;

    public function __construct()
    {
        $this->cities = new Cities();
    }

    public function cities() : Cities
    {
        if ($this->exception) {
            throw $this->exception;
        }

        return $this->cities;
    }

    public function setCities(Cities $cities) : void
    {
        $this->cities = $cities;
    }

    public function setException(?\Exception $exception) : void
    {
        $this->exception = $exception;
    }
}
