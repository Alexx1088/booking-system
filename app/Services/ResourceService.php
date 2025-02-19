<?php

namespace App\Services;

use App\Repositories\ResourceRepository;

class ResourceService

{
public function __construct(protected ResourceRepository $resourceRepository)
{}

    public function getAllResources(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->resourceRepository->all();
    }

    public function createResource($data): \App\Models\Resource
    {
        return $this->resourceRepository->create($data);
    }

}
