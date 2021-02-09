<?php

declare(strict_types=1);


namespace Musement\Tests\Context;

use Musement\SDK\MusementApi\Model\Cities;
use Musement\Tests\Stubs\SDK\MusementApi\MusementApiStub;

final class MusementApiContext
{
    private MusementApiStub $musementApiStub;

    public function __construct(MusementApiStub $musementApiStub)
    {
        $this->musementApiStub = $musementApiStub;
    }

    public function setCities(Cities $cities) : void
    {
        $this->musementApiStub->setCities($cities);
    }

    public function setException(?\Exception $exception) : void
    {
        $this->musementApiStub->setException($exception);
    }
}
