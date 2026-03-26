<?php

namespace Wazen\Resources;

class Contacts extends BaseResource
{
    public function check(string $sessionId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/contacts/check", $params);
    }

    public function bulkCheck(string $sessionId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/contacts/bulk-check", $params);
    }
}
