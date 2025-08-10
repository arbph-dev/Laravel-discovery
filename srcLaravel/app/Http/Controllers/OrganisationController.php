<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organisation;


class OrganisationController extends Controller
{
    /*
    essai apres migration
    public function index()
    {
        $organisations = Organisation::all();
        $titre = "Elfennel - page principale (template simple)";
        $keyGOOGLESEARCH = "AfXsb50qf2vbKIfIt9K4j3AdN6a8WHUaGmDdeHcdN0Q";

        return view('organisations.index', compact('organisations', 'titre', 'keyGOOGLESEARCH'));
    }

    vues à créer :
    organisations.index
    organisations.show
    organisations.create
    organisations.edit
    */

    public function index()
    {
        //$organisations = Organisation::all();
        //return view('organisations.index', compact('organisations'));

        $organisations = Organisation::with('vaeexp')->get();
        return view('organisations.index', compact('organisations'));

    }

    public function show(Organisation $organisation)
    {
    //    return view('organisations.show', compact('organisation'));
        //$organisation = Organisation::with('vaeexp')->findOrFail($id);
        $organisation->load('vaeexp'); // Optionnel pour charger la relation
        return view('organisations.show', compact('organisation'));
    }

    public function create()
    {
        return view('organisations.create');
    }

    public function store(Request $request)
    {
		$validated = $request->validate([
			'lbl' => 'required|string|max:255',
			'adville' => 'nullable|string|max:255',
			'addep' => 'nullable|string|max:255',
			'codeape' => 'nullable|string|max:10',
			'lblape' => 'nullable|string|max:255',
			'urlweb' => 'nullable|url|max:255',
			'urlreg' => 'nullable|url|max:255',
			'pich' => 'nullable|string|max:255',
			'picl' => 'nullable|string|max:255',
		]);

        Organisation::create($validated);

        return redirect()->route('organisations.index')->with('success', 'Organisation créée.');
    }

    public function edit(Organisation $organisation)
    {
        return view('organisations.edit', compact('organisation'));
    }

    public function update(Request $request, Organisation $organisation)
    {
		$validated = $request->validate([
			'lbl' => 'required|string|max:255',
			'adville' => 'nullable|string|max:255',
			'addep' => 'nullable|string|max:255',
			'codeape' => 'nullable|string|max:10',
			'lblape' => 'nullable|string|max:255',
			'urlweb' => 'nullable|url|max:255',
			'urlreg' => 'nullable|url|max:255',
			'pich' => 'nullable|string|max:255',
			'picl' => 'nullable|string|max:255',
		]);

        $organisation->update($validated);

        return redirect()->route('organisations.index')->with('success', 'Organisation mise à jour.');
    }

    public function destroy(Organisation $organisation)
    {
        $organisation->delete();

        return redirect()->route('organisations.index')->with('success', 'Organisation supprimée.');
    }


}
