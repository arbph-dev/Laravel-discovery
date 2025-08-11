<?php

namespace App\Lib\Carto\Models;

use App\Lib\Carto\Models\CoordL93;

class CoordWGS84
{
    public $longitude = 0.0;
    public $latitude = 0.0;

    public function __construct($lon, $lat)
    {
        $this->longitude = $lon;
        $this->latitude = $lat;
    }

    public function toString()
    {
        return 'Coordonnées CoordWGS84 : ' . number_format($this->longitude, 4) . ' : ' . number_format($this->latitude, 4);
    }

    public function toLAMBERT93()
    {
        // Exemple simplifié — à adapter avec les vraies formules de conversion
        $n = 0.7256077650;
        $c = 11754255.426;
        $xs = 700000.0;
        $ys = 12655612.050;
        $e = 0.08181919106;

        $lat_rad = deg2rad($this->latitude);
        $lon_rad = deg2rad($this->longitude);
        $lon0_rad = deg2rad(3.0); // Méridien d’origine L93

        $lat_iso = log(tan(M_PI / 4 + $lat_rad / 2) * pow((1 - $e * sin($lat_rad)) / (1 + $e * sin($lat_rad)), $e / 2));
        $x = $xs + $c * exp(-$n * $lat_iso) * sin($n * ($lon_rad - $lon0_rad));
        $y = $ys - $c * exp(-$n * $lat_iso) * cos($n * ($lon_rad - $lon0_rad));

        return new CoordL93($x, $y);
    }
}
