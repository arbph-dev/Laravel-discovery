<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartoService;

class CartoController extends Controller
{
    public function form()
    {
        return view('carto.form');
    }



    public function show(CartoService $carto)
    {
        $angle = $carto->convertDMStoDD(3, 25, 45);

        $gps = $carto->createWGS84(-3.15, 47.7885);
        $lambert = $carto->convertToLambert93($gps);

        return response()->json([
            'angle' => $angle,
            'lambert' => $lambert->toString(),
            'wgs84' => $gps->toString(),
        ]);
    }







    public function convert(Request $request, CartoService $carto)
    {
        $deg = $request->input('deg');
        $min = $request->input('min');
        $sec = $request->input('sec');
        $lon = (float) $request->input('lon');
        $lat = (float) $request->input('lat');

        $dd = $carto->convertDMStoDD($deg, $min, $sec);
        $wgs = $carto->createWGS84($lon, $lat);
        $lambert = $carto->convertToLambert93($wgs);

        return response()->json([
            'dd' => number_format($dd, 6),
            'lambert' => $lambert->toString(),
        ]);
    }
}