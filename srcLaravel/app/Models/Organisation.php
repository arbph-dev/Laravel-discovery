<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $table = 'organisations';

    protected $fillable = [
        'lbl',
        'adville',
        'addep',
        'codeape',
        'lblape',
        'urlweb',
        'urlreg',
        'pich',
        'picl',
    ];


    public function vaeexp()
    {
        return $this->hasMany(Vaeexp::class);
    }
}