<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Vaeexp extends Model
{
    protected $table = 'vaeexps';

    protected $fillable = [
        'dd',
        'df',
        'fonction',
        'description',
        'organisation_id'
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }
	
	public function realisations()
	{
		return $this->hasMany(Realisation::class);
	}	

    public function getDureeAttribute()
    {
        if ($this->dd && $this->df) {
            //return Carbon::parse($this->dd)->diff(Carbon::parse($this->df))->format('%M mois');
			return (int) Carbon::parse($this->dd)->floatDiffInMonths(Carbon::parse($this->df));
			
        }
        return null;
    }
}