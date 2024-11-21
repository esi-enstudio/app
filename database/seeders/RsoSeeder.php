<?php

namespace Database\Seeders;

use App\Models\Rso;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RsoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Rso::insert([
            ['dd_house_id' => 1, 'user_id' => 6, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000003', 'code' => 'RS040001', 'number' => '01915270101'],
            ['dd_house_id' => 1, 'user_id' => 7, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000003', 'code' => 'RS040002', 'number' => '01915270102'],
            ['dd_house_id' => 1, 'user_id' => 8, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000003', 'code' => 'RS040003', 'number' => '01915270103'],
            ['dd_house_id' => 2, 'user_id' => 9, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000004', 'code' => 'RS040004', 'number' => '01915270104'],
            ['dd_house_id' => 2, 'user_id' => 10, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000004', 'code' => 'RS040005', 'number' => '01915270105'],
            ['dd_house_id' => 2, 'user_id' => 11, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000004', 'code' => 'RS040006', 'number' => '01915270106'],
            ['dd_house_id' => 3, 'user_id' => 12, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000005', 'code' => 'RS040007', 'number' => '01915270107'],
            ['dd_house_id' => 3, 'user_id' => 13, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000005', 'code' => 'RS040008', 'number' => '01915270108'],
            ['dd_house_id' => 3, 'user_id' => 14, 'zm_number' => '01911000001', 'manager_number' => '01911000002', 'supervisor_number' => '01911000005', 'code' => 'RS040009', 'number' => '01915270109'],
        ]);
    }
}
