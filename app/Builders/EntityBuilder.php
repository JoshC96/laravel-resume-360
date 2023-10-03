<?php 

namespace App\Builders;

use App\Models\Entity;
use App\Models\EntityContact;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;

class EntityBuilder 
{     
    public function __construct(
        protected ?int $userId = null
    ) {
        $this->userId = $userId;
    }

    /**
     * @param null|int $userId 
     * @return EntityBuilder 
     */
    public function forUser(?int $userId = null): self
    {
        $this->userId = $userId;
        return $this;
    }

    public function getQuery(): Builder
    {
        $query = Entity::query();

        if ($this->userId) {
            $query->whereHas(Entity::RELATION_CONTACTS, function(Builder $query) {
                return $query->whereHas(EntityContact::RELATION_USER, function (Builder $query) {
                    return $query->where(User::TABLE . '.' . User::FIELD_ID, $this->userId);
                });
            });
        }

        return $query;
    }

}