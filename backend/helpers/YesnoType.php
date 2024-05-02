<?php

namespace backend\helpers;

class YesnoType
{
    private static $data = [
        '1' => 'YES',
        '0' => 'NO',
    ];

    private static $dataobj = [
        ['id' => '1', 'name' => 'YES'],
        ['id' => '0', 'name' => 'NO'],
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
