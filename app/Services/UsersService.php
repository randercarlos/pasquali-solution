<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class UsersService extends AbstractService
{
    protected $model;

    public function __construct() {
        $this->model = new User();
    }

    public function save(array $data, Model $model = null): Model {

        if (!empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = parent::save($data, $model);

        return $user;
    }
}
