<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeSalaryHistoricResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'salary' => (new \NumberFormatter('pt_BR', \NumberFormatter::CURRENCY))->formatCurrency($this->salary, 'BRL')
        ];
    }
}
