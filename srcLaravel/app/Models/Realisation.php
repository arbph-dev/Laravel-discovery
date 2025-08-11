<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Realisation extends Model
{
    protected $fillable = [
        'vaeexp_id',
        'organisation_id',
        'titre',
        'description',
        'resultat',
        'conclusion',
        'date_realisation'
    ];

    public function vaeexp()
    {
        return $this->belongsTo(Vaeexp::class);
    }

    public function client()
    {
        return $this->belongsTo(Organisation::class, 'organisation_id');
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class, 'competence_realisation');
    }

    public function images()
    {
        return $this->belongsToMany(Image::class, 'image_realisation');
    }
}
