<?php
declare(strict_types=1);

namespace util\db;

class PropertyNameConvertor
{

    public function classToDbAll(array $classProperties): array
    {
        $dbProperties = [];

        foreach ($classProperties as $propertyName => $propertyValue) {
            $dbProperties[$this->classToDb($propertyName)] = $propertyValue;
        }

        return $dbProperties;
    }

    public function dbToClassAll($dbProperties): array
    {
        $classProperties = [];

        foreach ($dbProperties as $propertyName => $propertyValue) {
            $classProperties[$this->dbToClass($propertyName)] = $propertyValue;
        }

        return $classProperties;
    }

    public function classToDb(string $classProperty): string
    {
        $arr = preg_split('/(?=[A-Z])/', $classProperty);

        $dbProperty = $arr[0];
        for ($i = 1; $i < count($arr); $i++) {
            $dbProperty .= "_" . mb_strtolower($arr[$i]);
        }

        return $dbProperty;
    }

    public static function dbToClass($dbProperty): string
    {
        $arr = explode("_", $dbProperty);
        $classProperty = $arr[0];

        for ($i = 1; $i < count($arr); $i++) {
            $classProperty .= ucfirst($arr[$i]);
        }

        return $classProperty;
    }
}