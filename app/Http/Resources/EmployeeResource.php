<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'cpf' => $this->cpf,
            'rg' => $this->rg,
            'birthday' => $this->birth->format('d/m/Y'),
            'email' => $this->email,
            'currentSalary' => new EmployeeSalaryHistoricResource($this->currentSalary),
            'address' => new AddressResource($this->address)
        ];
    }
}
