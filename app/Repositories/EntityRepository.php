<?php

namespace App\Repositories;

use App\Builders\EntityBuilder;
use App\Models\Entity;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\InvalidCastException;

class EntityRepository
{

    public function __construct(protected EntityBuilder $entityBuilder) {}


    /**
     * @param array $data 
     * @return Entity 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function createEntity(array $data): Entity
    {
        $job = new Entity();
        $job->fill($data);
        $job->save();

        return $job;
    }

    /**
     * @param Entity $referee 
     * @param array $data 
     * @return bool 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function updateEntity(Entity $job, array $data): bool
    {
        $job->fill($data);
        return $job->save();
    }

    /**
     * @param int|null $userId 
     * @return Builder 
     */
    public function getEntities(?int $userId = null): Builder
    {
        return $this->entityBuilder
            ->forUser($userId)
            ->getQuery();
    }
}