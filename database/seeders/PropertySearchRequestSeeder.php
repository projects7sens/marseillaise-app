<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\PropertySearchRequest;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySearchRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $leafCategories = Category::whereNotNull('parent_id')->with('options')->get();
        if ($leafCategories->isEmpty()) {
            $leafCategories = Category::with('options')->get();
        }

        $locations = Location::where('level', 1)->get();
        if ($locations->isEmpty()) {
            $locations = Location::all();
        }

        for ($i = 0; $i < 30; $i++) {
            $category = $leafCategories->random();

            $propertySearchRequest = PropertySearchRequest::factory()
                ->create([
                    'category_id' => $category->id,
                    'location_id' => $locations->random()->id,
                ]);

            $this->attachOptionValues($propertySearchRequest, $category);
        }
    }

    protected function attachOptionValues(PropertySearchRequest $propertySearchRequest, Category $category): void
    {
        foreach ($category->options as $option) {
            if (fake()->boolean(30)) {
                continue;
            }

            $value = match ($option->type) {
                'number'   => (string) fake()->numberBetween(20, 450),
                'select', 'checkbox' => !empty($option->values)
                    ? fake()->randomElements($option->values, fake()->numberBetween(1, min(3, count($option->values))))
                    : ['1'],
                default    => fake()->word(),
            };

            if (method_exists($propertySearchRequest, 'options')) {
                $propertySearchRequest->options()->attach($option->id, [
                    'value' => is_array($value) ? json_encode($value) : $value,
                ]);
            }
        }
    }
}
