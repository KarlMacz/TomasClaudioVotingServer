<?php

use Illuminate\Database\Seeder;

use App\Settings;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Settings::create([
            'name' => 'is_election_started',
            'value' => false
        ]);
        Settings::create([
            'name' => 'election_until',
            'value' => date('Y-m-d H:i:s')
        ]);
        Settings::create([
            'name' => 'is_results_released',
            'value' => 0
        ]);
    }
}
