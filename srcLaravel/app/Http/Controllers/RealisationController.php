<?php

namespace App\Http\Controllers;

use App\Models\Realisation;
// relations
use App\Models\Vaeexp;
use App\Models\Organisation;
use App\Models\Competence;

use Illuminate\Http\Request;

class RealisationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $realisations = Realisation::with(['vaeexp', 'client', 'competences', 'images'])->get();
        return view('realisations.index', compact('realisations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
		$vaeexpId = $request->query('vaeexp_id');
        $vaeexps = Vaeexp::all();
        $organisations = Organisation::all();
        $competences = Competence::all();
        return view('realisations.create', compact('vaeexps', 'vaeexpId', 'organisations', 'competences'));    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'vaeexp_id' => 'required',
            'organisation_id' => 'nullable',
            'titre' => 'required',
            'description' => 'nullable',
            'resultat' => 'nullable',
            'conclusion' => 'nullable',
            'date_realisation' => 'nullable|date',
            'competences' => 'array|nullable',
			'images_ids' => 'nullable|string'
        ]);

        $realisation = Realisation::create($data);
        $realisation->competences()->sync($request->input('competences', []));

		// Gestion des images associées (table pivot)
		$imagesIdsString = $request->input('images_ids', '');
		if (!empty($imagesIdsString)) {
			$imagesIds = array_filter(explode(';', $imagesIdsString));
			$realisation->images()->sync($imagesIds);
		}

        return redirect()->route('realisations.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Realisation $realisation)
    {
        $realisation->load(['vaeexp', 'client', 'competences', 'images']);
        return view('realisations.show', compact('realisation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Realisation $realisation)
    {
        $vaeexps = Vaeexp::all();
        $organisations = Organisation::all();
        $competences = Competence::all();
        return view('realisations.edit', compact('realisation', 'vaeexps', 'organisations', 'competences'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Realisation $realisation)
    {
        $data = $request->validate([
            'vaeexp_id' => 'required',
            'organisation_id' => 'nullable',
            'titre' => 'required',
            'description' => 'nullable',
            'resultat' => 'nullable',
            'conclusion' => 'nullable',
            'date_realisation' => 'nullable|date',
            'competences' => 'array|nullable',
			'images_ids' => 'nullable|string'
        ]);

        $realisation->update($data);
        $realisation->competences()->sync($request->input('competences', []));

		// Gestion des images associées (table pivot)
		$imagesIdsString = $request->input('images_ids', '');
		if (!empty($imagesIdsString)) {
			$imagesIds = array_filter(explode(';', $imagesIdsString));
			$realisation->images()->sync($imagesIds);
		}

        return redirect()->route('realisations.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Realisation $realisation)
    {
        $realisation->delete();
        return redirect()->route('realisations.index');
    }
}
