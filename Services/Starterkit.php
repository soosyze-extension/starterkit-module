<?php

namespace SoosyzeExtension\Starterkit\Services;

class Starterkit
{
    private $query;

    public function __construct($query)
    {
        $this->query = $query;
    }
}
