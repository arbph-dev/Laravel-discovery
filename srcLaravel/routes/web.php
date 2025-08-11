<?php

use Illuminate\Support\Facades\Route;


use App\Http\Controllers\CompetenceController;
use App\Http\Controllers\DashadminController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\RealisationController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VaeexpController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\CartoController;

use App\Models\User;




Route::get('/', function () {
    return view('welcome');
})->name('homeguest');


Route::get('/about', function () { return view('about'); });

Route::get('/note', function () { return view('note'); });

Route::get('/three', function () {  return view('three'); });

Route::get('/tache', function () { 
    
    $car = array("id"=>"ihm0001", "titre"=>"Migration des vues avec template pure.blade.php", "priorité"=>1);

    return view('tache', compact('car')); 
});


/* 2025-08-06 carto*/
Route::get('/carto', [CartoController::class, 'form']);
Route::get('/carto-test', [CartoController::class, 'show']);
Route::post('/carto/convert', [CartoController::class, 'convert'])->name('carto.convert');


Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index']);



Route::middleware( [ 'auth', 'verified' ] )->get( '/home' , function () { 
    return view('home'); 
    } )->name('home');

/* 2025-08-06 
Route::get('/dashadmin', function () {
	$users = User::all();
	return view('dashadmin', compact('users')); 
})->middleware('isadmin');
*/
Route::get('/dashadmin', [DashadminController::class, 'index'])
    ->middleware(['auth', 'verified', 'isadmin'])
    ->name('dashadmin');

Route::get('/users/{user}', [UserController::class, 'show'])
	->middleware(['auth', 'verified', 'isadmin'])
	->name('users.show');


/* 
Pour essai apres migration : Route::get('/organisations', [OrganisationController::class, 'index']);
On passe au route model binding qui impose d'implémenter les fonctions edit show index dans OrganisationController
*/
Route::resource('organisations', OrganisationController::class);
Route::resource('vaeexps', VaeexpController::class);
Route::resource('images', ImageController::class);

Route::resource('competences', CompetenceController::class); 
Route::resource('realisations', RealisationController::class); 



Route::get('/script', function () { return view('script'); });
Route::get('/script-cmp-eval', function () { return view('script.cmp-eval'); });
Route::get('/script-cmp-callout', function () { return view('script.cmp-callout'); });
