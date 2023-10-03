<?php

namespace App\Http\Controllers\Api\Entities;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Entities\DestroyEntityRequest;
use App\Http\Requests\Entities\EntityRequest;
use App\Http\Requests\Entities\StoreEntityRequest;
use App\Http\Requests\Entities\UpdateEntityRequest;
use App\Http\Resources\Entities\EntityResource;
use App\Models\Entity;
use App\Repositories\EntityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EntitiesController extends ApiController
{

    public function __construct(
        Request $request, 
        protected EntityRepository $entityRepository,
    )
    {
        parent::__construct($request);
    }

    /**
     * @param EntityRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getEntities(EntityRequest $request): JsonResponse
    {
        $data = $request->safe()->collect();

        return $this->formatResponse([
            'entities' => $this->entityRepository
                ->getEntities($data->get(EntityRequest::REQUEST_USER_ID))
                ->paginate(
                    $data['per_page'] ?? 20,
                    ['*'],
                    'page',
                    $data['page'] ?? 1
                )
                ->onEachSide(1)
                ->through(fn ($jobListing) => new EntityResource($jobListing))
        ]);
    }

    /**
     * @param StoreEntityRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function createEntity(StoreEntityRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'prompt' => $this->entityRepository->createEntity($data)
        ]);
    }

    /**
     * @param Entity $entity 
     * @param UpdateEntityRequest $request 
     * @return JsonResponse 
     */
    public function updateEntity(Entity $entity, UpdateEntityRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $this->entityRepository->updateEntity($entity, $data)
        ]);
    }

    /**
     * @param Entity $entity
     * @param DestroyEntityRequest $request 
     * @return JsonResponse 
     */
    public function deleteEntity(Entity $entity, DestroyEntityRequest $request): JsonResponse
    {
        $data = $request->safe()->all();

        return $this->formatResponse([
            'status' => $entity->delete()
        ]);
    }
}