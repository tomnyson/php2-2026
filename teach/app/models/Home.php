<?php
declare(strict_types=1);

class Home extends Model
{
    public function welcome(): string
    {
        return 'Welcome to your simple MVC framework.';
    }
}
