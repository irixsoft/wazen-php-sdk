<?php

namespace Wazen\Resources;

class Channels extends BaseResource
{
    public function create(string $sessionId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', "/sessions/{$sessionId}/channels", $body);
    }

    public function lookup(string $sessionId, array $params = []): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/channels", null, $params ?: null);
    }

    public function get(string $sessionId, string $channelId): array
    {
        return $this->client->request('GET', "/sessions/{$sessionId}/channels/{$channelId}");
    }

    public function update(string $sessionId, string $channelId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('PUT', "/sessions/{$sessionId}/channels/{$channelId}", $body);
    }

    public function delete(string $sessionId, string $channelId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}/channels/{$channelId}");
    }

    public function sendMessage(string $sessionId, string $channelId, array $params): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', "/sessions/{$sessionId}/channels/{$channelId}/messages", $body);
    }

    public function listMessages(string $sessionId, string $channelId, array $params = []): array
    {
        return $this->client->requestList('GET', "/sessions/{$sessionId}/channels/{$channelId}/messages", $params ?: null);
    }

    public function react(string $sessionId, string $channelId, string $messageId, array $params = []): array
    {
        $body = self::filterNone($params);
        return $this->client->request('POST', "/sessions/{$sessionId}/channels/{$channelId}/messages/{$messageId}/react", $body ?: null);
    }

    public function follow(string $sessionId, string $channelId): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/channels/{$channelId}/follow");
    }

    public function unfollow(string $sessionId, string $channelId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}/channels/{$channelId}/follow");
    }

    public function mute(string $sessionId, string $channelId): array
    {
        return $this->client->request('POST', "/sessions/{$sessionId}/channels/{$channelId}/mute");
    }

    public function unmute(string $sessionId, string $channelId): array
    {
        return $this->client->request('DELETE', "/sessions/{$sessionId}/channels/{$channelId}/mute");
    }
}
