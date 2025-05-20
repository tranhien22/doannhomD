<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name_category' => 'Áo thun',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Đầm nữ',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Quần dài',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Quần short',
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Áo chống nắng',
        ]);

    }
}
