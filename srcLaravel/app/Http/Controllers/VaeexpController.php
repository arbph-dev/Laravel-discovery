<?php
namespace App\Http\Controllers;

use App\Models\Vaeexp;
use App\Models\Organisation;
use App\Models\Competence;

use Illuminate\Http\Request;

class VaeexpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
	public function index(Request $request)
	{
		$query = Vaeexp::with(['organisation', 'realisations.client', 'realisations.competences'])
			->orderByDesc('dd');

		$q = $request->input('q');
		$organisationId = $request->input('organisation_id');
		$competenceId = $request->input('competence_id');

		// Récupération brute
		$vaeexps = $query->get();

		// Filtrage après chargement
		if ($q || $organisationId || $competenceId) {
			$vaeexps = $vaeexps->map(function ($vaeexp) use ($q, $organisationId, $competenceId) {
				$filtered = $vaeexp->realisations->filter(function ($real) use ($q, $organisationId, $competenceId) {
					if ($organisationId && $real->organisation_id != $organisationId) {
						return false;
					}

					if ($q && !str_contains(strtolower($real->titre . $real->description . $real->resultat), strtolower($q))) {
						return false;
					}

					if ($competenceId && !$real->competences->contains('id', $competenceId)) {
						return false;
					}

					return true;
				});

				$vaeexp->setRelation('realisations', $filtered);
				return $vaeexp;
			})->filter(function ($vaeexp) {
				return $vaeexp->realisations->isNotEmpty();
			});
		}

		$organisations = Organisation::orderBy('lbl')->get();
		$competences = Competence::orderBy('nom')->get();

		return view('vaeexps.index', compact('vaeexps', 'organisations', 'competences', 'q', 'organisationId', 'competenceId'));
	}

    /**
     * Show the form for creating a new resource.
	 * ajout $organisationId
     */
	public function create(Request $request)
	{
		$organisationId = $request->query('organisation_id');
		$organisations = Organisation::all();

		return view('vaeexps.create', compact('organisations', 'organisationId'));
	}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'dd' => 'required|date',
            'df' => 'required|date|after_or_equal:dd',
            'fonction' => 'required|string|max:255',
            'description' => 'required|string',
            'organisation_id' => 'required|exists:organisations,id',
        ]);

        Vaeexp::create($validated);

        return redirect()->route('vaeexps.index')->with('success', 'Expérience ajoutée.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vaeexp $vaeexp)
    {
        return view('vaeexps.show', compact('vaeexp'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vaeexp $vaeexp)
    {
        $organisations = Organisation::all();
        return view('vaeexps.edit', compact('vaeexp', 'organisations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vaeexp $vaeexp)
    {
        $validated = $request->validate([
            'dd' => 'required|date',
            'df' => 'required|date|after_or_equal:dd',
            'fonction' => 'required|string|max:255',
            'description' => 'required|string',
            'organisation_id' => 'required|exists:organisations,id',
        ]);

        $vaeexp->update($validated);

        return redirect()->route('vaeexps.index')->with('success', 'Expérience mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vaeexp $vaeexp)
    {
        $vaeexp->delete();
        return redirect()->route('vaeexps.index')->with('success', 'Expérience supprimée.');
    }
}

