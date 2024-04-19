<?php

namespace backend\helpers;

class AsspiStatus
{
    private static $data = [
        '0' => 'รอตรวจ',
        '1' => 'ตรวจผ่าน',
        '2' => 'ตรวจไม่ผ่าน',
        '3' => 'แผนกนึ่งรับ',
        '4' => 'แผนกนึ่งคืน',
    ];

    private static $dataobj = [
        ['id' => '0', 'name' => 'รอตรวจ'],
        ['id' => '1', 'name' => 'ตรวจผ่าน'],
        ['id' => '2', 'name' => 'ตรวจไม่ผ่าน'],
        ['id' => '3', 'name' => 'แผนกนึ่งรับ'],
        ['id' => '4', 'name' => 'แผนกนึ่งคืน'],
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
