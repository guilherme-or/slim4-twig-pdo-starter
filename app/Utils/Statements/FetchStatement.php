<?php

namespace App\Utils\Statements;

interface FetchStatement
{
    public function fetch(bool $fetchAll = true): array;
}
