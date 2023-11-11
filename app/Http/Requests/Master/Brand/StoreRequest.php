<?php

namespace App\Http\Requests\Master\Brand;

use Illuminate\Support\Facades\Gate;
use App\Models\Master\Bank;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class StoreRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('brands.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\Master\Brand,name,NULL,id',
            ],
            'attach_document' => [
                'required',
                'file',
            ],
            'status' => [
                'nullable',
                'in:1,0'
            ]
        ];

    }
}
