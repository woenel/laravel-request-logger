<?php

namespace Bilfeldt\RequestLogger;

use Bilfeldt\RequestLogger\Loggers\ModelLogger;
use Illuminate\Support\Manager;

class RequestLogger extends Manager
{
    private array $filters = [];

    public function getFilters(): array
    {
        return array_merge($this->filters, config('request-logger.filters', []));
    }

    public function addFilters(string ... $filters): void
    {
        $this->filters = array_merge($filters, $this->filters);
    }

    public function getDefaultDriver()
    {
        return config('request-logger.default');
    }

    public function createModelDriver(): ModelLogger
    {
        $class = config('request-logger.drivers.model.class');

        return new ModelLogger(new $class);
    }
}
