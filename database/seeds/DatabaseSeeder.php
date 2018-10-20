<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(SettingSeeder::class);
        $this->call(PositionSeeder::class);
        $this->call(PartySeeder::class);
        $this->call(AdministratorSeeder::class);
        $this->call(StudentSeeder::class);
        $this->call(CandidateSeeder::class);
    }
}
