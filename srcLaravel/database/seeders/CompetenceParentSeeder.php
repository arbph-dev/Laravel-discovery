<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Competence;

class CompetenceParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Création des compétences parentes
        $parents = [
            'Electrotechnique' => null,
            'Maintenance' => null,
            'Sécurité' => null,
            'CVC' => null,
            'Management' => null,
        ];

        foreach ($parents as $nom => $id) {
            $parent = Competence::firstOrCreate(['nom' => $nom], ['idp' => null]);
            $parents[$nom] = $parent->id;
        }

        // Compétences enfants avec référence au parent
        $competences = [
            // Electrotechnique
            ['Electrotechnique', 'Electricien industriel', 'Mise en service et maintenance d\'installations HTA/BT', 'I1309', '24069', '255n', 'RNCP36433;RNCP36441'],
            ['Electrotechnique', 'Automaticien industriel', 'Conception, programmation et maintenance d\'automatismes', 'I1304', '24454', '201n', 'RNCP37398;RNCP38948;RNCP38561'],
            ['Electrotechnique', 'Régulation & automatismes', 'PID, PLC, variateurs', 'I1304', '24454', '201n', null],
            ['Electrotechnique', 'Informatique industrielle', 'Programmation Python/C++ et protocoles industriels', 'I1401', '31054', '326', null],

            // Maintenance
            ['Maintenance', 'Responsable de maintenance', 'Organisation et pilotage de la maintenance', 'I1103', '24069', '255r', 'RNCP35191'],
            ['Maintenance', 'Maintenance HTA/BT', 'Câblage, mise en service et maintenance', 'I1304', '31054', '255m', null],
            ['Maintenance', 'Maintenance préventive et curative', 'Infrastructure, énergies, restauration', 'I1304', '31654', '255', null],

            // Sécurité
            ['Sécurité', 'Sécurité électrique', 'Habilitations NF C18‑510 (B0, B1, H1...)', 'I1304', '31054', '255m', null],
            ['Sécurité', 'Sécurité incendie', 'Installation et maintenance SDI/RIA/CMSI', 'K2504', '24454', '344', null],
            ['Sécurité', 'Sites SEVESO / explosivité', 'Analyse de risques et PPRT', null, null, null, null],
            ['Sécurité', 'Manipulation H2S', 'Exploitation en zone toxique/ATEX', null, null, null, null],

            // CVC
            ['CVC', 'GTC/GTB', 'Supervision CVC, sécurité, éclairage', null, null, null, null],

            // Management
            ['Management', 'Agent de maîtrise', 'Encadrement d\'Equipe et gestion de projets (maintenance/travaux)', 'M1607', '34567', '310', null],
        ];

        foreach ($competences as [$parentNom, $nom, $description, $codeRome, $codeFormacode, $codeNsf, $codeRncp]) {
            Competence::firstOrCreate(
                ['nom' => $nom],
                [
                    'idp' => $parents[$parentNom],
                    'description' => $description,
                    'code_rome' => $codeRome,
                    'code_formacode' => $codeFormacode,
                    'code_nsf' => $codeNsf,
                    'code_rncp' => $codeRncp,
                ]
            );
        }
    }
}
