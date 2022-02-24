<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // data brand
        DB::table('cosmetics_brand')->insert([
            'brand_id' => 1,
            'brand_name' => 'Thương hiệu 1'
        ]);
        DB::table('cosmetics_brand')->insert([
            'brand_id' => 2,
            'brand_name' => 'Thương hiệu 2'
        ]);
        DB::table('cosmetics_brand')->insert([
            'brand_id' => 3,
            'brand_name' => 'Thương hiệu 3'
        ]);
        DB::table('cosmetics_brand')->insert([
            'brand_id' => 4,
            'brand_name' => 'Thương hiệu 4'
        ]);
        DB::table('cosmetics_brand')->insert([
            'brand_id' => 5,
            'brand_name' => 'Thương hiệu 5'
        ]);
        DB::table('cosmetics_brand')->insert([
            'brand_id' => 6,
            'brand_name' => 'Thương hiệu 6'
        ]);

        // data category
        DB::table('cosmetics_category')->insert([
            'category_id' => 1,
            'category_name' => 'Trang điểm'
        ]);
        DB::table('cosmetics_category')->insert([
            'category_id' => 2,
            'category_name' => 'Chăm sóc da'
        ]);
        DB::table('cosmetics_category')->insert([
            'category_id' => 3,
            'category_name' => 'Chăm sóc tóc'
        ]);
        DB::table('cosmetics_category')->insert([
            'category_id' => 4,
            'category_name' => 'Phụ kiện'
        ]);
        DB::table('cosmetics_category')->insert([
            'category_id' => 5,
            'category_name' => 'Nước hoa'
        ]);
        DB::table('cosmetics_category')->insert([
            'category_id' => 6,
            'category_name' => 'Chăm sóc toàn thân'
        ]);
        DB::table('cosmetics_category')->insert([
            'category_id' => 7,
            'category_name' => 'Làm đẹp'
        ]);

        //data Slide

        DB::table('cosmetics_slide')->insert([
            'slide_id' => 1,
            'slide_image' => 'banner-chuong-trinh-dinh-cu-Chau-Au-Cyprus-3_1920x650_1619248280.jpg',
            'slide_status' => 1
        ]);
        DB::table('cosmetics_slide')->insert([
            'slide_id' => 2,
            'slide_image' => '3169-13dc-4d1f-8cf9-74526f2cb115_1619248296.jpg',
            'slide_status' => 1
        ]);
        DB::table('cosmetics_slide')->insert([
            'slide_id' => 3,
            'slide_image' => 'abc_1619248317.jpg',
            'slide_status' => 1
        ]);

        // data Rate
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 1,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 4,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 2,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 3,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 3,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 2,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 4,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 2,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 5,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 5,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 6,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 3,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('cosmetics_rate')->insert([
            'rate_id' => 7,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 4,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);

        // data Product 
        DB::table('cosmetics_product')->insert([
            'product_id' => 1,
            'product_name' =>'Bột uống đẹp da The Collagen Shiseido 126g – Mẫu 2020',
            'product_description' => 'aaaaaaaaaaaaaaaaa',
            'product_content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'product_image' => 'banner-chuong-trinh-dinh-cu-Chau-Au-Cyprus-3_1920x650_1619248621.jpg',
            'product_price' => 600000,
            'product_discount' => 15,
            'product_selling' => 100,
            'category_id' => 1,
            'brand_id' => 1,
            'product_width' => 1,
            'product_height' => 1,
            'product_length' => 1,
            'product_weight' => 1
        ]);
        DB::table('cosmetics_product')->insert([
            'product_id' => 2,
            'product_name' =>'Kem Chống Nắng Innisfree Intensive Long-Lasting',
            'product_description' => 'bbbbbbbbbbbbbbbbb',
            'product_content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'product_image' => 'abc_1619248657.jpg',
            'product_price' => 500000,
            'product_discount' => 5,
            'product_selling' => 90,
            'category_id' => 2,
            'brand_id' => 2,
            'product_width' => 2,
            'product_height' => 2,
            'product_length' => 2,
            'product_weight' => 2
        ]);
        DB::table('cosmetics_product')->insert([
            'product_id' => 3,
            'product_name' =>'Thuốc nhuộm tóc màu đen',
            'product_description' => 'ccccccccccccc',
            'product_content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'product_image' => '3169-13dc-4d1f-8cf9-74526f2cb115_1619248697.jpg',
            'product_price' => 400000,
            'product_discount' => 10,
            'product_selling' => 80,
            'category_id' => 3,
            'brand_id' => 3,
            'product_width' => 3,
            'product_height' => 3,
            'product_length' => 3,
            'product_weight' => 3
        ]);
        DB::table('cosmetics_product')->insert([
            'product_id' => 4,
            'product_name' =>'Thuốc nhuộm tóc màu trắng',
            'product_description' => 'ddddddddddddd',
            'product_content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'product_image' => '173400742_460638591874969_4862181734524333373_n_1620126373.jpg',
            'product_price' => 300000,
            'product_discount' => 15,
            'product_selling' => 70,
            'category_id' => 4,
            'brand_id' => 4,
            'product_width' => 4,
            'product_height' => 4,
            'product_length' => 4,
            'product_weight' => 4
        ]);
        DB::table('cosmetics_product')->insert([
            'product_id' => 5,
            'product_name' =>'Thuốc kích thích mọc tóc mạnh dũng 200g',
            'product_description' => 'eeeeeeeeeeeeeeeeee',
            'product_content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'product_image' => '177477867_167044531882917_8303938402316297695_n_1620126681.jpg',
            'product_price' => 200000,
            'product_discount' => 15,
            'product_selling' => 60,
            'category_id' => 5,
            'brand_id' => 5,
            'product_width' => 5,
            'product_height' => 5,
            'product_length' => 5,
            'product_weight' => 5
        ]);
        DB::table('cosmetics_product')->insert([
            'product_id' => 6,
            'product_name' =>'Kem chống nắng toàn thân ban đêm Mạnh Dũng 200g',
            'product_description' => 'ffffffffffffffffff',
            'product_content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'product_image' => '843_Webp.net-compress-image-16_1620185044.jpg',
            'product_price' => 100000,
            'product_discount' => 15,
            'product_selling' => 50,
            'category_id' => 6,
            'brand_id' => 6,
            'product_width' => 6,
            'product_height' => 6,
            'product_length' => 6,
            'product_weight' => 6
        ]);

        // DB::table('users')->insert([
        //     'name' => 'admin',
        //     'password' => Hash::make('12345'),
        //     'role' => 1,
        //     'email' => 'admin@gmail.com'
        // ]);
    }
}
