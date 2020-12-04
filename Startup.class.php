<?php
declare(strict_types=1);

class Startup
{
    private DependencyInjector $di;

    public function __construct(DependencyInjector $di)
    {
        $this->di = $di;
    }

    public function configureServices() {

    }
}