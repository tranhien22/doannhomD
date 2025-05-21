<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '1',
            'name_product' => 'Áo dài cách tân',
            'quantity_product' => '960',
            'price_product' => '3090000',
            'image_address_product' => '1744190738.jpg',
            'describe_product' => 'Áo dài cách tân Bạch Vũ 2025, áo dài 4 tà dáng xuông chất liệu toan tơ thêu họa tiết hoa phối quần phi',
            'specifications' => 'Việt Nam.;Dài áo 120cm lớp lót 1m25cm, quần 100cm;Áo hồng, quần hồng nhạt;XS-S-M-L-XL-XXL;Áo dài cách tân;Áo dài thiết kế;Lớp ngoài+lót lụa habutai, quần chất liệu lụa;',
            'sizes' => 'XS,S,M,L,XL,XXL', // Thêm kích thước
            'colors' => 'Hồng,Đỏ,Xanh,Vàng,Trắng,Đen', // Thêm màu sắc
        ]);

        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '2',
            'name_product' => 'Áo dài cách tân cao cấp',
            'quantity_product' => '500',
            'price_product' => '4090000',
            'image_address_product' => '1744190897.jpg',
            'describe_product' => 'Áo dài cách tân cao cấp với chất liệu lụa mềm mại, thiết kế tinh tế phù hợp cho các dịp lễ hội',
            'specifications' => 'Việt Nam.;Dài áo 130cm lớp lót 1m30cm, quần 110cm;Áo xanh, quần trắng;S-M-L-XL;Áo dài cách tân;Áo dài thiết kế;Lụa cao cấp;',
            'sizes' => 'S,M,L,XL', // Thêm kích thước
            'colors' => 'Xanh,Trắng,Đen', // Thêm màu sắc
        ]);

        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '3',
            'name_product' => 'Áo dài thiết kế đặc biệt',
            'quantity_product' => '300',
            'price_product' => '5090000',
            'image_address_product' => '1744190983.jpg',
            'describe_product' => 'Áo dài thiết kế đặc biệt với họa tiết thêu tay, chất liệu cao cấp, phù hợp cho các sự kiện quan trọng',
            'specifications' => 'Việt Nam.;Dài áo 140cm lớp lót 1m40cm, quần 120cm;Áo đỏ, quần đen;M-L-XL-XXL;Áo dài thiết kế;Áo dài cao cấp;Lụa thêu tay;',
            'sizes' => 'M,L,XL,XXL', // Thêm kích thước
            'colors' => 'Đỏ,Đen,Vàng', // Thêm màu sắc
        ]);

        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '2',
            'name_product' => 'Áo thun cotton nam',
            'quantity_product' => '1200',
            'price_product' => '199000',
            'image_address_product' => 'aothun1.jpg',
            'describe_product' => 'Áo thun cotton nam co giãn 4 chiều, thấm hút mồ hôi tốt, phù hợp mặc hàng ngày.',
            'specifications' => 'Việt Nam.;Dài áo 70cm;Trắng, Đen, Xám;S-M-L-XL;Áo thun;Cotton 100%;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Trắng,Đen,Xám',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '1',
            'name_product' => 'Đầm nữ dáng xòe',
            'quantity_product' => '800',
            'price_product' => '459000',
            'image_address_product' => 'dam1.jpg',
            'describe_product' => 'Đầm nữ dáng xòe chất liệu voan cao cấp, thiết kế trẻ trung, phù hợp đi tiệc.',
            'specifications' => 'Việt Nam.;Dài váy 95cm;Hồng, Xanh, Đen;S-M-L;Đầm nữ;Voan cao cấp;',
            'sizes' => 'S,M,L',
            'colors' => 'Hồng,Xanh,Đen',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '2',
            'name_product' => 'Quần dài kaki nam',
            'quantity_product' => '950',
            'price_product' => '299000',
            'image_address_product' => 'quandai1.jpg',
            'describe_product' => 'Quần dài kaki nam form slimfit, chất liệu dày dặn, bền màu.',
            'specifications' => 'Việt Nam.;Dài quần 100cm;Đen, Xám, Nâu;M-L-XL-XXL;Quần dài;Kaki;',
            'sizes' => 'M,L,XL,XXL',
            'colors' => 'Đen,Xám,Nâu',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '4',
            'id_manufacturer' => '3',
            'name_product' => 'Quần short jean nữ',
            'quantity_product' => '700',
            'price_product' => '259000',
            'image_address_product' => 'short1.jpg',
            'describe_product' => 'Quần short jean nữ năng động, phối tua rua cá tính, phù hợp đi chơi.',
            'specifications' => 'Việt Nam.;Dài quần 35cm;Xanh nhạt, Xanh đậm;S-M-L;Quần short;Jean;',
            'sizes' => 'S,M,L',
            'colors' => 'Xanh nhạt,Xanh đậm',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '5',
            'id_manufacturer' => '1',
            'name_product' => 'Áo chống nắng nữ UV',
            'quantity_product' => '1100',
            'price_product' => '189000',
            'image_address_product' => 'chongnang1.jpg',
            'describe_product' => 'Áo chống nắng nữ chất liệu thun lạnh, chống tia UV, nhẹ và thoáng mát.',
            'specifications' => 'Việt Nam.;Dài áo 65cm;Hồng, Xanh, Trắng, Đen;M-L-XL;Áo chống nắng;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Hồng,Xanh,Trắng,Đen',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '1',
            'id_manufacturer' => '2',
            'name_product' => 'Áo thun nữ cổ tròn',
            'quantity_product' => '1300',
            'price_product' => '179000',
            'image_address_product' => 'aothun2.jpg',
            'describe_product' => 'Áo thun nữ cổ tròn, chất liệu cotton mềm mại, nhiều màu sắc trẻ trung.',
            'specifications' => 'Việt Nam.;Dài áo 68cm;Trắng, Hồng, Vàng;S-M-L-XL;Áo thun;Cotton;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Trắng,Hồng,Vàng',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '2',
            'id_manufacturer' => '3',
            'name_product' => 'Đầm maxi đi biển',
            'quantity_product' => '600',
            'price_product' => '399000',
            'image_address_product' => 'dam2.jpg',
            'describe_product' => 'Đầm maxi đi biển họa tiết hoa, chất liệu voan mỏng nhẹ, thoáng mát.',
            'specifications' => 'Việt Nam.;Dài váy 120cm;Xanh, Vàng, Trắng;M-L-XL;Đầm maxi;Voan;',
            'sizes' => 'M,L,XL',
            'colors' => 'Xanh,Vàng,Trắng',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '3',
            'id_manufacturer' => '1',
            'name_product' => 'Quần dài nữ công sở',
            'quantity_product' => '850',
            'price_product' => '349000',
            'image_address_product' => 'quandai2.jpg',
            'describe_product' => 'Quần dài nữ công sở chất liệu tuyết mưa, form đứng, dễ phối đồ.',
            'specifications' => 'Việt Nam.;Dài quần 98cm;Đen, Be, Xám;S-M-L-XL;Quần dài;Tuyết mưa;',
            'sizes' => 'S,M,L,XL',
            'colors' => 'Đen,Be,Xám',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '4',
            'id_manufacturer' => '2',
            'name_product' => 'Quần short thể thao nam',
            'quantity_product' => '900',
            'price_product' => '159000',
            'image_address_product' => 'short2.jpg',
            'describe_product' => 'Quần short thể thao nam, chất liệu thun lạnh, co giãn tốt, thoải mái vận động.',
            'specifications' => 'Việt Nam.;Dài quần 40cm;Đen, Xám, Xanh;M-L-XL;Quần short;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Đen,Xám,Xanh',
        ]);
        
        DB::table('products')->insert([
            'id_category' => '5',
            'id_manufacturer' => '3',
            'name_product' => 'Áo chống nắng nam UV',
            'quantity_product' => '1000',
            'price_product' => '199000',
            'image_address_product' => 'chongnang2.jpg',
            'describe_product' => 'Áo chống nắng nam chất liệu thun lạnh, chống tia UV, thiết kế thể thao.',
            'specifications' => 'Việt Nam.;Dài áo 70cm;Xanh, Đen, Xám;M-L-XL;Áo chống nắng;Thun lạnh;',
            'sizes' => 'M,L,XL',
            'colors' => 'Xanh,Đen,Xám',
        ]);

    }
}