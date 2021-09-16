<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        $this->call(UserSeeder::class);
        $this->call(EmployeeSeeder::class);
        $this->call(AddressSeeder::class);
        $this->call(EmployeeSalaryHistoricSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
