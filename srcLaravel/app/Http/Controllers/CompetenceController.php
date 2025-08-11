<?php

namespace App\Http\Controllers;

use App\Models\Competence;
use Illuminate\Http\Request;

class CompetenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
		$competences = Competence::with('enfants')->whereNull('idp')->get();
		return view('competences.index', compact('competences'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
		$parents = Competence::all();
		return view('competences.create', compact('parents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
		Competence::create($request->validate([
			'nom' => 'required',
			'idp' => 'nullable|exists:competences,id',
			'code_rome' => 'nullable|string',
			'code_formacode' => 'nullable|string',
			'code_nsf' => 'nullable|string',
			'code_rncp' => 'nullable|string',
			'description' => 'nullable|string',
		]));

		return redirect()->route('competences.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Competence $competence)
    {
		return view('competences.show', compact('competence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Competence $competence)
    {
		$parents = Competence::where('id', '!=', $competence->id)->get();
		return view('competences.edit', compact('competence', 'parents'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Competence $competence)
    {
		$competence->update($request->validate([
			'nom' => 'required',
			'idp' => 'nullable|exists:competences,id',
			'code_rome' => 'nullable|string',
			'code_formacode' => 'nullable|string',
			'code_nsf' => 'nullable|string',
			'code_rncp' => 'nullable|string',
			'description' => 'nullable|string',
		]));

		return redirect()->route('competences.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Competence $competence)
    {
		$competence->delete();
		return redirect()->route('competences.index');
    }
}
