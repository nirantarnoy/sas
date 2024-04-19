<?php


namespace common\models;


class Debug
{
    public static function debug_highlight_string($data)
    {
        return highlight_string("<?php \n $data = \n" . var_export($data, true) . ";\n ?>");
    }

    public static function debug_export($data)
    {
        return '<pre>' . var_export($data, true) . '</pre>';
    }
}