# Wazen PHP SDK

Official PHP SDK for the [Wazen WhatsApp API](https://wazen.dev).

[![Packagist](https://img.shields.io/packagist/v/wazen/sdk)](https://packagist.org/packages/wazen/sdk)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php&logoColor=fff)](https://php.net)

## Installation

```bash
composer require wazen/sdk
```

## Quick Start

```php
use Wazen\Wazen;

$wazen = new Wazen('wz_your_api_key');

// Send a message
$message = $wazen->messages->send('session-id', [
    'to' => '+1234567890',
    'type' => 'text',
    'content' => 'Hello from Wazen!',
]);

// List sessions
$sessions = $wazen->sessions->list();

// Check if a number is on WhatsApp
$result = $wazen->contacts->check('session-id', [
    'phone' => '+1234567890',
]);
```

## Resources

All resources are accessible as properties on the client instance.

### Sessions

```php
$wazen->sessions->create();
$wazen->sessions->list();
$wazen->sessions->get('session-id');
$wazen->sessions->delete('session-id');
$wazen->sessions->restart('session-id');
$wazen->sessions->getQr('session-id');
$wazen->sessions->factoryReset('session-id');
```

### Messages

```php
// Send text
$wazen->messages->send('session-id', [
    'to' => '+1234567890',
    'type' => 'text',
    'content' => 'Hello!',
]);

// Send image
$wazen->messages->send('session-id', [
    'to' => '+1234567890',
    'type' => 'image',
    'media_url' => 'https://example.com/photo.jpg',
]);

// Get message history
$wazen->messages->list('session-id', ['direction' => 'outgoing', 'limit' => 10]);

// Get single message
$wazen->messages->get('session-id', 'message-id');
```

### Groups (Pro+)

```php
$wazen->groups->list('session-id');
$wazen->groups->create('session-id', ['subject' => 'Team Chat', 'participants' => ['+1234567890']]);
$wazen->groups->get('session-id', 'group-id');
$wazen->groups->update('session-id', 'group-id', ['subject' => 'New Name']);
$wazen->groups->leave('session-id', 'group-id');
$wazen->groups->manageParticipants('session-id', 'group-id', ['action' => 'add', 'participants' => ['+0987654321']]);
$wazen->groups->sendMessage('session-id', 'group-id', ['type' => 'text', 'content' => 'Hello group!']);
```

### Channels (Pro+)

```php
$wazen->channels->create('session-id', ['name' => 'Product Updates', 'description' => 'Latest news']);
$wazen->channels->sendMessage('session-id', 'channel-id', ['type' => 'text', 'content' => 'New release!']);
```

### Contacts

```php
// Check single number
$wazen->contacts->check('session-id', ['phone' => '+1234567890']);

// Bulk check (Pro+)
$wazen->contacts->bulkCheck('session-id', ['phones' => ['+1234567890', '+0987654321']]);
```

### Warming

```php
$wazen->warming->start('session-id', [
    'contacts' => [
        ['phone' => '+1234567890', 'name' => 'Alice'],
        ['phone' => '+0987654321'],
    ],
]);
$wazen->warming->getStatus('session-id');
$wazen->warming->pause('session-id');
$wazen->warming->resume('session-id');
$wazen->warming->cancel('session-id');
```

### Webhooks

```php
$wazen->webhooks->create([
    'url' => 'https://your-app.com/webhooks/wazen',
    'events' => ['message.received', 'message.delivered'],
]);
$wazen->webhooks->list();
$wazen->webhooks->update('webhook-id', ['enabled' => false]);
$wazen->webhooks->delete('webhook-id');
$wazen->webhooks->test('webhook-id');
$wazen->webhooks->getLogs('webhook-id');
```

### Account

```php
$account = $wazen->account->get();
$usage = $wazen->account->getUsage();
```

### API Keys

```php
$key = $wazen->apiKeys->create(['name' => 'new-key']);
$wazen->apiKeys->list();
$wazen->apiKeys->revoke('key-id');
```

## Configuration

```php
$wazen = new Wazen('wz_your_api_key', [
    'base_url' => 'https://wazen.dev/api/v1', // default
    'timeout' => 30,                           // default, in seconds
]);
```

## Error Handling

```php
use Wazen\Wazen;
use Wazen\Exceptions\WazenApiException;

try {
    $wazen->messages->send('session-id', [
        'to' => '+1234567890',
        'type' => 'text',
        'content' => 'Hi',
    ]);
} catch (WazenApiException $e) {
    echo $e->getStatusCode();  // HTTP status code
    echo $e->getErrorCode();   // API error code
    echo $e->getMessage();     // Error message
}
```

## Laravel Integration

### Auto-Discovery

The service provider is auto-discovered by Laravel. Just add your API key to `.env`:

```env
WAZEN_API_KEY=wz_your_api_key
```

### Publish Config (Optional)

```bash
php artisan vendor:publish --tag=wazen-config
```

This creates `config/wazen.php`:

```php
return [
    'api_key' => env('WAZEN_API_KEY'),
    'base_url' => env('WAZEN_BASE_URL', 'https://wazen.dev/api/v1'),
    'timeout' => env('WAZEN_TIMEOUT', 30),
];
```

### Usage

```php
use Wazen\Wazen;

// Via dependency injection
public function sendMessage(Wazen $wazen)
{
    $wazen->messages->send('session-id', [
        'to' => '+1234567890',
        'type' => 'text',
        'content' => 'Hello!',
    ]);
}

// Via facade
Wazen::messages()->send('session-id', [...]);
```

## Requirements

- PHP 8.1 or later
- A Wazen account with an active subscription
- An API key from your [Dashboard](https://wazen.dev/dashboard/developers)

## Links

- [API Documentation](https://wazen.dev/docs)
- [Dashboard](https://wazen.dev/dashboard)
- [TypeScript SDK](https://www.npmjs.com/package/@wazen/sdk)
- [Python SDK](https://pypi.org/project/wazen)
- [.NET SDK](https://www.nuget.org/packages/Wazen)

## License

MIT
