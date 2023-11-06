<?php

namespace App\Http\Controllers\Api\Entities;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Entities\DestroyEntityRequest;
use App\Http\Requests\Entities\EntityRequest;
use App\Http\Requests\Entities\StoreEntityRequest;
use App\Http\Requests\Entities\UpdateEntityRequest;
use App\Http\Resources\Contacts\ContactResource;
use App\Http\Resources\Entities\EntityResource;
use App\Http\Resources\Jobs\JobListingResource;
use App\Http\Resources\Locations\EntityLocationResource;
use App\Models\Entity;
use App\Repositories\EntityRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * @param StoreEntityRequest $request 
     * @return JsonResponse 
     */
    public function register(StoreEntityRequest $request): JsonResponse
    {
        $data = $request->safe()->toArray();

        $entity = $this->entityRepository->createEntity($data, Auth::user());

        return $this->formatResponse([
            'status' => true,
            'entity' => $entity
        ]);
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
                ->through(fn ($entity) => new EntityResource($entity))
        ]);
    }

    /**
     * @param EntityRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getEntityContacts(Entity $entity, EntityRequest $request): JsonResponse
    {
        $data = $request->safe()->collect();

        return $this->formatResponse([
            'contacts' => $entity->{Entity::RELATION_CONTACTS}()
                ->paginate(
                    $data['per_page'] ?? 5,
                    ['*'],
                    'page',
                    $data['page'] ?? 1
                )
                ->onEachSide(1)
                ->through(fn ($contact) => new ContactResource($contact))
        ]);
    }

    /**
     * @param EntityRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getEntityLocations(Entity $entity, EntityRequest $request): JsonResponse
    {
        $data = $request->safe()->collect();

        return $this->formatResponse([
            'locations' => $entity->{Entity::RELATION_LOCATIONS}()
                ->paginate(
                    $data['per_page'] ?? 5,
                    ['*'],
                    'page',
                    $data['page'] ?? 1
                )
                ->onEachSide(1)
                ->through(fn ($entity) => new EntityLocationResource($entity))
        ]);
    }

    /**
     * @param EntityRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getEntityJobs(Entity $entity, EntityRequest $request): JsonResponse
    {
        $data = $request->safe()->collect();

        return $this->formatResponse([
            'jobs' => $entity->{Entity::RELATION_JOBS}()
                ->paginate(
                    $data['per_page'] ?? 5,
                    ['*'],
                    'page',
                    $data['page'] ?? 1
                )
                ->onEachSide(1)
                ->through(fn ($job) => new JobListingResource($job))
        ]);
    }


    /**
     * @param Entity $entity 
     * @param EntityRequest $request 
     * @return JsonResponse 
     * @throws BindingResolutionException 
     */
    public function getEntity(Entity $entity, EntityRequest $request): JsonResponse
    {
        return $this->formatResponse([
            'entity' => new EntityResource($entity)
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