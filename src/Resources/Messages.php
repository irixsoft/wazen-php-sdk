<?php

namespace Wazen\Resources;

use Wazen\PaginatedResponse;

class Messages extends BaseResource
{
    public function send(string $sessionId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', "/sessions/{$sessionId}/messages", $body);
    }

    public function list(string $sessionId, array $params = []): PaginatedResponse
    {
        return $this->client->requestPaginated('GET', "/sessions/{$sessionId}/messages", $params ?: null);
    }

    public function get(string $sessionId, string $messageId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/messages/{$messageId}");
    }
}
