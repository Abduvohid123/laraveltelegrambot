<?php

namespace App\Http\Requests;

use App\Models\YetkazibBerish;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateYetkazibBerishRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('yetkazib_berish_edit');
    }

    public function rules()
    {
        return [
            'delivery_type' => [
                'string',
                'required',
                'unique:yetkazib_berishes,delivery_type,' . request()->route('yetkazib_berish')->id,
            ],
        ];
    }
}
