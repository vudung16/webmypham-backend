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
        DB::table('brand')->insert([
            'id' => 1,
            'name' => 'Thương hiệu 1',
            'image' => 'image1.jpg',
        ]);
        DB::table('brand')->insert([
            'id' => 2,
            'name' => 'Thương hiệu 2',
            'image' => 'image1.jpg',
        ]);
        DB::table('brand')->insert([
            'id' => 3,
            'name' => 'Thương hiệu 3',
            'image' => 'image1.jpg',
        ]);
        DB::table('brand')->insert([
            'id' => 4,
            'name' => 'Thương hiệu 4',
            'image' => 'image1.jpg',
        ]);
        DB::table('brand')->insert([
            'id' => 5,
            'name' => 'Thương hiệu 5',
            'image' => 'image1.jpg',
        ]);
        DB::table('brand')->insert([
            'id' => 6,
            'name' => 'Thương hiệu 6',
            'image' => 'image1.jpg',
        ]);

        // data category
        DB::table('category')->insert([
            'id' => 1,
            'name' => 'Trang điểm'
        ]);
        DB::table('category')->insert([
            'id' => 2,
            'name' => 'Chăm sóc da'
        ]);
        DB::table('category')->insert([
            'id' => 3,
            'name' => 'Chăm sóc tóc'
        ]);
        DB::table('category')->insert([
            'id' => 4,
            'name' => 'Phụ kiện'
        ]);
        DB::table('category')->insert([
            'id' => 5,
            'name' => 'Nước hoa'
        ]);
        DB::table('category')->insert([
            'id' => 6,
            'name' => 'Chăm sóc toàn thân'
        ]);
        DB::table('category')->insert([
            'id' => 7,
            'name' => 'Làm đẹp'
        ]);

        //data Slide

        DB::table('slide')->insert([
            'id' => 1,
            'image' => 'banner-chuong-trinh-dinh-cu-Chau-Au-Cyprus-3_1920x650_1619248280.jpg',
            'status' => 1
        ]);
        DB::table('slide')->insert([
            'id' => 2,
            'image' => '3169-13dc-4d1f-8cf9-74526f2cb115_1619248296.jpg',
            'status' => 1
        ]);
        DB::table('slide')->insert([
            'id' => 3,
            'image' => 'abc_1619248317.jpg',
            'status' => 1
        ]);

        // data Rate
        DB::table('rate')->insert([
            'id' => 1,
            'user_id' => 2,
            'product_id' => 1,
            'rate_scores' => 4,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('rate')->insert([
            'id' => 2,
            'user_id' => 3,
            'product_id' => 1,
            'rate_scores' => 3,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('rate')->insert([
            'id' => 3,
            'user_id' => 1,
            'product_id' => 1,
            'rate_scores' => 2,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('rate')->insert([
            'id' => 4,
            'user_id' => 4,
            'product_id' => 1,
            'rate_scores' => 2,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('rate')->insert([
            'id' => 5,
            'user_id' => 5,
            'product_id' => 1,
            'rate_scores' => 5,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('rate')->insert([
            'id' => 6,
            'user_id' => 6,
            'product_id' => 1,
            'rate_scores' => 3,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);
        DB::table('rate')->insert([
            'id' => 7,
            'user_id' => 7,
            'product_id' => 1,
            'rate_scores' => 4,
            'rate_comment' => 'Sản phẩm rất tốt'
        ]);

        // data Product
        DB::table('product')->insert([
            'id' => 1,
            'name' =>'Bột uống đẹp da The Collagen Shiseido 126g – Mẫu 2020',
            'description' => 'aaaaaaaaaaaaaaaaa',
            'content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'image' => 'banner-chuong-trinh-dinh-cu-Chau-Au-Cyprus-3_1920x650_1619248621.jpg',
            'price' => 600000,
            'discount' => 15,
            'selling' => 100,
            'category_id' => 1,
            'brand_id' => 1,
            'width' => 1,
            'height' => 1,
            'length' => 1,
            'weight' => 1
        ]);
        DB::table('product')->insert([
            'id' => 2,
            'name' =>'Kem Chống Nắng Innisfree Intensive Long-Lasting',
            'description' => 'bbbbbbbbbbbbbbbbb',
            'content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'image' => 'abc_1619248657.jpg',
            'price' => 500000,
            'discount' => 5,
            'selling' => 90,
            'category_id' => 2,
            'brand_id' => 2,
            'width' => 2,
            'height' => 2,
            'length' => 2,
            'weight' => 2
        ]);
        DB::table('product')->insert([
            'id' => 3,
            'name' =>'Thuốc nhuộm tóc màu đen',
            'description' => 'ccccccccccccc',
            'content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'image' => '3169-13dc-4d1f-8cf9-74526f2cb115_1619248697.jpg',
            'price' => 400000,
            'discount' => 10,
            'selling' => 80,
            'category_id' => 3,
            'brand_id' => 3,
            'width' => 3,
            'height' => 3,
            'length' => 3,
            'weight' => 3
        ]);
        DB::table('product')->insert([
            'id' => 4,
            'name' =>'Thuốc nhuộm tóc màu trắng',
            'description' => 'ddddddddddddd',
            'content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'image' => '173400742_460638591874969_4862181734524333373_n_1620126373.jpg',
            'price' => 300000,
            'discount' => 15,
            'selling' => 70,
            'category_id' => 4,
            'brand_id' => 4,
            'width' => 4,
            'height' => 4,
            'length' => 4,
            'weight' => 4
        ]);
        DB::table('product')->insert([
            'id' => 5,
            'name' =>'Thuốc kích thích mọc tóc mạnh dũng 200g',
            'description' => 'eeeeeeeeeeeeeeeeee',
            'content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'image' => '177477867_167044531882917_8303938402316297695_n_1620126681.jpg',
            'price' => 200000,
            'discount' => 15,
            'selling' => 60,
            'category_id' => 5,
            'brand_id' => 5,
            'width' => 5,
            'height' => 5,
            'length' => 5,
            'weight' => 5
        ]);
        DB::table('product')->insert([
            'id' => 6,
            'name' =>'Kem chống nắng toàn thân ban đêm Mạnh Dũng 200g',
            'description' => 'ffffffffffffffffff',
            'content' => 'Ligula ullamcorper malesuada proin libero nunc consequat interdum varius. Turpis egestas pretium aenean pharetra magna ac placerat. Sed egestas egestas fringilla phasellus faucibus scelerisque eleifend donec. Sed cras ornare arcu dui. Aliquam vestibulum morbi blandit cursus. Adipiscing elit ut aliquam purus sit amet. Aenean sed adipiscing diam donec adipiscing tristique risus nec. Ut etiam sit amet nisl purus in mollis. Eu mi bibendum neque egestas congue quisque egestas diam in. Pellentesque adipiscing commodo elit at imperdiet dui accumsan sit.',
            'image' => '843_Webp.net-compress-image-16_1620185044.jpg',
            'price' => 100000,
            'discount' => 15,
            'selling' => 50,
            'category_id' => 6,
            'brand_id' => 6,
            'width' => 6,
            'height' => 6,
            'length' => 6,
            'weight' => 6
        ]);

        // data voucher
        DB::table('vouchers')->insert([
            'id' => 1,
            'code' =>'MANHDUNG01',
            'image' => 'voucher01.png',
            'name' => 'Giảm giá 5% cho tổng giá trị đơn hàng',
            'description' => 'Giảm giá 5% cho tổng giá trị đơn hàng',
            'uses' => 5,
            'max_uses' => 50,
            'max_uses_user' => 2,
            'minimum_order' => 200000,
            'discount_amount' => 50000,
            'percentage' => 5,
            'starts_at' => '2022-02-24 00:00:00.000000',
            'expires_at' => '2022-03-24 00:00:00.000000'
        ]);
        DB::table('vouchers')->insert([
            'id' => 2,
            'code' =>'MANHDUNG02',
            'image' => 'voucher02.png',
            'name' => 'Giảm giá 10% cho tổng giá trị đơn hàng',
            'description' => 'Giảm giá 10% cho tổng giá trị đơn hàng',
            'uses' => 5,
            'max_uses' => 50,
            'max_uses_user' => 2,
            'minimum_order' => 500000,
            'discount_amount' => 60000,
            'percentage' => 10,
            'starts_at' => '2022-02-24 00:00:00.000000',
            'expires_at' => '2022-03-24 00:00:00.000000'
        ]);
        DB::table('vouchers')->insert([
            'id' => 3,
            'code' =>'MANHDUNG03',
            'image' => 'voucher03.png',
            'name' => 'Giảm giá 15% cho tổng giá trị đơn hàng',
            'description' => 'Giảm giá 15% cho tổng giá trị đơn hàng',
            'uses' => 5,
            'max_uses' => 50,
            'max_uses_user' => 2,
            'minimum_order' => 700000,
            'discount_amount' => 70000,
            'percentage' => 15,
            'starts_at' => '2022-02-24 00:00:00.000000',
            'expires_at' => '2022-03-24 00:00:00.000000'
        ]);
        DB::table('vouchers')->insert([
            'id' => 4,
            'code' =>'MANHDUNG04',
            'image' => 'voucher04.png',
            'name' => 'Giảm giá 20% cho tổng giá trị đơn hàng',
            'description' => 'Giảm giá 20% cho tổng giá trị đơn hàng',
            'uses' => 5,
            'max_uses' => 50,
            'max_uses_user' => 2,
            'minimum_order' => 1000000,
            'discount_amount' => 80000,
            'percentage' => 20,
            'starts_at' => '2022-02-24 00:00:00.000000',
            'expires_at' => '2022-03-24 00:00:00.000000'
        ]);

        //data user
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'admin',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);
        DB::table('users')->insert([
            'id' => 2,
            'name' => 'admin2',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);
        DB::table('users')->insert([
            'id' => 3,
            'name' => 'admin3',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);
        DB::table('users')->insert([
            'id' => 4,
            'name' => 'admin4',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);
        DB::table('users')->insert([
            'id' => 5,
            'name' => 'admin5',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);
        DB::table('users')->insert([
            'id' => 6,
            'name' => 'admin6',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);
        DB::table('users')->insert([
            'id' => 7,
            'name' => 'admin7',
            'password' => Hash::make('12345'),
            'image' => 'abc.png',
            'role' => 1,
            'email' => 'admin@gmail.com'
        ]);

        //data user_voucher
        DB::table('user_voucher')->insert([
            'id' => 1,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);
        DB::table('user_voucher')->insert([
            'id' => 2,
            'user_id' => 1,
            'voucher_id' => 1,
        ]);
    }
}
