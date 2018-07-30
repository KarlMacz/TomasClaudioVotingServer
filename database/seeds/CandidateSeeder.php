<?php

use Illuminate\Database\Seeder;

use App\Candidates;
use App\Parties;
use App\Positions;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $parties = Parties::all();
        $positions = Positions::all();

        $ctr = 1;

        foreach($positions as $position) {
            foreach($parties as $party) {
                Candidates::create([
                    'student_id' => $ctr,
                    'party_id' => $party->id,
                    'position_id' => $position->id,
                    'candidacy_image' => sprintf('%05d', $ctr) . '.jpg'
                ]);

                $ctr++;
            }
        }
    }
}
