<?php

namespace App\Http\Requests\Application;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'ping_interval'     => ['filled', 'numeric', 'min:60', 'max:600'],
            'allowed_origins'   => ['filled', 'array', 'min:1'],
            'allowed_origins.*' => ['string', 'max:255'],
            'max_message_size'  => ['filled', 'numeric', 'min:10', 'max:10000'],
            'options.'          => ['filled', 'array', 'min:1'],
            'options.host'      => ['filled', 'string', 'max:255'],
            'options.port'      => ['filled', 'numeric', 'min:1', 'max:65535', Rule::unique('applications', 'options->port')],
            'options.scheme'    => ['filled', Rule::in(['http', 'https'])],
            'options.useTLS'    => ['filled', 'boolean'],
            'is_active'         => ['filled', 'boolean'],
        ];
    }
}
