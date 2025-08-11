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
       
	   //$images = Image::all();
	   //dd($images);
	   
	   $images = Image::orderBy('created_at', 'desc')->paginate(20);
	   //dd($images);
		
		return view('images.index', compact('images'));
		//return view('images.index'); // 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //$image->load('realisations'); // Optionnel pour charger la relation
        //return view('images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
