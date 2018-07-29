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
        $account = Accounts::create([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'type' => 'Administrator',
            'email' => 'tcc.admin@gmail.com'
        ]);

        if($account) {
            Administrators::create([
                'account_id' => $account->id,
                'first_name' => 'Juan',
                'middle_name' => null,
                'last_name' => 'Dela Cruz',
                'gender' => 'Male'
            ]);
        }
    }
}
