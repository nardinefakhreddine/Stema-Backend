<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class scoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("scores")->insert([
            'name' => 'A',
            'descripion'=>'Absence of sugars , salt , lipids',
        ]);
        DB::table("scores")->insert([
            'name' => 'B',
            'descripion'=>'No or little of sugars , salt , lipids',
        ]);
        DB::table("scores")->insert([
            'name' => 'C',
            'descripion'=>'Little quantity of sugars , salt , lipids',
        ]);
        DB::table("scores")->insert([
            'name' => 'D',
            'descripion'=>'Considerable quatity of sugars , salt , lipids',
        ]);
        DB::table("scores")->insert([
            'name' => 'E',
            'descripion'=>'Extensive amount of sugars , salt , lipids',
        ]);
       
    }
}
