<?php

namespace App\Lib\Carto\Helpers;

class GeoUtils
{
    public static function DMStoDD($deg, $min, $sec)
    {
        return $deg + ((($min * 60) + ($sec)) / 3600);
    }

    public static function DDtoDMS($dd)
    {
        $deg = intval($dd);
        $minfloat = ($dd - $deg) * 60;
        $min = intval($minfloat);
        $sec = ($minfloat - $min) * 60;
        return [$deg, $min, $sec];
    }
}
