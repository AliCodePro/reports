<?php

namespace App\Http\Requests;

use App\Models\Report;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreReportRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('report_create');
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
            'author_id' => [
                'required',
                'integer',
            ],
            'category_id' => [
                'required',
                'integer',
            ],
        ];
    }
}
