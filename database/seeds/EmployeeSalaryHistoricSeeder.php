<?php

use Illuminate\Database\Seeder;
use App\Models\EmployeeSalaryHistoric;

class EmployeeSalaryHistoricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(EmployeeSalaryHistoric::class, 30)->create();
    }
}
