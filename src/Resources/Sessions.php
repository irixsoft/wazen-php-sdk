<?php

namespace Wazen\Resources;

use Wazen\PaginatedResponse;

class Sessions extends BaseResource
{
    public function create(array $params = []): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', '/sessions', $body ?: null);
    }

    public function list(array $params = []): PaginatedResponse
    {
        return $this->client->requestPaginated('GET', '/sessions', $params ?: null);
    }

    public function get(string $sessionId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}");
    }

    public function delete(string $sessionId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}");
    }

    public function restart(string $sessionId): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/restart");
    }

    public function getQr(string $sessionId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/qr");
    }

    public function factoryReset(string $sessionId): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/factory-reset");
    }
}
