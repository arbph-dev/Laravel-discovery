<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Organisation;
use App\Models\Vaeexp;
use App\Models\Competence;
use App\Models\Realisation;

class RealisationAcpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Organisations
        $organisations = [
            'Dalkia', 'Eolane', 'Montupet', 'Spontex', 'Stella Maris'
        ];
        $organisationIds = [];

        foreach ($organisations as $name) {
            $organisationIds[$name] = Organisation::firstOrCreate(['lbl' => $name])->id;
        }

        // VAEExps pour Dalkia uniquement
        $vaeexp = Vaeexp::firstOrCreate([
            'fonction' => 'Technicien Maintenance',
            'organisation_id' => $organisationIds['Dalkia']
        ], [
            'dd' => '2007-01-01',
            'df' => '2011-12-31',
            'description' => 'Exploitation, site principale Spontex. Energie et CVC'
        ]);

        // Compétences de base (simples pour exemple)
        $competences = [
            'Maintenance compresseur', 'Automatisme industriel', 'Economie d’énergie',
            'Gestion de centrale air comprimé', 'Audit installation gaz', 'Configuration automate',
            'Réglage pression', 'Recherche de fuite air', 'Comptage industriel', 'Coordination multi-sites'
        ];
        $competenceIds = [];
        foreach ($competences as $nom) {
            $competence = Competence::firstOrCreate(['nom' => $nom]);
            $competenceIds[] = $competence->id;
        }

        // Realisations avec client
        Realisation::firstOrCreate([
            'titre' => 'Maintenance centrale air Montupet',
            'vaeexp_id' => $vaeexp->id,
            'organisation_id' => $organisationIds['Montupet'],
        ], [
            'description' => 'Maintenance compresseurs Atlas Copco avec vidange, filtre, accouplements.',
            'resultat' => 'Compresseurs fiabilisés et consommation optimisée.',
            'conclusion' => 'Intervention périodique nécessaire.',
            'date_realisation' => '2010-06-01',
        ])->competences()->sync($competenceIds);

        Realisation::firstOrCreate([
            'titre' => 'Configuration concentrateur Spontex',
            'vaeexp_id' => $vaeexp->id,
            'organisation_id' => $organisationIds['Spontex'],
        ], [
            'description' => 'Paramétrage des concentrateurs de mesure et vérification sur supervision.',
            'resultat' => 'Mesures validées pour facturation.',
            'conclusion' => 'Réseau et automate adaptés.',
            'date_realisation' => '2012-03-15',
        ])->competences()->sync($competenceIds);

        Realisation::firstOrCreate([
            'titre' => 'Suppression sécheur absorption Eolane',
            'vaeexp_id' => $vaeexp->id,
            'organisation_id' => $organisationIds['Eolane'],
        ], [
            'description' => 'Intervention sur réseau air comprimé : suppression du sécheur.',
            'resultat' => 'Simplification installation, gain entretien.',
            'conclusion' => 'Intervention délicate mais maîtrisée.',
            'date_realisation' => '2014-04-10',
        ])->competences()->sync($competenceIds);
    }
}
