<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = [
        'nom',
        'idp',
        'code_rome',
        'code_formacode',
        'code_nsf',
        'code_rncp',
        'description',
    ];

    public function parent()
    {
        return $this->belongsTo(Competence::class, 'idp');
    }

    public function enfants()
    {
        return $this->hasMany(Competence::class, 'idp');
    }
}
