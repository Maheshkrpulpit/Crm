<?php

namespace App\Http\Requests\Master\AsignBrand;

use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class StoreRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('asign_brands.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'user_id.*' => [
                'required:App\Models\Master\AsignBrand,user_id,NULL,id',
               
            ],
            'amount.*' => [
                'nullable',
                'string',
            ],
            'comission.*' => [
                'nullable',
                'in:1,0'
            ],
            'brand_id.*' => [
                'required'
            ],
        ];

    }
}
