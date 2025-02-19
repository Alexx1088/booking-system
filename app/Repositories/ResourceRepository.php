<?php

namespace App\Repositories;

use App\Models\Resource;

class ResourceRepository
{
    public function all(): \Illuminate\Database\Eloquent\Collection
    {
        return Resource::all();
    }

    public function create(array $data): Resource
    {
        return Resource::create($data);
    }

}
