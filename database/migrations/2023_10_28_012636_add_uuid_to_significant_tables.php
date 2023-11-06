<?php

use App\Models\User;
use App\Models\Entity;
use App\Models\EntityContact;
use App\Models\JobListing;
use App\Models\Location;
use App\Models\Prompt;
use App\Models\PromptTemplate;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{

    public const MODELS = [
        User::class,
        Entity::class,
        EntityContact::class,
        Location::class,
        JobListing::class,
        Prompt::class,
        PromptTemplate::class
    ];

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        foreach(self::MODELS as $class) {
            /** @var Model $model */
            $model = new $class;
            $query = $model->newQuery();

            if (method_exists($query, 'withTrashed')) {
                $query->withTrashed();
            }

            Schema::table($model->getTable(), function (Blueprint $table) {
                $table->uuid('uuid')->after('id');
            });

            $query->chunk(1000, function (Collection $chunk) {
                $chunk->each(function (Model $model) {
                    $model->uuid = Str::uuid();
                    $model->save();
                });
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        foreach (self::MODELS as $class) {
            /** @var Model $model */
            $model = new $class;

            if (Schema::hasColumn($model->getTable(), 'uuid')) {
                Schema::table($model->getTable(), function (Blueprint $table) {
                    $table->dropColumn(['uuid']);
                });
            }
        }
        
    }
};
