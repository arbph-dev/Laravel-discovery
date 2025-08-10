<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    protected $fillable = [
        'filename',
        'path',
        'w',
        'h',
        'ext',
        'alt',
		'description'
    ];
	
	public function realisations()
	{
		return $this->belongsToMany(Realisation::class, 'image_realisation');
	}
	
	public function url()
{
	return asset('public/' . $this->path);
}
}
