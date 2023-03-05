<?php

namespace App\Http\Requests;

use App\Models\User;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateUserRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('user_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
            'roles.*' => [
                'integer',
            ],
            'roles' => [
                'array',
            ],
            'mobile_number' => [
                'string',
                'nullable',
            ],
            'chat' => [
                'string',
                'required',
                'unique:users,chat,' . request()->route('user')->id,
            ],
            'status' => [
                'string',
                'nullable',
            ],
        ];
    }
}
