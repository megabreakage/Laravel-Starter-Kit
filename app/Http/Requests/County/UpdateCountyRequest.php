<?php

namespace App\Http\Requests\County;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCountyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],
            'shortcode' => ['required', 'string', 'min:2, max:4'],
            'country_id' => ['required', 'string', 'exists:country,identifier']
        ];
    }
}
