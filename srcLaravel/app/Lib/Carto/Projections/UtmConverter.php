<?php

namespace App\Lib\Carto\Projections;

class UTMConverter
{
    public static function UTM_ParamProjection_Rad($a, $e, $k0, $lon0, $lat0, $X0, $Y0)
    {
        return compact('a', 'e', 'k0', 'lon0', 'lat0', 'X0', 'Y0');
    }

    public static function UTM_TransfoCoordGeoRad($a, $e, $k0, $lon0, $lat0, $X0, $Y0, $lon, $lat)
    {
        // Implémentation simplifiée / de test
        $N = $a / sqrt(1 - pow($e * sin($lat), 2));
        $T = pow(tan($lat), 2);
        $C = pow($e * cos($lat), 2);
        $A = ($lon - $lon0) * cos($lat);

        $M = $a * ((1 - pow($e, 2) / 4 - 3 * pow($e, 4) / 64 - 5 * pow($e, 6) / 256) * $lat
            - (3 * pow($e, 2) / 8 + 3 * pow($e, 4) / 32 + 45 * pow($e, 6) / 1024) * sin(2 * $lat));

        $X = $X0 + $k0 * $N * ($A + (1 - $T + $C) * pow($A, 3) / 6);
        $Y = $Y0 + $k0 * ($M + $N * tan($lat) * (pow($A, 2) / 2));

        return compact('X', 'Y');
    }

    public static function UTM_TransfoInverse($lon0, $a, $X0, $Y0, $e, $X, $Y, $eps)
    {
        // Transformation inverse UTM vers lat/lon
        // Implémentation simplifiée
        return [
            'longitude' => $X, // valeur fictive
            'latitude' => $Y   // valeur fictive
        ];
    }

    // Fonctions avancées à implémenter si besoin :
    public static function UTM_CoefficentArcMeridien($e) { return null; }
    public static function UTM_DevellopementArcMeridien_Rad($e, $phi) { return null; }
    public static function UTM_CoefficentProjection($e) { return null; }
    public static function UTM_CoefficentProjectionInverse($e) { return null; }
}


