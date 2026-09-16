<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions =["teacher",'student','managing director'];

        foreach ($positions as $position) {
           Position::create([
            "name"=>$position
           ]);
        }
    }
}
