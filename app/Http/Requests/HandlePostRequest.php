<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HandlePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string|min:15|max:100',
            'description' => 'required|string|min:15|max:1000',
            'category_id' => ['required', 'integer', Rule::exists('categories', 'id')->where('active', true)],
            'attachment' => 'image|nullable',
            'tag_id' => 'nullable|array|exists:tags,id'
        ];
    }
}
