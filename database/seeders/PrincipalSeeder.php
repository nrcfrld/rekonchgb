<?php

namespace Database\Seeders;

use App\Models\Principal;
use Illuminate\Database\Seeder;

class PrincipalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Principal::create([
            'name' => 'VS',
            'descriptions' => 'Visa'
        ]);
        Principal::create([
            'name' => 'MC',
            'descriptions' => 'Mastercard'
        ]);
        Principal::create([
            'name' => 'JCB',
            'descriptions' => 'JCB'
        ]);
        Principal::create([
            'name' => 'Jalin',
            'descriptions' => 'NPG Jalin EDC'
        ]);
        Principal::create([
            'name' => 'Rintis',
            'descriptions' => 'NPG Rintis'
        ]);
        Principal::create([
            'name' => 'Jalin QRIS',
            'descriptions' => 'NPG Rintis QRIS'
        ]);
        Principal::create([
            'name' => 'Debit On Us',
            'descriptions' => 'Debit On Us'
        ]);
        Principal::create([
            'name' => 'Credit On Us',
            'descriptions' => 'Credit On Us'
        ]);
    }
}
