<?php

namespace Starterkit\Services;

class StarterkitHook
{
    private $query;

    private $schema;

    public function __construct($query, $schema)
    {
        $this->query  = $query;
        $this->schema = $schema;
    }
}
