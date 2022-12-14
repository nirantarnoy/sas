<?php

namespace backend\helpers;

class DrivingcardType
{
    private static $data = [
        '1' => 'ใบขับขี่รถชนิดชั่วคราว',
        '2' => 'ใบขับขี่รถยนต์ส่วนบุคคล'
    ];

    private static $dataobj = [
        ['id'=>'1','name' => 'ใบขับขี่รถชนิดชั่วคราว'],
        ['id'=>'2','name' => 'ใบขับขี่รถยนต์ส่วนบุคคล']
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
