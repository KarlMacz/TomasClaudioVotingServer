<?php

use Illuminate\Database\Seeder;

use Faker\Factory as FakerFactory;

use App\Accounts;
use App\Students;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = FakerFactory::create();

        for($i = 0; $i < 100; $i++) {
            $student = Students::create([
                'first_name' => $faker->firstName,
                'middle_name' => (mt_rand(0, 9) % 2 === 0 ? $faker->lastName : null),
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->email
            ]);

            if($student) {
                Accounts::create([
                    'username' => mt_rand(2010, (int) date('Y')) . '-' . sprintf('%05d', $i),
                    'type' => 'Student',
                    'user_id' => $student->id
                ]);
            }
        }
    }

    public function randomCollege()
    {
        $colleges = [
            'College of Arts and Sciences',
            'College of Business & Accountancy',
            'College of Information Technology',
            'College of Education',
            'College of Hotel and Restaurant Management'
        ];

        return $colleges[mt_rand(0, count($colleges) - 1)];
    }

    public function randomCourse($college)
    {
        switch($college) {
            case 'College of Arts and Sciences':
                $courses = [
                    'Bachelor of Science in Nursing',
                    'Bachelor of Science in Midwifery',
                    'Bachelor of Science in Physical Theraphy',
                    'Bachelor of Arts Major in Economics',
                    'Bachelor of Arts Major in English',
                    'Bachelor of Arts Major in History',
                    'Bachelor of Science in Criminology',
                    'Associate in Arts in Police and Public Administration'
                ];

                break;
            case 'College of Business & Accountancy':
                $courses = [
                    'Bachelor of Science in Accountancy',
                    'Bachelor of Science in Business Administration Major in Business Economics',
                    'Bachelor of Science in Business Administration Major in Financial Management',
                    'Bachelor of Science in Business Administration Major in Human Resource Development Management',
                    'Bachelor of Science in Business Administration Major in Marketing Management',
                    'Bachelor of Science in Business Administration Major in Operations Management',
                    'Bachelor of Science in Business Administration Major in Financial and Management Accounting',
                    'Bachelor of Science in Public Administration',
                    'Associate in Business Administration',
                    'Associate in Computer Secretarial'
                ];

                break;
        }

        return $courses[mt_rand(0, count($courses) - 1)];
    }
}
