<?php

namespace App\Http\Requests\Master\Department;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class StoreRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('departments.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\Master\Department,name,NULL,id',
            ],
            'code' => [
                'required',
                'string',
            ],
            'status' => [
                'nullable',
                'in:1,0'
            ]
        ];

    }
}
