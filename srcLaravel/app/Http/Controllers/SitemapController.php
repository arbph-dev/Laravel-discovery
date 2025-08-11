<?php
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use App\Models\Realisation;

class SitemapController extends Controller
{
    public function index()
    {
        $realisations = Realisation::all();

        return response()->view('sitemap', [
            'realisations' => $realisations
        ])->header('Content-Type', 'application/xml');
    }
}
