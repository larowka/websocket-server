<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SafeSelectScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $builder->select([
            'id',
            'ping_interval',
            'allowed_origins',
            'max_message_size',
            'options',
            'is_active',
            'created_at',
            'updated_at',
            'deleted_at',
        ]);
    }
}