<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Location;
use App\Models\Media;
use App\Models\Property;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userRole = Role::where('name', 'Admin')->firstOrFail();
        $users = User::where('role_id', $userRole->id)->get();

        if ($users->isEmpty()) {
            $users = User::factory()->count(3)->create();
        }

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

            $property = Property::factory()
                ->published()
                ->create([
                    'user_id' => $users->random()->id,
                    'category_id' => $category->id,
                    'location_id' => $locations->random()->id,
                ]);

            $this->attachOptionValues($property, $category);
            $this->attachMedia($property);
        }

        for ($i = 0; $i < 10; $i++) {
            $category = $leafCategories->random();

            Property::factory()
                ->disabled()
                ->create([
                    'user_id' => $users->random()->id,
                    'category_id' => $category->id,
                    'location_id' => $locations->random()->id,
                ]);

            $this->attachOptionValues($property, $category);
            $this->attachMedia($property);
        }
    }

    protected function attachOptionValues(Property $property, Category $category): void
    {
        foreach ($category->options as $option) {
            $value = match ($option->type) {
                'number'   => (string) fake()->numberBetween(20, 450),
                'select'   => !empty($option->values) ? fake()->randomElement($option->values) : '1',
                'checkbox' => !empty($option->values) ? fake()->randomElements($option->values, fake()->numberBetween(1, count($option->values))) : [],
                default    => fake()->word(),
            };

            // Assuming a property_options pivot table or relationship
            if (method_exists($property, 'options')) {
                $property->options()->attach($option->id, [
                    'value' => is_array($value) ? json_encode($value) : $value,
                ]);
            }
        }
    }

    protected function attachMedia(Property $property): void
    {
        $imageCount = fake()->numberBetween(2, 5);
        $order = 1;

        for ($i = 1; $i <= $imageCount; $i++) {
            Media::factory()
                ->forEntity($property)
                ->create([
                    'sort_order' => $order++,
                ]);
        }

        Media::factory()
            ->video()
            ->forEntity($property)
            ->create([
                'sort_order' => $order++,
            ]);

        if (fake()->boolean(50)) {
            Media::factory()
                ->document()
                ->forEntity($property)
                ->create([
                    'sort_order' => $order++,
                ]);
        }
    }
}
