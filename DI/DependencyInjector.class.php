<?php
declare(strict_types = 1);

use http\Exception\InvalidArgumentException;

class DI
{
    private array $services = [];

    public function register(string $serviceName, stdClass $service): void
    {
        $this->services[$serviceName] = $service;
    }

    public function resolve($name)
    {
        if (key_exists($name, $this->services)) {
            return $this->services[$name];
        } else {
            throw new InvalidArgumentException("Service is not registered");
        }
    }

    public function isRegistered($serviceName): bool
    {
        if (key_exists($serviceName, $this->services)) {
            return true;
        }
        return false;
    }
}