<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brand = new Brand();
        $brand->name = 'Sunhouse1';
        $brand->image = '1.jfif';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse2';
        $brand->image = '2.jfif';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse3';
        $brand->image = '3.jfif';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse4';
        $brand->image = '8.jfif';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse5';
        $brand->image = '4.png';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse6';
        $brand->image = '5.png';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse7';
        $brand->image = '6.png';
        $brand->save();

        $brand = new Brand();
        $brand->name = 'Sunhouse8';
        $brand->image = '7.png';
        $brand->save();
    }
}
