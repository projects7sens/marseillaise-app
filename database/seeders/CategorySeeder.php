<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = $this->createOptions();

        $categoriesStructure = [
            [
                'name' => 'Résidentiel',
                'description' => 'Biens immobiliers destinés à l’habitation.',
                'options' => [], // Parent categories hold children
                'children' => [
                    [
                        'name' => 'Appartement',
                        'description' => 'Appartements, studios, et duplex.',
                        'options' => ['surface', 'bedrooms', 'bathrooms', 'floor', 'amenities', 'parking'],
                    ],
                    [
                        'name' => 'Maison / Villa',
                        'description' => 'Maisons individuelles et villas.',
                        'options' => ['surface', 'bedrooms', 'bathrooms', 'amenities', 'garden', 'swimming-pool'],
                    ],
                ],
            ],
            [
                'name' => 'Commercial',
                'description' => 'Espaces commerciaux et bureaux.',
                'options' => [],
                'children' => [
                    [
                        'name' => 'Bureau',
                        'description' => 'Espaces de travail et bureaux.',
                        'options' => ['surface', 'floor', 'amenities', 'parking'],
                    ],
                    [
                        'name' => 'Local Commercial',
                        'description' => 'Boutiques et magasins.',
                        'options' => ['surface', 'amenities'],
                    ],
                ],
            ],
            [
                'name' => 'Terrain',
                'description' => 'Terrains constructibles et agricoles.',
                'options' => [],
                'children' => [
                    [
                        'name' => 'Terrain Constructible',
                        'description' => 'Terrains prêts pour la construction.',
                        'options' => ['surface'],
                    ],
                ],
            ],
        ];

        foreach ($categoriesStructure as $parentData) {
            $parentCategory = Category::factory()->create([
                'name' => $parentData['name'],
                'slug' => Str::slug($parentData['name']),
                'description' => $parentData['description'],
                'parent_id' => null,
            ]);

            if (! empty($parentData['children'])) {
                foreach ($parentData['children'] as $childData) {
                    $childCategory = Category::factory()->create([
                        'name' => $childData['name'],
                        'slug' => Str::slug($childData['name']),
                        'description' => $childData['description'],
                        'parent_id' => $parentCategory->id,
                    ]);

                    // Attach Options via Pivot
                    $sortOrder = 1;
                    foreach ($childData['options'] as $optionSlug) {
                        if (isset($options[$optionSlug])) {
                            $childCategory->options()->attach($options[$optionSlug]->id, [
                                'is_required' => in_array($optionSlug, ['surface', 'bedrooms']),
                                'sort_order'  => $sortOrder++,
                            ]);
                        }
                    }
                }
            }
        }
    }

    protected function createOptions(): array
    {
        $definedOptions = [
            'surface' => [
                'name' => 'Surface',
                'type' => 'number',
                'unit' => 'm²',
                'values' => null,
            ],
            'bedrooms' => [
                'name' => 'Chambres',
                'type' => 'select',
                'unit' => null,
                'values' => ['1', '2', '3', '4', '5+'],
            ],
            'bathrooms' => [
                'name' => 'Salles de bain',
                'type' => 'select',
                'unit' => null,
                'values' => ['1', '2', '3', '4+'],
            ],
            'floor' => [
                'name' => 'Étage',
                'type' => 'number',
                'unit' => null,
                'values' => null,
            ],
            'parking' => [
                'name' => 'Parking / Garage',
                'type' => 'checkbox',
                'unit' => null,
                'values' => ['Parking intérieur', 'Parking extérieur', 'Garage fermé'],
            ],
            'garden' => [
                'name' => 'Jardin',
                'type' => 'checkbox',
                'unit' => null,
                'values' => ['Privatif', 'Abonnement entretien'],
            ],
            'swimming-pool' => [
                'name' => 'Piscine',
                'type' => 'checkbox',
                'unit' => null,
                'values' => ['Privée', 'Commune'],
            ],
            'amenities' => [
                'name' => 'Équipements',
                'type' => 'checkbox',
                'unit' => null,
                'values' => ['Climatisation', 'Ascenseur', 'Sécurité / Gardien', 'Groupe électrogène', 'Surpresseur d\'eau'],
            ],
        ];

        $created = [];

        foreach ($definedOptions as $slug => $data) {
            $created[$slug] = Option::factory()->create([
                'name' => $data['name'],
                'slug' => $slug,
                'type' => $data['type'],
                'unit' => $data['unit'],
                'values' => $data['values'],
                'is_active' => true,
            ]);
        }

        return $created;
    }
}
