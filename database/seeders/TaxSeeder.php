<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Tax::create([
            'name' => 'PPN 11%',
            'description' => 'Pajak Penghasilan Negara',
            'type' => 'percentage',
            'value' => 11,
            'status' => 'active',
            'expired_date' => '2029-10-31'
        ]);
    }
}
