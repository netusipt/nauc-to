<?php
declare(strict_types = 1);

namespace util;

final class Helper {

    private function __construct()
    {
    }

    public static function setter($property) : string
    {
        return "set" . ucfirst($property);
    }
}