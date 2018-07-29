<?php

use Illuminate\Database\Seeder;

use Faker\Factory as FakerFactory;

use App\Accounts;
use App\Candidates;
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
        $genders = ['Male', 'Female'];

        for($i = 0; $i < 100; $i++) {
            $college = $this->randomCollege();
            $course = $this->randomCourse($college);

            $gender = $genders[mt_rand(0, 1)];

            $account = Accounts::create([
                'username' => mt_rand(2010, (int) date('Y')) . '-' . sprintf('%05d', mt_rand(1, 99999)),
                'type' => 'Student',
                'email' => $faker->unique()->email
            ]);

            if($account) {
                $student = Students::create([
                    'account_id' => $account->id,
                    'first_name' => $faker->firstName($gender),
                    'middle_name' => (mt_rand(0, 9) % 2 === 0 ? $faker->lastName : null),
                    'last_name' => $faker->lastName,
                    'gender' => $gender,
                    'college' => $college,
                    'course' => $course
                ]);

                if($student->id % 2 === 0 && $student->id > 90) {
                    Candidates::insert([
                        'student_id' => $student->id,
                        'position_id' => 1,
                        'party_id' => 1
                    ]);
                }
            }
        }
    }

    private function randomCollege()
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

    private function randomCourse($college)
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
            case 'College of Information Technology':
                $courses = [
                    'Bachelor of Science in Computer Science',
                    'Associate in Computer Technology'
                ];

                break;
            case 'College of Education':
                $courses = [
                    'Bachelor of Elementary Education',
                    'Bachelor of Secondary Education Major in English',
                    'Bachelor of Secondary Education Major in Filipino',
                    'Bachelor of Secondary Education Major in Mathematics',
                    'Bachelor of Secondary Education Major in Social Studies',
                    'Bachelor of Secondary Education Major in Values Education',
                    'Bachelor of Secondary Education Major in Biological and Physical Science',
                    'Bachelor of Secondary Education Major in MAPEH'
                ];

                break;
            case 'College of Hotel and Restaurant Management':
                $courses = [
                    'Bachelor of Science in Hotel and Restaurant Management'
                ];

                break;
            default:
                $courses = [];

                break;
        }

        if($courses > 0) {
            return $courses[mt_rand(0, count($courses) - 1)];
        }
    }
}
