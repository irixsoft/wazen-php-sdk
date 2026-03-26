<?php

namespace Wazen\Resources;

use Wazen\WazenHttpClient;

abstract class BaseResource
{
    protected WazenHttpClient $client;

    public function __construct(WazenHttpClient $client)
    {
        $this->client = $client;
    }

    protected static function filterNone(array $params): array
    {
        return array_filter($params, fn ($v) => $v !== null);
    }
}
