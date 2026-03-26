<?php

namespace Wazen\Exceptions;

class WazenNetworkException extends \Exception
{
    public function __construct(string $message = 'Network request failed', ?\Throwable $previous = null)
    {
        parent::__construct($message, 0, $previous);
    }
}
