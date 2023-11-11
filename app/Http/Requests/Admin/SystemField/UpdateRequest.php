<?php

namespace App\Http\Requests\Admin\SystemField;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class UpdateRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('system_fields.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
          'order' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\Setting\SystemField,order,'. $this->systemField.',id'
            ],
            'label' => [
                'required',
                'string',
            ],
            'grid' => [
                'required',
                'string',
            ],
            // 'type' => [
            //     'nullable',
            //     'string',
            // ],
            // 'value' => [
            //     'nullable',
            //     'string',
            // ],
            // 'order' => [
            //     'required',
            //     'numeric', // Assuming 'order' should be a numeric field
            //     'unique:App\Models\Setting\SystemField,order,NULL,id',
            // ],
            'show_on_table' => [
                'nullable',
                'in:1,0'
            ],
            'status' => [
                'nullable',
                'in:1,0'
            ]
        ];
    }
}