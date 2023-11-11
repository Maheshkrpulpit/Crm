<?php

namespace App\Http\Requests\Master\Package;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class StoreRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('packages.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\Master\Package,name,NULL,id',
            ],
            'amount' => [
                'required',
                'string',
            ],
            'comission' => [
                'required',
                'string'
            ],
            'brand_id' => [
                'required'
            ],
            'status' => [
                'nullable',
                'in:1,0'
            ]
        ];

    }
}
