<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            [
                'company_name' => "サントリー",
                'street_address' => "test1",
                'representative_name' => "テスト１",
            ],
            [
                'company_name' => "アサヒ",
                'street_address' => "test2",
                'representative_name' => "テスト２",
            ],
            [
                'company_name' => "サッポロ",
                'street_address' => "test3",
                'representative_name' => "テスト３",
            ],
            [
                'company_name' => "キリン",
                'street_address' => "test4",
                'representative_name' => "テスト４",
            ],
        ]);
    }
}
