<?php

namespace App\Http\Requests\Admin\Permission;

use Gate;
use Spatie\Permission\Models\Permission;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class UpdateRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('permissions.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'unique:Spatie\Permission\Models\Permission,name,'. $this->permission.',id'
            ]
        ];
    }
}