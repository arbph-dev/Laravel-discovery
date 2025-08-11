<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competence;


class CompetenceAiglon1Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
               // Parent: Maintenance
        $parent = Competence::firstOrCreate(
            ['nom' => 'Maintenance'],
            ['idp' => null, 'description' => 'Famille des métiers de maintenance industrielle et gaz']
        );

        $competences = [
            ['nom' => 'Contrôle d\'installation gaz industriel',
             'description' => 'Vérification de conformité des installations gaz',
             'code_rome' => 'I1304',
             'code_formacode' => '22654',
             'code_nsf' => '227r',
             'code_rncp' => 'RNCP35191'],

            ['nom' => 'Détection gaz et sécurité chaufferie',
             'description' => 'Mise en service et contrôle de centrale de détection gaz',
             'code_rome' => 'I1304',
             'code_formacode' => '24454',
             'code_nsf' => '227r',
             'code_rncp' => 'RNCP35191'],

            ['nom' => 'Audit documentaire technique',
             'description' => 'Analyse et vérification de rapports et bordereaux',
             'code_rome' => 'M1403',
             'code_formacode' => '34554',
             'code_nsf' => '310',
             'code_rncp' => 'RNCP36828'],

            ['nom' => 'Gestion de non-conformité',
             'description' => 'Identification, traitement et suivi des écarts techniques',
             'code_rome' => 'H1102',
             'code_formacode' => '34567',
             'code_nsf' => '310',
             'code_rncp' => 'RNCP37215'],

            ['nom' => 'Gestion de litige technique',
             'description' => 'Analyse, rapport, communication sur incidents techniques',
             'code_rome' => 'M1502',
             'code_formacode' => '34567',
             'code_nsf' => '310',
             'code_rncp' => null],

            ['nom' => 'Coordination multi-prestataires',
             'description' => 'Planification et gestion des interventions multi-entreprises',
             'code_rome' => 'M1607',
             'code_formacode' => '32654',
             'code_nsf' => '315',
             'code_rncp' => null],

            ['nom' => 'Sécurité gaz SPHP (24h)',
             'description' => 'Respect des obligations légales de sécurité gaz en continu',
             'code_rome' => 'I1304',
             'code_formacode' => '22654',
             'code_nsf' => '227r',
             'code_rncp' => 'RNCP35191'],

            ['nom' => 'Réglementation ICPE / ATEX',
             'description' => 'Connaissance et application des normes ICPE, ATEX, SPHP',
             'code_rome' => 'H1302',
             'code_formacode' => '24454',
             'code_nsf' => '344',
             'code_rncp' => 'RNCP35191'],
        ];

        foreach ($competences as $data) {
            Competence::firstOrCreate(
                ['nom' => $data['nom']],
                array_merge($data, ['idp' => $parent->id])
            );
        }
    }
}
