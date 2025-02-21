<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserRepository
{
    private User $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * Get basic list of users with only id and name
     * @return Collection Collection of users with minimal data
     */
    public function getBasicUsersList(): Collection
    {
        return $this->model->select(['id', 'name'])->get();
    }

    public function getStaffUsers()
    {
        return User::staffOnly()->get();
    }

    public function findById($id)
    {
        return User::find($id);
    }
} 