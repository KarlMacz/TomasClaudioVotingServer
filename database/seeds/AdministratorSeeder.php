<?php

use Illuminate\Database\Seeder;

use App\Accounts;
use App\Administrators;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Administrators::create([
            'first_name' => 'Karl',
            'middle_name' => null,
            'last_name' => 'Macz',
            'email' => 'karljarren0308@gmail.com'
        ]);

        if($admin) {
            Accounts::create([
                'username' => 'karlmacz',
                'type' => 'Administrator',
                'user_id' => $admin->id
            ]);
        }
    }
}
