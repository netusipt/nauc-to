<?php
declare(strict_types=1);

use http\Exception\InvalidArgumentException;

class DependencyInjector
{
    private array $services = [];

    public function resolve($name)
    {
        if (key_exists($name, $this->services)) {
            $service = $this->services[$name];
        } else {
            $service = $this->add($name);
        }
    }

    public function isRegistered($serviceName): bool
    {
        if (key_exists($serviceName, $this->services)) {
            return true;
        }
        return false;
    }

    public function getServiceList(): array
    {
        return array_keys($this->services);
    }

    private function add(string $serviceName): void
    {
        $this->services[$serviceName] = new $serviceName();
    }
}