<?php

use Illuminate\Database\Seeder;
use App\Repository\Markers;

class MarkersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Markers::class, 3000)->create();
        //
    }
}
