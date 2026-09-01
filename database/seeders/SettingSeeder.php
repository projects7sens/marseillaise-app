<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings  = config('core.settings');
        $dotNotationSettings = Arr::dot($settings);

        foreach ($dotNotationSettings as $key => $value) {
            Setting::factory()
                ->keyValuePair($key, $value)
                ->create();
        }
    }
}
