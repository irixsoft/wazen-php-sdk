<?php

namespace Wazen\Resources;

class Groups extends BaseResource
{
    public function list(string $sessionId): array
    {
        return $this->client->requestList('GET', "/sessions/{$sessionId}/groups");
    }

    public function create(string $sessionId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/groups", $params);
    }

    public function get(string $sessionId, string $groupId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/groups/{$groupId}");
    }

    public function update(string $sessionId, string $groupId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('PUT', "/sessions/{$sessionId}/groups/{$groupId}", $body);
    }

    public function leave(string $sessionId, string $groupId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}/groups/{$groupId}");
    }

    public function manageParticipants(string $sessionId, string $groupId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/groups/{$groupId}/participants", $params);
    }

    public function updateSettings(string $sessionId, string $groupId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('PUT', "/sessions/{$sessionId}/groups/{$groupId}/settings", $body);
    }

    public function sendMessage(string $sessionId, string $groupId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', "/sessions/{$sessionId}/groups/{$groupId}/messages", $body);
    }

    public function getInvite(string $sessionId, string $groupId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/groups/{$groupId}/invite");
    }

    public function revokeInvite(string $sessionId, string $groupId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}/groups/{$groupId}/invite");
    }

    public function getRequests(string $sessionId, string $groupId): array
    {
        return $this->client->requestList('GET', "/sessions/{$sessionId}/groups/{$groupId}/requests");
    }

    public function manageRequests(string $sessionId, string $groupId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/groups/{$groupId}/requests", $params);
    }

    public function getInviteInfo(string $sessionId, array $params): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/groups/invite-info", null, $params);
    }

    public function join(string $sessionId, array $params): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/groups/join", $params);
    }
}
