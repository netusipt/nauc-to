<?php
declare(strict_types = 1);

namespace util\db;

class PropertyNameConvertor {

    public function classToDbAll(array $classProperties) : array
    {
        $dbProperties = [];

        foreach ($classProperties as $classProperty) {
           $dbProperties[] = $this->classToDb($classProperty);
        }

        return $dbProperties;
    }

    public function dbToClassAll($dbProperties) : array
    {
        $classProperties = [];

        foreach ($dbProperties as $dbProperty) {
           $classProperties[] = $this->dbToClass($dbProperty);
        }

        return $classProperties;
    }

    public function classToDb(string $classProperty) : string
    {
        $dbProperty = "";

        $arr = preg_split('/(?=[A-Z])/', $classProperty);
        foreach ($arr as $part) {
            $dbProperty .= ucfirst($part);
        }

        return $dbProperty;
    }

    public static function dbToClass($dbProperty) : string
    {
        $classProperty = "";

        $arr = explode("_", $dbProperty);
        foreach ($arr as $part) {
            $classProperty .= ucfirst($part);
        }

        return $classProperty;
    }
}