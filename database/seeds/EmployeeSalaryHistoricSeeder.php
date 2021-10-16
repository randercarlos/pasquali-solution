<?php

use App\Models\EmployeeSalaryHistoric;
use Illuminate\Database\Seeder;

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
