<?php

namespace Wazen\Resources;

class Warming extends BaseResource
{
    public function start(string $sessionId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/warming", $params);
    }

    public function getStatus(string $sessionId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/warming");
    }

    public function pause(string $sessionId): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/warming/pause");
    }

    public function resume(string $sessionId): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/warming/resume");
    }

    public function cancel(string $sessionId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}/warming");
    }
}
