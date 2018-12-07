<?php

namespace Starterkit\Services;

class Starterkit
{
    private $query;

    public function __construct($query)
    {
        $this->query = $query;
    }
}
