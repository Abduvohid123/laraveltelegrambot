<?php

namespace App\Http\Requests;

use App\Models\YetkazibBerish;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreYetkazibBerishRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('yetkazib_berish_create');
    }

    public function rules()
    {
        return [
            'delivery_type' => [
                'string',
                'required',
                'unique:yetkazib_berishes',
            ],
        ];
    }
}
