<?php

namespace App\Lib\Carto\Models;

class PseudoMercator
{
    public $X = 0.0;
    public $Y = 0.0;

    public function ConvertGeoToPseudoMercator($latitudeRad, $longitudeRad)
    {
        $R = 6378137.0; // rayon terre WGS84
        $this->X = $R * $longitudeRad;
        $this->Y = $R * log(tan(M_PI / 4 + $latitudeRad / 2));
    }

    public function ConvertPseudoMercatorToGeo($X, $Y)
    {
        $R = 6378137.0;
        $this->X = $X;
        $this->Y = $Y;
    }

    public function toString()
    {
        return 'Coordonnées PseudoMercator : X = ' . number_format($this->X, 4) . ' Y = ' . number_format($this->Y, 4);
    }
}

