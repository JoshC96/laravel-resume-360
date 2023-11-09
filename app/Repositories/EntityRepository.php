<?php

namespace App\Repositories;

use App\Builders\EntityBuilder;
use App\Models\Entity;
use App\Models\EntityContact;
use App\Models\EntityLocation;
use App\Models\JobListing;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Support\Str;
use InvalidArgumentException;

class EntityRepository
{

    public function __construct(protected EntityBuilder $entityBuilder) {}


    /**
     * @param array $data 
     * @param User|null $user 
     * @return Entity 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function createEntity(array $data, ?User $user = null): Entity
    {
        $entity = new Entity();
        $entity->fill($data);
        $entity->save();

        if($user) {
            $this->entityContactFromUser($entity, $user);
        }

        if(config('app.env') != 'production') {
            EntityLocation::factory(5)
                ->state([
                    EntityLocation::FIELD_ENTITY_ID => $entity->{Entity::FIELD_ID},
                ])
                ->create();

            EntityContact::factory(5)
                ->state([
                    EntityContact::FIELD_ENTITY_ID => $entity->{Entity::FIELD_ID},
                ])
                ->create();

            JobListing::factory(5)
                ->state([
                    JobListing::FIELD_ENTITY_ID => $entity->{Entity::FIELD_ID},
                ])
                ->create();
        }

        return $entity;
    }

    /**
     * @param Entity $entity 
     * @param User $user 
     * @return EntityContact 
     * @throws MassAssignmentException 
     * @throws InvalidArgumentException 
     * @throws InvalidCastException 
     */
    public function entityContactFromUser(Entity $entity, User $user): EntityContact
    {
        $contact = new EntityContact();
        $contact->fill([
            EntityContact::FIELD_NAME => $user->{User::FIELD_NAME},
            EntityContact::FIELD_PHONE => $user->{User::FIELD_WORK_PHONE},
            EntityContact::FIELD_EMAIL => $user->{User::FIELD_EMAIL},
            EntityContact::FIELD_USER_ID => $user->{User::FIELD_ID},
            EntityContact::FIELD_ENTITY_ID => $entity->{Entity::FIELD_ID}
        ]);
        $contact->save();

        return $contact;
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