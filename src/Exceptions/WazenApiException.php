<?php

namespace Wazen\Exceptions;

class WazenApiException extends \Exception
{
    private int $statusCode;
    private string $errorCode;
    private string $requestId;
    private mixed $details;

    public function __construct(
        string $message,
        int $statusCode,
        string $errorCode,
        string $requestId = '',
        mixed $details = null,
    ) {
        parent::__construct($message);
        $this->statusCode = $statusCode;
        $this->errorCode = $errorCode;
        $this->requestId = $requestId;
        $this->details = $details;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getErrorCode(): string
    {
        return $this->errorCode;
    }

    public function getRequestId(): string
    {
        return $this->requestId;
    }

    public function getDetails(): mixed
    {
        return $this->details;
    }
}
