<?php

namespace App\Http\Controllers;

use App\Models\User;

class DashadminController extends Controller
{
    public function index()
    {
        $users = User::all();
        $usersCount = $users->count();
		
        // $table = \App\Helpers\TableHelper::modelToTable($users, \App\Models\User::class, 'users.show');
        $table =\App\Helpers\TableHelper::usersTable($users);// On doit préparer ici le tableau avec TableHelper 
    
		return view('dashadmin', [
			'usersCount' => $usersCount ,
			'table' => $table ,
			'laravelVersion' => app()->version(),
			'debugMode' => config('app.debug'),	
			'env' => app()->environment()		
			]);

    }
}