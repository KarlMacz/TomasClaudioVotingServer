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
            'username' => 'karlmacz',
            'password' => bcrypt('asd123'),
            'type' => 'Administrator',
            'email' => 'karljarren0308@gmail.com'
        ]);

        if($account) {
            Administrators::create([
                'account_id' => $account->id,
                'first_name' => 'Karl',
                'middle_name' => null,
                'last_name' => 'Macz',
                'gender' => 'Male'
            ]);
        }
    }
}
