<?php

namespace Wazen\Resources;

use Wazen\PaginatedResponse;

class ApiKeys extends BaseResource
{
    public function create(array $params): array
    {
        return $this->client->request('POST', '/api-keys', $params);
    }

    public function list(array $params = []): PaginatedResponse
    {
        return $this->client->requestPaginated('GET', '/api-keys', $params ?: null);
    }

    public function revoke(string $keyId): array
    {
        return $this->client->request('DELETE', "/api-keys/{$keyId}");
    }
}
