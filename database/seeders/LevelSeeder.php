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
            'descriptions' => '-',
            'level' => 1,
        ]);

        Level::create([
            'name' => 'CHARGEBACK',
            'descriptions' => '-',
            'level' => 2
        ]);

        Level::create([
            'name' => 'SECOND CHARGEBACK',
            'descriptions' => '-',
            'level' => 3
        ]);

        Level::create([
            'name' => 'ARBITRATION CHARGEBACK',
            'descriptions' => '-',
            'level' => 4
        ]);
    }
}
