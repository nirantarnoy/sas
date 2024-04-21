<?php

namespace backend\helpers;

class CommonStatus
{
    private static $data = [
        '0' => 'Inactive',
        '1' => 'Active',
    ];

    private static $dataobj = [
        ['id' => '0', 'name' => 'Inactive'],
        ['id' => '1', 'name' => 'Active'],
    ];

    public static function asArray()
    {
        return self::$data;
    }

    public static function asArrayObject()
    {
        return self::$dataobj;
    }

    public static function getTypeById($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }

    public static function getTypeByName($idx)
    {
        if (isset(self::$data[$idx])) {
            return self::$data[$idx];
        }

        return 'Unknown Type';
    }
}
