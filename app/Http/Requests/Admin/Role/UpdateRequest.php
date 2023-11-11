<?php

namespace App\Http\Requests\Admin\Role;

use Gate;
use App\Models\Role;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class UpdateRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('roles.edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\User,name,'. $this->role->id.',id',              
            ]
        ];

    }
}
