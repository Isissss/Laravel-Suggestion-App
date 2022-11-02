<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HandleUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public $user;

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
            'name' => ['string', 'max:50', 'alpha_dash',  Rule::unique('users', 'name')->ignore(request('user'))],
            'email' => ['string', 'email', 'max:255', Rule::unique('users', 'email')->ignore(request('user'))]
        ];
    }
}
