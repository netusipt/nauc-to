<?php
declare(strict_types = 1);

namespace util;


use phpDocumentor\Reflection\Types\This;

class Logger
{

    private string $fileName;

    public function log(string $message) {
        $handle = fopen($this->fileName, 'a+', );
        fwrite($handle, $message);
    }
}