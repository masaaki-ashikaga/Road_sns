<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++)
        {
            Brand::create([
                'id' => $i,
                'name' => 'ブランドテスト' . $i,
                'text' => 'これはブランド' . $i . 'です。',
                'brand_image' => 'test_brand.jpg',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
