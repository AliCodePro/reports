<?php

namespace App\Http\Requests;

use App\Models\Category;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCategoryRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('category_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'min:0',
                'max:500',
                'required',
            ],
            'description' => [
                'required',
            ],
        ];
    }
}
