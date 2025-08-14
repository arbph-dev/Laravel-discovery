<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;





class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    $images = Image::with('realisations')
        ->orderBy('created_at', 'desc')
        ->paginate(50);

    return view('images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'filename' => 'required|file|mimes:jpg,jpeg,png,gif,webp|max:4096',
            'description' => 'nullable|string|max:255',
            'w' => 'nullable|integer',
            'h' => 'nullable|integer',
            'ext' => 'nullable|string|max:10',
        ]);

        if ($request->hasFile('filename')) {
            $file = $request->file('filename');

            // Déterminer le répertoire de destination
            $destinationPath = public_path('img/USER');

            // Créer le dossier s’il n’existe pas
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Nom final du fichier //$finalName = time() . '_' . $file->getClientOriginalName();
            $finalName = $file->getClientOriginalName();

            // Déplacer le fichier
            $file->move($destinationPath, $finalName);

            // Sauvegarder le chemin relatif dans la DB
            $validated['path'] = 'img/USER/' . $finalName;
            $validated['filename'] = $file->getClientOriginalName();
            $validated['ext'] = $file->getClientOriginalExtension();

            // Dimensions
            if ($size = getimagesize($destinationPath . '/' . $finalName)) {
                $validated['w'] = $size[0];
                $validated['h'] = $size[1];
            }
        }

        Image::create($validated);

        return redirect()->route('images.index')->with('success', 'Image ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        $image->load('realisations'); // Optionnel pour charger la relation
        return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        return view('images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'filename' => 'nullable|file|mimes:jpg,jpeg,png,gif,webp|max:4096',
            'description' => 'nullable|string|max:255',
            'w' => 'nullable|integer',
            'h' => 'nullable|integer',
            'ext' => 'nullable|string|max:10',
        ]);

        if ($request->hasFile('filename')) {
            // Supprimer l’ancien fichier
            if ($image->path && file_exists(public_path($image->path))) {
                unlink(public_path($image->path));
            }

            $file = $request->file('filename');
            $destinationPath = public_path('img/USER');

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            $finalName = $file->getClientOriginalName();
            $file->move($destinationPath, $finalName);

            $validated['path'] = 'img/USER/' . $finalName;
            $validated['filename'] = $file->getClientOriginalName();
            $validated['ext'] = $file->getClientOriginalExtension();

            // Dimensions
            if ($size = getimagesize($destinationPath . '/' . $finalName)) {
                $validated['w'] = $size[0];
                $validated['h'] = $size[1];
            }
        }

        $image->update($validated);

        return redirect()->route('images.index')->with('success', 'Image modifiée avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        if ($image->path && file_exists(public_path($image->path))) {
            unlink(public_path($image->path));
        }

        $image->delete();

        return redirect()->route('images.index')->with('success', 'Image supprimée avec succès.');
    }
}
