<?php

namespace App\Http\Resources;

use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Application
 */
class ApplicationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'key' => $this->whenHas('key'),
            'secret' => $this->whenHas('secret'),
            'ping_interval' => $this->ping_interval,
            'allowed_origins' => $this->allowed_origins,
            'max_message_size' => $this->max_message_size,
            'options' => $this->options,
            'is_active' => $this->is_active,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'deleted_at' => $this->whenHas('deleted_at'),
        ];
    }
}
