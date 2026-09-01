<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            [
                'name' => 'Dakar',
                'slug' => 'dakar',
                'child' => [
                    ['name' => 'Cambérène', 'slug' => 'camberene'],
                    ['name' => 'Parcelles Assainies', 'slug' => 'parcelles-assainies'],
                    ['name' => 'Ngor', 'slug' => 'ngor'],
                    ['name' => 'Yoff', 'slug' => 'yoff'],
                    ['name' => 'Patte d‘oie', 'slug' => 'patte-doie'],
                    ['name' => 'Grand-Yoff', 'slug' => 'grand-yoff'],
                    ['name' => 'Sicap Liberté', 'slug' => 'sicap-liberte'],
                    ['name' => 'Ouakam', 'slug' => 'ouakam'],
                    ['name' => 'Dieuppeul', 'slug' => 'dieuppeul-derkle'],
                    ['name' => 'Hlm', 'slug' => 'hlm'],
                    ['name' => 'Biscuiterie', 'slug' => 'biscuiterie'],
                    ['name' => 'Grand-Dakar', 'slug' => 'grand-dakar'],
                    ['name' => 'Hann Bel-Air', 'slug' => 'hann-bel-air'],
                    ['name' => 'Mermoz', 'slug' => 'mermoz-sacre-coeur'],
                    ['name' => 'Gueule-Tapée', 'slug' => 'gueule-tapee-fass-colobane'],
                    ['name' => 'Médina', 'slug' => 'medina'],
                    ['name' => 'Plateau', 'slug' => 'plateau'],
                    ['name' => 'Gorée', 'slug' => 'goree'],
                    ['name' => 'Fann', 'slug' => 'fann-point-e-amitie'],
                    ['name' => 'Pikine', 'slug' => 'pikine'],
                    ['name' => 'Rufisque', 'slug' => 'rufisque'],
                    ['name' => 'Guediawaye', 'slug' => 'guediawaye'],
                    ['name' => 'Keur Massar', 'slug' => 'keur-massar'],
                    ['name' => 'Kounoune', 'slug' => 'kounoune'],
                    ['name' => 'Bambilor', 'slug' => 'bambilor'],
                    ['name' => 'Ndiakhirate', 'slug' => 'ndiakhirate'],
                    ['name' => 'Sangalkam', 'slug' => 'sangalkam'],
                    ['name' => 'Mbao', 'slug' => 'mbao'],
                    ['name' => 'Almadies', 'slug' => 'almadies'],
                    ['name' => 'Virage', 'slug' => 'virage'],
                    ['name' => 'Ouest foire', 'slug' => 'ouest-foire'],
                    ['name' => 'Nord foire', 'slug' => 'nord-foire'],
                    ['name' => 'Djily mbaye', 'slug' => 'djily-mbaye'],
                    ['name' => 'Thongor', 'slug' => 'thongor'],
                    ['name' => 'Sud foire', 'slug' => 'sud-foire'],
                    ['name' => 'Sicap foire', 'slug' => 'sicap-foire'],
                    ['name' => 'Hlm grand-yoff', 'slug' => 'hlm-grand-yoff'],
                    ['name' => 'Liberte 1', 'slug' => 'liberte-1'],
                    ['name' => 'Liberte 2', 'slug' => 'liberte-2'],
                    ['name' => 'Liberte 3', 'slug' => 'liberte-3'],
                    ['name' => 'Liberte 4', 'slug' => 'liberte-4'],
                    ['name' => 'Liberte 6', 'slug' => 'liberte-6'],
                    ['name' => 'Liberte 6 extension', 'slug' => 'liberte-6-extension'],
                    ['name' => 'Liberte 5', 'slug' => 'liberte-5'],
                    ['name' => 'Mamelles', 'slug' => 'mamelles'],
                    ['name' => 'Comico', 'slug' => 'comico'],
                    ['name' => 'Cité avion', 'slug' => 'cite-avion'],
                    ['name' => 'Cité asecna', 'slug' => 'cite-asecna'],
                    ['name' => 'Cité assemblée', 'slug' => 'cite-assemblee'],
                    ['name' => 'Derkle', 'slug' => 'derkle'],
                    ['name' => 'Hann maristes', 'slug' => 'hann-maristes'],
                    ['name' => 'Bel air', 'slug' => 'bel-air'],
                    ['name' => 'Zone industrielle', 'slug' => 'zone-industrielle'],
                    ['name' => 'Hann marinas', 'slug' => 'hann-marinas'],
                    ['name' => 'Sacré-cœur', 'slug' => 'sacre-coeur'],
                    ['name' => 'Sicap Sacré-cœur', 'slug' => 'sicap-sacre-coeur'],
                    ['name' => 'Cité keur gorgui', 'slug' => 'cite-keur-gorgui'],
                    ['name' => 'Sicap baobab', 'slug' => 'sicap-baobab'],
                    ['name' => 'Fenêtre mermoz', 'slug' => 'fenetre-mermoz'],
                    ['name' => 'Point-e', 'slug' => 'point-e'],
                    ['name' => 'Amitié', 'slug' => 'amitie'],
                    ['name' => 'Karack', 'slug' => 'karack'],
                    ['name' => 'Colobane', 'slug' => 'colobane'],
                    ['name' => 'Gibraltar', 'slug' => 'gibraltar'],
                    ['name' => 'Thiaroye', 'slug' => 'thiaroye'],
                    ['name' => 'Diamaguene', 'slug' => 'diamaguene'],
                    ['name' => 'Sicap mbao', 'slug' => 'sicap-mbao'],
                    ['name' => 'Dalifort', 'slug' => 'dalifort'],
                    ['name' => 'Djidah thiaroye kaw', 'slug' => 'djidah-thiaroye-kaw'],
                    ['name' => 'Guinaw rail', 'slug' => 'guinaw-rail'],
                    ['name' => 'Malika', 'slug' => 'malika'],
                    ['name' => 'Yeumbeul', 'slug' => 'yeumbeul'],
                    ['name' => 'Bargny', 'slug' => 'bargny'],
                    ['name' => 'Sebikotane', 'slug' => 'sebikotane'],
                    ['name' => 'Diamniadio', 'slug' => 'diamniadio'],
                    ['name' => 'Niakoul rap', 'slug' => 'niakoul-rap'],
                    ['name' => 'Sendou', 'slug' => 'sendou'],
                    ['name' => 'Toubab dialo', 'slug' => 'toubab-dialo'],
                    ['name' => 'Lac rose', 'slug' => 'lac-rose'],
                    ['name' => 'Yene', 'slug' => 'yene'],
                    ['name' => 'Tivaouane peulh', 'slug' => 'tivaouane-peulh'],
                    ['name' => 'Keur ndiaye lô', 'slug' => 'keur-ndiaye-lo'],
                    ['name' => 'Golf', 'slug' => 'golf'],
                    ['name' => 'Cité biagui', 'slug' => 'cite-biagui'],
                    ['name' => 'VDN', 'slug' => 'vdn'],
                    ['name' => 'Zone de captage', 'slug' => 'zone-de-captage'],
                    ['name' => 'Castor', 'slug' => 'castor'],
                    ['name' => 'Zac Mbao', 'slug' => 'zac-mbao'],
                    ['name' => 'Almadies 2', 'slug' => 'almadies-2'],
                    ['name' => 'Cité Damel', 'slug' => 'cite-damel'],
                    ['name' => 'Niague', 'slug' => 'niague'],
                    ['name' => 'Gorom', 'slug' => 'gorom'],
                    ['name' => 'Cite Mixta', 'slug' => 'cite-mixta'],
                    ['name' => 'Avenue Bourguiba', 'slug' => 'avenue-bourguiba'],
                    ['name' => 'Noflaye', 'slug' => 'noflaye'],
                    ['name' => 'Fann Hock', 'slug' => 'fann-hock'],
                    ['name' => 'Fass', 'slug' => 'fass'],
                    ['name' => 'Bayakh', 'slug' => 'bayakh'],
                    ['name' => 'vdn 3', 'slug' => 'vdn-3'],
                    ['name' => 'cité magistrat', 'slug' => 'cite-magistrat'],
                    ['name' => 'Corniche', 'slug' => 'corniche'],
                ],
            ],
            [
                'name' => 'Diourbel',
                'slug' => 'diourbel',
                'child' => [],
            ],
            [
                'name' => 'Fatick',
                'slug' => 'fatick',
                'child' => [],
            ],
            [
                'name' => 'Kaolack',
                'slug' => 'kaolack',
                'child' => [],
            ],
            [
                'name' => 'Kolda',
                'slug' => 'kolda',
                'child' => [],
            ],
            [
                'name' => 'Louga',
                'slug' => 'louga',
                'child' => [],
            ],
            [
                'name' => 'Matam',
                'slug' => 'matam',
                'child' => [],
            ],
            [
                'name' => 'Saint-Louis',
                'slug' => 'saint-louis',
                'child' => [],
            ],
            [
                'name' => 'Tambacounda',
                'slug' => 'tambacounda',
                'child' => [],
            ],
            [
                'name' => 'Thiès',
                'slug' => 'thies',
                'child' => [],
            ],
            [
                'name' => 'Ziguinchor',
                'slug' => 'ziguinchor',
                'child' => [],
            ],
            [
                'name' => 'Sédhiou',
                'slug' => 'sedhiou',
                'child' => [],
            ],
            [
                'name' => 'Kaffrine',
                'slug' => 'kaffrine',
                'child' => [],
            ],
            [
                'name' => 'Kedougou',
                'slug' => 'kedougou',
                'child' => [],
            ],
            [
                'name' => 'Autres',
                'slug' => 'autres',
                'child' => [],
            ],
        ];

        $country = Country::query()->where('code', 'SN')->first();

        foreach ($locations as $regionData) {
            $region = Location::factory()->create([
                'country_id' => $country->id,
                'parent_id'  => null,
                'name'       => $regionData['name'],
                'slug'       => $regionData['slug'],
                'level'      => 0,
            ]);

            if (! empty($regionData['child'])) {
                foreach ($regionData['child'] as $childData) {
                    Location::factory()->create([
                        'country_id' => $country->id,
                        'parent_id'  => $region->id,
                        'name'       => $childData['name'],
                        'slug'       => $childData['slug'],
                        'level'      => 1,
                    ]);
                }
            }
        }
    }
}
