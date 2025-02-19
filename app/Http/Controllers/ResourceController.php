<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreResourceRequest;
use App\Http\Resources\ResourceResource;
use App\Services\ResourceService;

/**
 * @OA\Tag(
 *     name="Resources",
 *     description="API Endpoints for managing resources"
 * )
 */

class ResourceController extends Controller
{
    public function __construct(protected ResourceService $resourceService)

    {}

    /**
     * @OA\Get(
     *      path="/api/resources",
     *      tags={"Resources"},
     *      summary="Get all resources",
     *      @OA\Response(response=200, description="List of resources")
     * )
     */

    public function index(): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ResourceResource::collection($this->resourceService->getAllResources());
    }

    /**
     * @OA\Post(
     *      path="/api/resources",
     *      tags={"Resources"},
     *      summary="Create a new resource",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"name","type"},
     *              @OA\Property(property="name", type="string", example="Conference Room A"),
     *              @OA\Property(property="type", type="string", example="Room"),
     *              @OA\Property(property="description", type="string", example="A large conference room")
     *          )
     *      ),
     *      @OA\Response(response=201, description="Resource created"),
     *      @OA\Response(response=400, description="Validation error")
     * )
     */

    public function store(StoreResourceRequest $request): ResourceResource
    {
        $resource = $this->resourceService->createResource($request->validated());
        return new ResourceResource($resource);
    }

}
