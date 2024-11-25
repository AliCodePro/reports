<?php

namespace App\Http\Requests;

use App\Models\Chapter;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateChapterRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('chapter_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'report_id' => [
                'required',
                'integer',
            ],
            'number' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
