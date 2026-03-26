<?php

namespace Wazen\Exceptions;

class WazenTimeoutException extends \Exception
{
    public function __construct(float $timeout)
    {
        parent::__construct("Request timed out after {$timeout}s");
    }
}
