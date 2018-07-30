<?php

use Illuminate\Database\Seeder;

use App\Positions;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Positions::create([
            'name' => 'President'
        ]);
        Positions::create([
            'name' => 'Vice President'
        ]);
        Positions::create([
            'name' => 'Secretary'
        ]);
        Positions::create([
            'name' => 'Treasurer'
        ]);
        Positions::create([
            'name' => 'Auditor'
        ]);
        Positions::create([
            'name' => 'Business Manager'
        ]);
        Positions::create([
            'name' => 'PRO'
        ]);
    }
}
