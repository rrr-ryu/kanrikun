<?php

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
            [
                'company_id' => 1,
                'product_name' => "test1",
                'price' => 1001,
                'stock' => 1,
                'comment' => "test1 comment",
                'img_path' => "sample1.jpg",
            ],
            [
                'company_id' => 2,
                'product_name' => "test2",
                'price' => 1002,
                'stock' => 2,
                'comment' => "test2 comment",
                'img_path' => "sample2.jpg",
            ],
            [
                'company_id' => 3,
                'product_name' => "test3",
                'price' => 1003,
                'stock' => 3,
                'comment' => "test3 comment",
                'img_path' => "sample3.jpg",
            ],
            [
                'company_id' => 4,
                'product_name' => "test4",
                'price' => 1004,
                'stock' => 4,
                'comment' => "test4 comment",
                'img_path' => "sample4.jpg",
            ],
        ]);
    }
}
