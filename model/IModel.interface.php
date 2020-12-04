<?php

declare(strict_types=1);

namespace Model;

interface IModel
{

    public function getPropertyNames();

    public function getProperties();
}
