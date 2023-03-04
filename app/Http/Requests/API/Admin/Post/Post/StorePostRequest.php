<?php

namespace App\Http\Requests\API\Admin\Post\Post;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'description'  => 'required|string|max:1000',
            'image'        => 'nullable',
            'image.*'      => 'image|max: 4064',
            'time_read'    => 'required|string|max:255',
            'category_id'  => 'required|integer|max:255',
            'is_published' => 'nullable|max:255',

        ];
    }
}
