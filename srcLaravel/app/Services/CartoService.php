<?php

namespace App\Services;

use App\Lib\Carto\Models\CoordWGS84;
use App\Lib\Carto\Models\CoordL93;
use App\Lib\Carto\Models\PseudoMercator;
use App\Lib\Carto\Helpers\GeoUtils;
use App\Lib\Carto\Projections\UTMConverter;

class CartoService
{
    public function convertDMStoDD($deg, $min, $sec): float
    {
        return GeoUtils::DMStoDD($deg, $min, $sec);
    }

    public function convertDDtoDMS($dd): array
    {
        return GeoUtils::DDtoDMS($dd);
    }

    public function createWGS84(float $lon, float $lat): CoordWGS84
    {
        return new CoordWGS84($lon, $lat);
    }

    public function createL93(float $x, float $y): CoordL93
    {
        return new CoordL93($x, $y);
    }

    public function createPseudoMercator(): PseudoMercator
    {
        return new PseudoMercator();
    }

    public function convertToLambert93(CoordWGS84 $coord): CoordL93
    {
        return $coord->toLAMBERT93();
    }

    public function convertToWGS84(CoordL93 $coord): CoordWGS84
    {
        return $coord->toWGS84();
    }

    public function convertGeoToPM(PseudoMercator $pm, float $latRad, float $lonRad): void
    {
        $pm->ConvertGeoToPseudoMercator($latRad, $lonRad);
    }

    public function convertPMToGeo(PseudoMercator $pm, float $x, float $y): void
    {
        $pm->ConvertPseudoMercatorToGeo($x, $y);
    }

    public function utmParamProjection(array $params): array
    {
        return UTMConverter::UTM_ParamProjection_Rad(...$params);
    }

    public function utmForward(array $params): array
    {
        return UTMConverter::UTM_TransfoCoordGeoRad(...$params);
    }

    public function utmInverse(array $params): array
    {
        return UTMConverter::UTM_TransfoInverse(...$params);
    }
}
