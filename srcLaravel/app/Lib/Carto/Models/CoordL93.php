<?php

namespace App\Lib\Carto\Models;

use App\Lib\Carto\Models\CoordWGS84;

class CoordL93
{
    public $x = 0.0;
    public $y = 0.0;

    public function __construct($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    public function toString()
    {
        return 'Coordonnées CoordL93 : ' . number_format($this->x, 2) . ' : ' . number_format($this->y, 2);
    }

    public function toWGS84()
    {
        $n = 0.7256077650;
        $c = 11754255.426;
        $xs = 700000.0;
        $ys = 12655612.050;
        $e = 0.08181919106;

        $R = sqrt(pow($this->x - $xs, 2) + pow($this->y - $ys, 2));
        $gamma = atan(($this->x - $xs) / ($ys - $this->y));
        $lat_iso = -1 / $n * log($R / $c);
        $lon0_rad = deg2rad(3.0);

        // Calcul latitude en radians via latitude isométrique (approx)
        $phi = 2 * atan(exp($lat_iso)) - M_PI / 2;
        $phi_prev = 0;
        $eps = 1e-11;
        while (abs($phi - $phi_prev) > $eps) {
            $phi_prev = $phi;
            $phi = 2 * atan(pow((1 + $e * sin($phi_prev)) / (1 - $e * sin($phi_prev)), $e / 2) * exp($lat_iso)) - M_PI / 2;
        }

        $lon = rad2deg($gamma / $n + $lon0_rad);
        $lat = rad2deg($phi);
        return new CoordWGS84($lon, $lat);
    }
}


