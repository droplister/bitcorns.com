<?php

use Droplister\XcpCore\Database\Seeds\AssetsTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(QuotesTableSeeder::class);
        $this->call(HarvestsTableSeeder::class);
        $this->call(AssetsTableSeeder::class);
        $this->call(TokensTableSeeder::class);
    }
}
