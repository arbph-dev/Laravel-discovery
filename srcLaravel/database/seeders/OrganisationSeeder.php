<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Organisation;

class OrganisationSeeder extends Seeder
{
    public function run()
    {
        $organisations = [
            // ./public/img/VAE/SOC/

			//"G:\OBSIDIAN\VAE\VAE\VAE\SOC\DOUARNENEZ_EOLANE\20150122_112121.jpg"
			[
                'lbl' => 'Capitaine Cook',
                'adville' => 'Clohars Carnoët',
                'addep' => '29',
                'codeape' => '10.20Z',
                'lblape' => 'Transformation et conservation de poisson, de crustacés et de mollusques',
                'urlweb' => 'https://www.mousquetaires.com/nos-filiales/agromousquetaires/nos-poles-de-performance/filiere-produits-de-la-mer-agromousquetaires/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/capitaine-cook-376080305',
                'pich' => './public/img/VAE/SOC/cook.png',
                'picl' => './public/img/VAE/SOC/logo_cook.png	',
            ],
			
			//./public/img/VAE/SOC/logo_eolane.jpg						
            [
                'lbl' => 'Eolane',
                'adville' => 'Angers',
                'addep' => '49',
                'codeape' => '26.12Z',
                'lblape' => 'Fabrication de cartes électroniques assemblées',
                'urlweb' => 'https://www.eolane.com',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/eolane-angers-eurintel-eolane-950020941',
                'pich' => './public/img/VAE/SOC/logo_eolane.jpg	',
                'picl' => './public/img/VAE/SOC/logo_eolane.jpg	',
            ],			
			// ./public/img/VAE/SOC/logo_sodiaal.png

	        [
                'lbl' => 'Sodiaal',
                'adville' => 'Paris',
                'addep' => '75',
                'codeape' => '46.33Z',
                'lblape' => 'Commerce de gros (commerce interentreprises) de produits laitiers, œufs, huiles et matières grasses ,comestibles',
                'urlweb' => 'https://sodiaal.coop/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/sodiaal-union-sodiaal-351572888',
                'pich' => './public/img/VAE/SOC/logo_sodiaal.png',
                'picl' => './public/img/VAE/SOC/logo_sodiaal.png',
            ],		
			// ./public/img/VAE/SOC/logo_vg.jpg
	        [
                'lbl' => 'Verlingue',
                'adville' => 'Quimper',
                'addep' => '29',
                'codeape' => '66.22Z',
                'lblape' => 'Activités des agents et courtiers d’assurances',
                'urlweb' => 'https://www.verlingue.fr/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/verlingue-verlingue-440315943',
                'pich' => './public/img/VAE/SOC/logo_vg.jpg',
                'picl' => './public/img/VAE/SOC/logo_vg.jpg',
            ],			

			//Lycée Polyvalent - Paul SERUSIER
			
			[
                'lbl' => 'Lycée Polyvalent - Paul SERUSIER',
                'adville' => 'Carhaix Plouguer',
                'addep' => '29',
                'codeape' => '85.31Z',
                'lblape' => 'Enseignement secondaire général',
                'urlweb' => 'https://lycee-serusier-carhaix.ac-rennes.fr/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/lycee-polyvalent-paul-serusier-lpo-192900223',
                'pich' => '',
                'picl' => '',
            ],
			//LYCEE POLYVALENT PIERRE GUEGUIN - 
			[
                'lbl' => 'Lycée des métiers des énergies et du nautisme - Pierre GUEGUIN',
                'adville' => 'Concarneau',
                'addep' => '29',
                'codeape' => '85.31Z',
                'lblape' => 'Enseignement secondaire général',
                'urlweb' => 'http://www.lycee-pierre-gueguin.fr/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/lycee-polyvalent-pierre-gueguin-lycee-des-metiers-des-energies-et-du-nautisme-lpo-192900306',
                'pich' => '',
                'picl' => '',
            ],
			//Lycée Professionnel Maritime - Guilvinec 
			// ./public/img/VAE/SOC/logo-lpmg.gif
			// ./public/img/VAE/SOC/logo-lpmg_l.png
			[
                'lbl' => 'Lycée Professionnel Maritime - Guilvinec',
                'adville' => 'Treffiagat',
                'addep' => '29',
                'codeape' => '85.31Z',
                'lblape' => 'Enseignement secondaire général',
                'urlweb' => 'https://lycee-maritime-guilvinec.bzh/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/lycee-professionnel-maritime-guilvinec-192920973',
                'pich' => './public/img/VAE/SOC/logo-lpmg.gif',
                'picl' => './public/img/VAE/SOC/logo-lpmg_l.png',
            ],
			//LYCEE GENERAL ET TECHNOLOGIQUE LAENNEC
			[
                'lbl' => 'Lycée général et technologique - LAENNEC',
                'adville' => 'Pont l abbé',
                'addep' => '29',
                'codeape' => '85.31Z',
                'lblape' => 'Enseignement secondaire général',
                'urlweb' => 'https://www.lycee-laennec-pontlabbe.ac-rennes.fr/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/lycee-general-et-technologique-laennec-192900629',
                'pich' => '',
                'picl' => '',
            ],			
			
			//./public/img/VAE/SOC/logo_henaff_l.png
            [
                'lbl' => 'Hénaff',
                'adville' => 'Pouldreuzic',
                'addep' => '29',
                'codeape' => '10.13A',
                'lblape' => 'Préparation industrielle de produits à base de viande',
                'urlweb' => 'https://www.henaff.com/',
                'urlreg' => 'https://annuaire-entreprises.data.gouv.fr/entreprise/jean-henaff-sas-402978639',
                'pich' => './public/img/VAE/SOC/logo_henaff.png',
                'picl' => './public/img/VAE/SOC/logo_henaff_l.png',
            ],

        ];

        foreach ($organisations as $data) {
            Organisation::firstOrCreate(['lbl' => $data['lbl']], $data);
        }
    }
}
