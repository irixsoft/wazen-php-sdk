<?php

namespace Wazen;

use Wazen\Resources\Account;
use Wazen\Resources\ApiKeys;
use Wazen\Resources\Channels;
use Wazen\Resources\Contacts;
use Wazen\Resources\Groups;
use Wazen\Resources\Messages;
use Wazen\Resources\Sessions;
use Wazen\Resources\Warming;
use Wazen\Resources\Webhooks;

class Wazen
{
    public readonly Sessions $sessions;
    public readonly Messages $messages;
    public readonly Contacts $contacts;
    public readonly Groups $groups;
    public readonly Channels $channels;
    public readonly Warming $warming;
    public readonly Webhooks $webhooks;
    public readonly Account $account;
    public readonly ApiKeys $apiKeys;

    public function __construct(string $apiKey, array $config = [])
    {
        if (empty($apiKey)) {
            throw new \InvalidArgumentException('API key is required. Pass your Wazen API key as the first argument.');
        }

        $baseUrl = $config['base_url'] ?? 'https://wazen.dev/api/v1';
        $timeout = $config['timeout'] ?? 30;

        $client = new WazenHttpClient($apiKey, $baseUrl, (float) $timeout);

        $this->sessions = new Sessions($client);
        $this->messages = new Messages($client);
        $this->contacts = new Contacts($client);
        $this->groups = new Groups($client);
        $this->channels = new Channels($client);
        $this->warming = new Warming($client);
        $this->webhooks = new Webhooks($client);
        $this->account = new Account($client);
        $this->apiKeys = new ApiKeys($client);
    }
}
