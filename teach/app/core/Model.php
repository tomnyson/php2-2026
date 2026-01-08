<?php
declare(strict_types=1);

class Model
{
    protected function db(): PDO
    {
        return Database::connection();
    }
}
