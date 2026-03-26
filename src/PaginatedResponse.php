<?php

namespace Wazen;

class PaginatedResponse
{
    public function __construct(
        public readonly array $data,
        public readonly array $pagination,
    ) {}
}
