<?php
//app/Helpers/TableHelper.php

namespace App\Helpers;

use Carbon\Carbon; 

class TableHelper
{

	
public static function modelToTable($collection, $modelClass, $routeName = null)
{
    $first = $collection->first();
    if (!$first) return '<p>Aucune donnée</p>';

    // Récupère les colonnes + relations Eloquent déjà chargées
    $attributes = array_keys($first->getAttributes());
    $relations = array_keys($first->getRelations());

    // Exclut certains champs sensibles
    $fields = array_filter($attributes, fn ($attr) => !in_array($attr, [
																	'created_at',
																	'updated_at',
																	'deleted_at',
																	'password',
																	'remember_token',
																	'two_factor_secret',
																	'two_factor_recovery_codes',
																	'two_factor_confirmed_at',
																	]));

    $html = '<table class="table table-bordered"><thead><tr>';
    foreach ($fields as $field) {
        $html .= '<th>' . ucfirst(str_replace('_', ' ', $field)) . '</th>';
    }
    // Affiche aussi les relations connues
    foreach ($relations as $relation) {
        $html .= '<th>' . ucfirst($relation) . '</th>';
    }

    $html .= '<th>Actions</th></tr></thead><tbody>';

    foreach ($collection as $item) {
        $html .= '<tr>';

        // Champs simples
        foreach ($fields as $field) {
            $value = $item->$field;


			if ($value instanceof Carbon) {
				// Formate la date au format français
				$value = $value->format('d/m/Y H:i');
			} 
			elseif (is_object($value)) {
                if (method_exists($value, 'value')) { $value = $value->value; }
				elseif (method_exists($value, '__toString')) { $value = (string) $value; }
				elseif (property_exists($value, 'name')) { $value = $value->name; }
				elseif (isset($value->name)) { $value = $value->name; }
				elseif (isset($value->title)) { $value = $value->title; }
				else {$value = '[Object]';}
            }



            $html .= '<td>' . htmlspecialchars((string) $value) . '</td>';
        }

        // Relations
        foreach ($relations as $relation) {
            $related = $item->$relation;

            if ($related instanceof \Illuminate\Database\Eloquent\Model) {
                if (isset($related->name)) {
                    $value = $related->name;
                } elseif (isset($related->title)) {
                    $value = $related->title;
                } elseif (method_exists($related, '__toString')) {
                    $value = (string) $related;
                } else {
                    $value = '[Objet]';
                }
            } elseif (is_iterable($related)) {
                $value = '[Collection]';
            } else {
                $value = $related ?? '';
            }

            $html .= '<td>' . htmlspecialchars((string) $value) . '</td>';
        }

        // Lien vers la page de détail si `$routeName` est défini
        if ($routeName) {
            $url = route($routeName, $item->id);
            $html .= '<td><a href="' . $url . '">Voir</a></td>';
        } else {
            $html .= '<td></td>';
        }

        $html .= '</tr>';
    }

    $html .= '</tbody></table>';
    return $html;
}

	
	public static function usersTable($users) {
		return self::modelToTable($users, \App\Models\User::class, 'users.show');
	}
}
