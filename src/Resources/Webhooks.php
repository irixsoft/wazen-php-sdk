<?php

namespace Wazen\Resources;

use Wazen\PaginatedResponse;

class Webhooks extends BaseResource
{
    public function create(array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', '/webhooks', $body);
    }

    public function list(array $params = []): PaginatedResponse
    {
        return $this->client->requestPaginated('GET', '/webhooks', $params ?: null);
    }

    public function update(string $webhookId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('PUT', "/webhooks/{$webhookId}", $body);
    }

    public function delete(string $webhookId): array
    {
        return $this->client->request('DELETE', "/webhooks/{$webhookId}");
    }

    public function test(string $webhookId, array $params = []): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', "/webhooks/{$webhookId}/test", $body ?: null);
    }

    public function getLogs(string $webhookId): array
    {
        return $this->client->requestList('GET', "/webhooks/{$webhookId}/logs");
    }
}
