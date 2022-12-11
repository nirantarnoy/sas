<?php

namespace backend\helpers;

class PartycatType
{
    private static $data = [
        '1' => '1',
        '2' => '2'
    ];

    private static $dataobj = [
        ['id'=>'1','name' => '1'],
        ['id'=>'2','name' => '2']
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
