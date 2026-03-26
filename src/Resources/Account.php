<?php

namespace Wazen\Resources;

class Account extends BaseResource
{
    public function get(): array
    {
        return $this->client->request('GET', '/account');
    }

    public function getUsage(): array
    {
        return $this->client->request('GET', '/usage');
    }
}
