<?php

namespace App\Models;

use App\Models\Scopes\SafeSelectScope;
use App\Observers\ApplicationObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property string $id
 * @property string $key
 * @property string $secret
 * @property int    $ping_interval
 * @property array  $allowed_origins
 * @property int    $max_message_size
 * @property array  $options
 * @property bool   $is_active
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 *
 * @method static Builder active()
 */
#[ScopedBy(SafeSelectScope::class)]
#[ObservedBy(ApplicationObserver::class)]
class Application extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'key',
        'secret',
        'ping_interval',
        'allowed_origins',
        'max_message_size',
        'options',
        'is_active'
    ];

    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $attributes = [
        'allowed_origins' => '[\'*\']',
        'options'         => '[]',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'allowed_origins' => 'array',
            'options'         => 'array',
        ];
    }

    /**
     * Scope a query to only include active applications.
     */
    public function scopeActive(Builder $builder): void
    {
        $builder->where('is_active', '=', true);
    }

    /**
     * Scope a query to only include active applications.
     */
    public function scopeReverb(Builder $builder): void
    {
        $builder->withoutGlobalScope(SafeSelectScope::class)
            ->active();
    }

    /**
     * Convert the model instance to a Reverb Application.
     *
     * @return \Laravel\Reverb\Application
     */
    public function toReverbApplication(): \Laravel\Reverb\Application
    {
        return new \Laravel\Reverb\Application(
            $this->id,
            $this->key,
            $this->secret,
            $this->ping_interval,
            $this->allowed_origins,
            $this->max_message_size,
            $this->options,
        );
    }
}
