<?php

namespace Wazen\Laravel;

use Illuminate\Support\Facades\Facade;
use Wazen\Wazen;

class WazenFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return Wazen::class;
    }
}
