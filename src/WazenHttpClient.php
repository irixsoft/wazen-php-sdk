<?php

namespace Wazen;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;
use Wazen\Exceptions\WazenApiException;
use Wazen\Exceptions\WazenNetworkException;
use Wazen\Exceptions\WazenTimeoutException;

class WazenHttpClient
{
    private const VERSION = '0.1.0';

    private Client $client;
    private float $timeout;

    public function __construct(string $apiKey, string $baseUrl, float $timeout)
    {
        $this->timeout = $timeout;
        $this->client = new Client([
            'base_uri' => rtrim($baseUrl, '/') . '/',
            'timeout' => $timeout,
            'headers' => [
                'Authorization' => "Bearer {$apiKey}",
                'Accept' => 'application/json',
                'User-Agent' => 'wazen-php/' . self::VERSION,
            ],
        ]);
    }

    public function request(string $method, string $path, ?array $body = null, ?array $query = null): array
    {
        $response = $this->handleResponse($this->execute($method, $path, $body, $query));
        return $response['data'];
    }

    public function requestPaginated(string $method, string $path, ?array $query = null): PaginatedResponse
    {
        $response = $this->handleResponse($this->execute($method, $path, null, $query));
        $pagination = $response['meta']['pagination'] ?? [];
        return new PaginatedResponse($response['data'], $pagination);
    }

    public function requestList(string $method, string $path, ?array $query = null): array
    {
        $response = $this->handleResponse($this->execute($method, $path, null, $query));
        return $response['data'];
    }

    private function execute(string $method, string $path, ?array $body = null, ?array $query = null): ResponseInterface
    {
        $options = [];

        if ($body !== null) {
            $filtered = array_filter($body, fn ($v) => $v !== null);
            if (!empty($filtered)) {
                $options['json'] = $filtered;
            }
        }

        if ($query !== null) {
            $filtered = [];
            foreach ($query as $k => $v) {
                if ($v !== null) {
                    $filtered[$k] = (string) $v;
                }
            }
            if (!empty($filtered)) {
                $options['query'] = $filtered;
            }
        }

        $path = ltrim($path, '/');

        try {
            return $this->client->request($method, $path, $options);
        } catch (ConnectException $e) {
            if (str_contains($e->getMessage(), 'timed out') || str_contains($e->getMessage(), 'timeout')) {
                throw new WazenTimeoutException($this->timeout);
            }
            throw new WazenNetworkException($e->getMessage(), $e);
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $this->handleResponse($e->getResponse());
            }
            throw new WazenNetworkException($e->getMessage(), $e);
        }
    }

    private function handleResponse(ResponseInterface $response): array
    {
        $statusCode = $response->getStatusCode();
        $contents = (string) $response->getBody();

        try {
            $body = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);
        } catch (\JsonException) {
            throw new WazenApiException(
                "Unexpected response format (HTTP {$statusCode})",
                $statusCode,
                'INTERNAL_ERROR',
            );
        }

        if (empty($body['success'])) {
            $error = $body['error'] ?? [];
            $meta = $body['meta'] ?? [];
            throw new WazenApiException(
                $error['message'] ?? 'Unknown error',
                $statusCode,
                $error['code'] ?? 'INTERNAL_ERROR',
                $meta['request_id'] ?? '',
                $error['details'] ?? null,
            );
        }

        return $body;
    }
}
