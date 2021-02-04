<?php

declare(strict_types=1);


namespace Musement\SDK\MusementApi;

use Musement\SDK\MusementApi\Model\Cities;

interface MusementApiSDK
{
    public function cities() : Cities;
}
