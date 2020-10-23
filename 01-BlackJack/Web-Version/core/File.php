<?php

namespace Core;

use Core\Models\StorableInterface;

class File
{
    public static function load(string $name): StorableInterface
    {
        $path = 'storage/'
            . $name
            . '.dat';

        return unserialize(static::readDataFromFile($path));
    }

    public static function store(StorableInterface $object): void
    {
        $path = 'storage/'
            . static::getClassName($object)
            . '.dat';

        if (! file_exists($path)) {
            static::createFile($path);
        }

        static::writeDataToFile($path, serialize($object));
    }

    public static function fileExists($name): bool
    {
        $path = 'storage/'
            . $name
            . '.dat';

        return file_exists($path);
    }

    private static function getClassName($object): string
    {
        $pathPartials = explode('\\', get_class($object));

        return strtolower(end($pathPartials));
    }

    private static function createFile($path): void
    {
        $file = fopen($path, 'x+');
        fclose($file);
    }

    private static function writeDataToFile($path, $data): void
    {
        $file = fopen($path, 'w');
        fwrite($file, $data);
        fclose($file);
    }

    private static function readDataFromFile($path): string
    {
        $file = fopen($path, 'r');
        $data = fread($file, filesize($path) + 1);
        fclose($file);

        return $data;
    }
}