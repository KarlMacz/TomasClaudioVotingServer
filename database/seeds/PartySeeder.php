<?php

use Illuminate\Database\Seeder;

use App\Parties;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Parties::create([
            'name' => 'Independent'
        ]);
    }
}