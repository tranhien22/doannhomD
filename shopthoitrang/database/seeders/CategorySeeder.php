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
            'image_category' => '321614075_560003435622661_2768779164236772902_n.jpg'

        ]);

        DB::table('categories')->insert([
            'name_category' => 'Đầm nữ',
            'image_category' => '1398322806-01.jpg'
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Quần dài',
             'image_category' => 'cach-xoa-tai-khoan-coin-master-1.jpg'
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Quần short',
             'image_category' => 'istockphoto-531325796-170667a.jpg'
        ]);

        DB::table('categories')->insert([
            'name_category' => 'Áo chống nắng',
             'image_category' => 'LEVVVEL-copy-1200x675.jpg'
        ]);
        
        DB::table('categories')->insert([
            'name_category' => 'Áo dài tay',
             'image_category' => 'lovepik-fashion-womens-summer-shopping-image-png-image_400331119_wh1200.png'
        ]);
        
        DB::table('categories')->insert([
            'name_category' => 'Váy dài',
             'image_category' => 'photo-8-15274726967981279646565.jpg'
        ]);
        
        DB::table('categories')->insert([
            'name_category' => 'Quần đùiđùi',
             'image_category' => 'pngtree-happy-surprise-black-man-points-in-bathrobe-white-background-photo-image_46585710.jpg'
        ]);
        
        DB::table('categories')->insert([
            'name_category' => 'Túi mù ',
             'image_category' => 'vulcano-1-1652263546844522213228.jpg'
        ]);

    }
}