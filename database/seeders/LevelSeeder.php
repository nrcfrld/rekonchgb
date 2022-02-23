<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Level::create([
            'name' => 'RETRIEVAL REQUEST',
            'descriptions' => '-'
        ]);

        Level::create([
            'name' => 'CHARGEBACK',
            'descriptions' => '-'
        ]);

        Level::create([
            'name' => 'SECOND CHARGEBACK',
            'descriptions' => '-'
        ]);

        Level::create([
            'name' => 'ARBITRATION CHARGEBACK',
            'descriptions' => '-'
        ]);
    }
}
